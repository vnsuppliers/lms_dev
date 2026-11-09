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
use DateTime;
use DateTimeZone;
use App\Models\Roles;


class TrainerviewController extends Controller
{

    
    public function trainercourseslist(Request $request){
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
                $users_lists = User::where('user_type', 'not like', '%"1"%')
    ->orWhere('user_type', 'like', '%"1"%');
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

//dd($roles);

                // /dd($users_lists);

       $lastCourse = Courses::latest()->first();

        $trainercoursescount = Course_Training_data::where('trainer_id',Auth::user()->id)->count();
        //dd($trainercoursescount);

$courseIds = Course_Training_data::where('trainer_id', Auth::user()->id)
                ->pluck('course_id');

$assignedUsersCount = Asigneduser::whereIn('course_id', $courseIds)
                                ->where('user_id', '!=',Auth::user()->id) 
                                ->distinct('user_id')
                                ->count('user_id');


$trainers_data = Course_Training_data::with('course_details')->where('trainer_id', Auth::user()->id)
    ->whereHas('course_details', function($query) use($request) {
        if (!empty($request->search_name)) {
            $query->where('course_name', 'like', '%' . $request->search_name . '%');
        }
         if(!empty($request->category_id)){
                $query->where('category_id',$request->category_id);
            }

            if(!empty($request->status)){
                $query->where('course_type',$request->status);
            }elseif($request->menu=='Offline'){
                $query->where('course_type',2);
            }
            else{
                //$query->where('course_type',1);
            }   
    })
    ->orderBy('id', 'desc')
    ->get();

    //dd($trainers_data);

        $goals=Goal::get();
         $levels=Level::get();
         $groups_lists=Group::get();

        
   
        return view('user.Trainerview.course_catalog',compact('category_list','data_id','sub_id','sub_data','list','users_lists','lastCourse','sub_category_list','courses_id','request','goals','levels','designations','departments','trainers_data','certificates','groups_lists','assignedUsersCount','trainercoursescount','roles'));
    }

