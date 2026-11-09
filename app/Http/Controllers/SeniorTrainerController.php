<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Models\Courses;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Asigneduser;
use App\Models\CourseVideoProgress;
use App\Models\Notifications;
use App\Models\Recently_view;
use App\Models\Bookmark;
use App\Models\User_login;
use App\Models\Scorm_data;
use App\Models\Goal;
use App\Models\Level;
use App\Models\Group;
use App\Models\Offline_Documents;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Zip;
use App\Models\Assessment_results;
 use Barryvdh\DomPDF\Facade\Pdf;
 use App;
 use App\Models\Department;
 use App\Models\Designation;
 use App\Models\Certificate;
use App\Models\Certificate_template;
use App\Models\Course_Training_data;
use App\Models\Roles;


class SeniorTrainerController extends Controller
{

    
    public function seniortrainer_trainerslist(Request $request){
          $data_id = Category::where('id', $request->id)->first();
          $sub_id = Subcategory::where('id', $request->id)->first();
          $sub_data = Subcategory::with('cat')->get();
          $category_list=Category::query();
          if ($request->filled('status')) {
            $category_list->where('status', $request->status);
        }

        $category_list = $category_list->get();

        $sub_category_list=Subcategory::get();
     $list = Asigneduser::has('course_details')->has('category_details')->where('user_id',Auth::user()->id)->whereHas('course_details',function($q) use($request){
            // $q->whereDate('expiration_date','>=',date('Y-m-d'));
            if(!empty($request->search)){
                $q->where('course_name','like', '%' . $request->search . '%');
            }
            if(!empty($request->due_by)){
                $date=date('Y-m-d');

                if($request->due_by==1 || $request->due_by==2){
                    $q->whereDate('expiration_date','=', date('Y-m-d
                    ',strtotime(date("Y-m-d", strtotime($date)) . " -".$request->due_by." day")));
                }else{
                     $q->whereDate('expiration_date','>=', date('Y-m-d'));
                    $q->whereDate('expiration_date','<=', date('Y-m-d
                    ',strtotime(date("Y-m-d", strtotime($date)) . " +".$request->due_by." day")));
                }
            }
             if(!empty($request->status)){
                $q->where('course_type',$request->status);
            }elseif($request->menu=='Offline'){
                $q->where('course_type',2);
            }
            else{
                //$q->where('course_type',1);
            }
        })->where(function($q) use($request){
            if(!empty($request->category_id)){
                $q->where('category_id',$request->category_id);
            }
           

        })->with('bookmark_data')->where('status','!=',3);

        if($request->bookmark==1){
           $list =$list->has('bookmark_data'); 
        }
         if($request->menu=='progress'){
           $list =$list->has('scorm_details'); 
        }
        $list =$list->orderBy('id','desc')->get();

       // dd($list);
       $departments = Department::get();
       $designations = Designation::get();
       $certificates = Certificate::get();

        


                $courses_id=Courses::with('category_details')->where('id',$request->id)->first();
                // /dd($courses_id);
                $users_lists = User::where('user_type', '!=', 1);
                    $users_lists->with(['assigned_users' => function($q) use ($request) {
                        $q->where('course_id', $request->id);
                    }]);

                    if ($request->filled('department')) {
                        $users_lists->where('department', $request->department);
                    }

                    if ($request->filled('designation')) {
                        $users_lists->where('designation', $request->designation);
                    }

                    
                $users_lists = $users_lists->get();

                         foreach ($users_lists as $user) {
    $userTypes = json_decode($user->user_type, true);
    $roles = Roles::whereIn('id', $userTypes)->pluck('role')->toArray();
    $user->role_names = $roles; 
}

                // /dd($users_lists);

       $lastCourse = Courses::latest()->first();

        $trainercoursescount = User::where('senior_training_manager',Auth::user()->emp_id)->count();
        //dd($trainercoursescount);

$courseIds = Course_Training_data::where('trainer_id', Auth::user()->id)
                ->pluck('course_id');

$assignedUsersCount = Asigneduser::whereIn('course_id', $courseIds)
                                ->where('user_id', '!=',Auth::user()->id) 
                                ->distinct('user_id')
                                ->count('user_id');


// $trainers_data = Course_Training_data::with('course_details')->where('trainer_id', Auth::user()->id)
//     ->whereHas('course_details', function($query) use($request) {
//         if (!empty($request->search_name)) {
//             $query->where('course_name', 'like', '%' . $request->search_name . '%');
//         }
//          if(!empty($request->category_id)){
//                 $query->where('category_id',$request->category_id);
//             }

//             if(!empty($request->status)){
//                 $query->where('course_type',$request->status);
//             }elseif($request->menu=='Offline'){
//                 $query->where('course_type',2);
//             }
//             else{
//                 //$query->where('course_type',1);
//             }   
//     })
//     ->orderBy('id', 'desc')
//     ->get();


    $trainers_data_query=User::where('senior_training_manager',Auth::user()->emp_id);
    if (!empty($request->department_id)) {
    
    $trainers_data_query->where('department', $request->department_id);
}

if (!empty($request->designation_id)) {
    
    $trainers_data_query->where('designation', $request->designation_id);
}

if (!empty($request->status)) {
    $trainers_data_query->where('status', $request->status);
}

if (!empty($request->search_name)) {
    $trainers_data_query->where(function($query) use ($request) {
        $query->where('first_name', 'like', '%' . $request->search_name . '%')
              ->orWhere('last_name', 'like', '%' . $request->search_name . '%')
              ->orWhere('username', 'like', '%' . $request->search_name . '%');
    });
}
$trainers_data = $trainers_data_query->get();

foreach ($trainers_data as $user_trainer) {
    $userTypess = json_decode($user_trainer->user_type, true);
    $roles_user = Roles::whereIn('id', $userTypess)->pluck('role')->toArray();
    $user_trainer->role_names = $roles_user; 
}

    //dd($trainers_data);

        $goals=Goal::get();
         $levels=Level::get();
         $groups_lists=Group::get();

        
   
        return view('user.SeniorTrainer.course_catalog',compact('category_list','data_id','sub_id','sub_data','list','users_lists','lastCourse','sub_category_list','courses_id','request','goals','levels','designations','departments','trainers_data','certificates','groups_lists','assignedUsersCount','trainercoursescount','roles','roles_user'));
    }

   public function fetch_trainer_details(Request $request)
{
    // Validate the request
    $request->validate([
        'userid' => 'required|exists:users,id',
    ]);
    $user = User::findOrFail($request->userid);
    $courses = Course_Training_data::where('trainer_id', $user->id)->get();
    $courseIds = $courses->pluck('course_id');

    $coursesIdscount=$courseIds->count();
    $assignedUsers = Asigneduser::whereIn('course_id', $courseIds)->get();
    $groupedAssignedUsers = $assignedUsers->groupBy('user_id');
    $userIds = $groupedAssignedUsers->keys();
    $userDetails = User::whereIn('id', $userIds)->get()->keyBy('id');
    $userDetailscount=$userDetails->count();
    $assignedUser = Course_Training_data::with('course_details')
        ->where('trainer_id', $request->userid)
        ->get();
    
    $attend = Asigneduser::where('user_id', $user->id)->where('status', 1)->get();
    $notattend = Asigneduser::where('user_id', $user->id)->where('status', 2)->get();
    $notresponce = Asigneduser::where('user_id', $user->id)->where('status', 0)->get();
    $completed_course = Asigneduser::where('user_id', $user->id)->where('status', 3)->get();
    $departments = Department::all();
    $designations = Designation::all();
    $groups_lists = Group::with(['assignedUsers' => function ($q) use ($request) {
        $q->where('user_id', $request->userid);
    }])->get();

    // Render the view with data
    $html = view('user.SeniorTrainer.course_ajax', [
        'user' => $user,
        'assignedUser' => $assignedUser,
        'notattend' => $notattend,
        'notresponce' => $notresponce,
        'attend' => $attend,
        'departments' => $departments,
        'designations' => $designations,
        'completed_course' => $completed_course,
        'groups_lists' => $groups_lists,
        'groupedAssignedUsers' => $groupedAssignedUsers,
        'userDetails' => $userDetails,
        'coursesIdscount' => $coursesIdscount,
        'userDetailscount'=>$userDetailscount

    ])->render();

    return $html;
}

 public function fetch_trainer_user_de(Request $request)
{

   $user = User::findOrFail($request->userid);

   $assignedcourse = Asigneduser::with('course_details')
        ->where('user_id', $user->id)
        ->get();
         //dd($assignedcourse);

        $totalassigned=Asigneduser::where('user_id', $user->id)->count();
        $notresponce = Asigneduser::where('user_id', $user->id)->where('status', 0)->count();
    $completed_course = Asigneduser::where('user_id', $user->id)->where('status', 3)->count();
    $inprogress = Asigneduser::where('user_id', $user->id)->where('status', 1)->count();


        $html = view('user.SeniorTrainer.course_details_ajax',compact('user','assignedcourse','totalassigned','notresponce','completed_course','inprogress'))->render();
     return $html;
  
}



public function senior_trainer_get_user_based_on_filters(Request $request)
{

    $trainer = User::findOrFail($request->user_id);
    $courses = Course_Training_data::where('trainer_id', $trainer->id)->get();
    $courseIds = $courses->pluck('course_id');
    

    $assignedUsers = Asigneduser::whereIn('course_id', $courseIds)->get();
    $groupedAssignedUsers = $assignedUsers->groupBy('user_id');
    $userIds = $groupedAssignedUsers->keys();

    $userDetailsQuery = User::whereIn('id', $userIds);


    $userDetailsQuery->when(!empty($request->designation), function($q) use ($request) {
        $q->where('designation', $request->designation);
    });

    $userDetailsQuery->when(!empty($request->department), function($q) use ($request) {
        $q->where('department', $request->department);
    });

    if (!empty($request->trainername)) {
        $userDetailsQuery->whereHas('assigned_users.training_data', function($q) use ($request) {
            $q->where('trainer_id', $request->trainername);
        });
    }

    if (!empty($request->search_query)) {
        $userDetailsQuery->where(function ($q) use ($request) {
            $q->where('first_name', 'like', '%' . $request->search_query . '%')
              ->orWhere('last_name', 'like', '%' . $request->search_query . '%')
              ->orWhere('username', 'like', '%' . $request->search_query . '%');
        });
    }

    $list = $userDetailsQuery->get()->keyBy('id');

    $html = '';
    foreach ($list as $user) {
        $assign = Asigneduser::where('user_id', $user->id)->first();
        $assign_id = $assign->id ?? 0;
        $user_image = $user->profile_image ? url("storage/app/public/" . $user->profile_image) : '';
        $last_login = $user->last_login ? \Carbon\Carbon::parse($user->last_login)->format("d-m-Y") : "";
        $department_name = $user->departmentdetails->department_name ?? "";
        $designation_name = $user->designationdetails->designation_name ?? "";
        $emp_id = $user->emp_id ?? "";

       $userTypes = json_decode($user->user_type, true);
         $roles = \App\Models\Roles::whereIn('id', $userTypes)->pluck('role')->toArray();

          $roleString = '';
            foreach ($roles as $index => $role) {
                $roleString .= htmlspecialchars($role, ENT_QUOTES, 'UTF-8');
                // Add comma between roles except the last one
                if ($index < count($roles) - 1) {
                    $roleString .= ', ';
                }
            }

        $html .= '<tr>
            <td>
                <div class="row">
                    <div class="col-lg-2">
                        <img src="' . htmlspecialchars($user_image) . '" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-10 pl-0 my-auto">
                        <div class="py-1">' . htmlspecialchars($user->first_name) . ' ' . htmlspecialchars($user->last_name) . '</div>
                        <div class="py-1">' . htmlspecialchars($user->email) . '</div>
                        <div class="py-1">' . htmlspecialchars($emp_id) . '</div>
                    </div>
                </div>
            </td>
            <td>' . htmlspecialchars($department_name) . '</td>
            <td>' . htmlspecialchars($designation_name) . '</td>
            <td>' . htmlspecialchars($roleString) . '</td>
            <td>
                <div>
                    <a href="javascript:;" 
                       class="btn sbmt-btn" 
                       style="cursor:pointer" 
                       data-id="' . htmlspecialchars($user->id) . '"
                       data-profile-image="' . htmlspecialchars($user->profile_image) . '"
                       data-user-id="' . htmlspecialchars($user->id) . '"
                       data-first-name="' . htmlspecialchars($user->first_name) . '"
                       data-last-name="' . htmlspecialchars($user->last_name) . '"
                       data-email="' . htmlspecialchars($user->email) . '"
                       data-department="' . htmlspecialchars($department_name) . '"
                       data-designation="' . htmlspecialchars($designation_name) . '"
                       data-course_name="' . htmlspecialchars($user->course_name ?? '') . '"
                       data-course_type="' . htmlspecialchars($user->course_type ?? '') . '"
                       onclick="openData(this)">
                        User Courses Assigned
                    </a>
                </div>
            </td>
        </tr>';
    }

    return $html;
}

}