    public function fetch_trainer_course_details(Request $request) {

    $course = Courses::findOrFail($request->course_id);
    $users_lists = User::with(['assigned_users'=>function($q) use($course){
        $q->where('course_id',$course->id);
    }])->where('active',1)->get();
    $assignedUser = Asigneduser::where('course_id',$course->id)->get();
    $attend = Asigneduser::where('course_id',$course->id)->where('status',1)->get();
    $notattend = Asigneduser::where('course_id',$course->id)->where('status',2)->get();
    $notresponce = Asigneduser::where('course_id',$course->id)->where('status',0)->get();
     $departments = Department::get();
     $designations = Designation::get();
     $completed_course=Asigneduser::where('course_id',$course->id)->where('status',3)->get();
             
               $groups_lists = Group::with(['assignedUsers' => function ($q) use ($request) {
           $q->where('course_id', $request->course_id);
        }])->get();

               //dd($groups_lists);

     //dd($course);

    $html = view('user.Trainerview.course_ajax',compact('course','users_lists','assignedUser','notattend','notresponce','attend','departments','designations','request','completed_course','groups_lists'))->render();
    return $html;
}

public function trainer_get_user_based_on_filters(Request $request)
{
  
$query = Asigneduser::query();
$query->with('users_data')->where('course_id', $request->course_id);

$query->whereHas('users_data', function($query) use($request) {
    $query->when(!empty($request->designation), function($q) use ($request) {
        $q->where('designation', $request->designation);
    });
    
    $query->when(!empty($request->department), function($q) use ($request) {
        $q->where('department', $request->department);
    });
});

if (!empty($request->search_query)) {
    $query->where(function ($q) use ($request) {
        $q->whereHas('users_data', function ($query) use ($request) {
            $query->where('first_name', 'like', '%' . $request->search_query . '%')
                  ->orWhere('last_name', 'like', '%' . $request->search_query . '%')
                  ->orWhere('username', 'like', '%' . $request->search_query . '%');
        });

    });
}
    
$list = $query->get();
//dd($list);




    $html='';
    foreach ($list as $key => $user) {
        $checked='';$user_image=url("public/images/face12.jpg");
      
        $assign = Asigneduser::where(['course_id'=>$request->course_id,'user_id'=>$user->users_data->id])->first();
        
         $assign_id = $assign->id??0;
         if(!empty($assign_id)) {$checked='Checked';}

        if(!empty($user->users_data->profile_image)){ url("storage/app/public/" . $user->users_data->profile_image);}
        $last_login = $user->users_data->last_login ? \Carbon\Carbon::parse($user->users_data->last_login)->format("d-m-Y"):"";
        $department_name=$user->users_data->departmentdetails->department_name??"";
        $designation_name=$user->users_data->designationdetails->designation_name??"";
        $emp_id=$user->users_data->emp_id??"";

            $userTypes = json_decode($user->users_data->user_type, true);
         $roles = \App\Models\Roles::whereIn('id', $userTypes)->pluck('role')->toArray();

          $roleString = '';
            foreach ($roles as $index => $role) {
                $roleString .= htmlspecialchars($role, ENT_QUOTES, 'UTF-8');
                // Add comma between roles except the last one
                if ($index < count($roles) - 1) {
                    $roleString .= ', ';
                }
            }



         $created_at = $user->created_at ?? '';
    $assigned_created_date = '';
    if ($created_at) {
        $date = new DateTime($created_at);
        $date->setTimezone(new DateTimeZone('Asia/Kolkata'));
        $assigned_created_date = $date->format('F j, Y g:i a \I\S\T');
    }


      

        $html .= '<tr>
            <td scope="row">
                <div class="d-flex align-items-center">
                    <img src="' . htmlspecialchars($user_image, ENT_QUOTES, 'UTF-8') . '" class="img-fluid" alt="User Image">
                    <div>
                        <div class="py-1">' . htmlspecialchars($user->users_data->first_name, ENT_QUOTES, 'UTF-8') . ' ' . htmlspecialchars($user->users_data->last_name, ENT_QUOTES, 'UTF-8') . '</div>
                        <div class="py-1">' . htmlspecialchars($user->users_data->email, ENT_QUOTES, 'UTF-8') . '</div>
                    </div>
                </div>
            </td>
            <td>' . htmlspecialchars($department_name, ENT_QUOTES, 'UTF-8') . '</td>
            <td>' . htmlspecialchars($designation_name, ENT_QUOTES, 'UTF-8') . '</td>
            <td>' . htmlspecialchars($roleString , ENT_QUOTES, 'UTF-8') . '</td>
            <td>' . htmlspecialchars($assigned_created_date, ENT_QUOTES, 'UTF-8') . '</td>
            <td>
                <div>
                    <a href="javascript:void(0);" 
                       class="btn sbmt-btn" 
                        data-id="' . htmlspecialchars($user->users_data->id ?? '', ENT_QUOTES, 'UTF-8') . '"
                       data-profile-image="' . htmlspecialchars($user->users_data->profile_image ?? '', ENT_QUOTES, 'UTF-8') . '"
                       data-first-name="' . htmlspecialchars($user->users_data->first_name ?? '', ENT_QUOTES, 'UTF-8') . '"
                       data-last-name="' . htmlspecialchars($user->users_data->last_name ?? '', ENT_QUOTES, 'UTF-8') . '"
                       data-email="' . htmlspecialchars($user->users_data->email ?? '', ENT_QUOTES, 'UTF-8') . '"
                       data-department="' . htmlspecialchars($user->users_data->departmentdetails->department_name ?? '', ENT_QUOTES, 'UTF-8') . '"
                       data-designation="' . htmlspecialchars($user->users_data->designationdetails->designation_name ?? '', ENT_QUOTES, 'UTF-8') . '"
                       data-course_name="' . htmlspecialchars($course->course_name ?? '', ENT_QUOTES, 'UTF-8') . '"
                       data-course_type="' . htmlspecialchars($course->course_type ?? '', ENT_QUOTES, 'UTF-8') . '"
                       onclick="openData(this)">
                      Assesment and certificates
                    </a>
                </div>
            </td>
        </tr>';

        }
    return $html;
}

 public function fetch_trainer_user_assessments(Request $request)
{

   $user = User::findOrFail($request->userid);

   $assignedcourse = Asigneduser::with('course_details')
        ->where('user_id', $user->id)
        ->get();
         //dd($assignedcourse);

        $data = Asigneduser::where('user_id',$user)->where('status',3)->get();

        $totalassigned=Asigneduser::where('user_id', $user->id)->count();
        $notresponce = Asigneduser::where('user_id', $user->id)->where('status', 0)->count();
    $completed_course = Asigneduser::where('user_id', $user->id)->where('status', 3)->count();
    $inprogress = Asigneduser::where('user_id', $user->id)->where('status', 1)->count();


        $html = view('user.Trainerview.course_details_ajax',compact('user','assignedcourse','totalassigned','notresponce','completed_course','inprogress','data'))->render();
     return $html;
  
}
}