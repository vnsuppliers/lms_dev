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
use App\Models\Roles;
use App\Models\Bookmark;
use App\Models\User_login;
use App\Models\Scorm_data;
use App\Models\Offline_Documents;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Zip;
use App\Models\Assessment_results;
use App\Models\Course_documents;
use App\Models\ExamAttempt;
use App\Models\AssessmentVideoAccess;
 use Barryvdh\DomPDF\Facade\Pdf;
 use App;
 Use DB;
 use App\Models\Department;
 use App\Models\Designation;
 use Carbon\Carbon; 
 use App\Helpers\ActivityLog;
  use App\Models\Activity;
  use App\Models\FeedbackRatingsSetting;
  use App\Models\EmployeeFeedbackRating;

class UserprofileController extends Controller
{

    public function dashboard(Request $request)
    {
        $recently = Recently_view::whereHas('assign_details.course_details',function($q) use($request){  
               $q->whereDate('expiration_date','>=', date('Y-m-d'));  
        })->where('user_id',Auth::user()->id)->orderBy('updated_at','desc')->limit(3)->get();

        //dd($recently);
        $bookmark = Bookmark::whereHas('assign_details.course_details',function($q) use($request){  
               $q->whereDate('expiration_date','>=', date('Y-m-d'));  
        })->where('user_id',Auth::user()->id)->orderBy('id','desc')->limit(3)->get();

        $expired = Asigneduser::has('category_details')->where('user_id',Auth::user()->id)->where('status','!=',3)->whereHas('course_data',function($q) use($request){  
               $q->whereDate('expiration_date','<', date('Y-m-d'));  
        })->with('course_data')->get()->sortByDesc(function($post) {
                return $post->course_data->expiration_date;
            });

        $today = Carbon::today();
     $oneMonthFromNow = $today->copy()->addMonth();

$due_soon = Asigneduser::has('course_details')
    ->has('category_details')
    ->where('user_id', Auth::user()->id)
    ->where('status','!=',3)
    ->whereHas('course_details', function($q) use ($today, $oneMonthFromNow) {
        $q->whereDate('expiration_date', '>=', $today)
          ->whereDate('expiration_date', '<=', $oneMonthFromNow);
    })
    ->limit(3)
    ->get()
    ->sortBy(function($post) {
        return $post->course_details->expiration_date;
    });

        $recently_assign = Asigneduser::whereHas('course_details',function($q) use($request){  
               $q->whereDate('expiration_date','>=', date('Y-m-d'));  
        })->has('course_details')->has('category_details')->where('user_id',Auth::user()->id)->limit(3)->orderBy('id','desc')->get();

        // dd($recently_assign);

        $xvalues=[];$assignedyvalues=[];$loginyvalues=[];
        for($i=0;$i<7;$i++){
          if($i==0) $xvalues[]="Today";
          if($i==1) $xvalues[]="Yesterday";
          if($i > 1) $xvalues[]=date('l',strtotime(date("Y-m-d") . " -".$i." day"));
          $assignedyvalues[] = AsignedUser::where('user_id',Auth::user()->id)->where(function($q) use($i){
                $q->whereDate('created_at',date('Y-m-d',strtotime(date("Y-m-d") . " -".$i." day")));
            })->count();
           $loginyvalues[] = User_login::where('user_id',Auth::user()->id)->where(function($q) use($i){
                $q->whereDate('login_time',date('Y-m-d',strtotime(date("Y-m-d") . " -".$i." day")));
            })->count();
        }

         $categories = Category::with(['assigned_user'=>function($q){
         $q->where('user_id', '=', Auth::user()->id);
     }])->whereHas('assigned_user', function ($query) {
                       $query->where('user_id', Auth::user()->id);
                     })->where('status',1)->get();

        $user = Auth::user();
       $userTypes = json_decode(Auth::user()->user_type, true);
        $roles = Roles::whereIn('id', $userTypes)->get();
        
$oneMonthAgo = Carbon::now()->subMonth();

$loginHistory = User_login::where('user_id', $user->id)
    ->where('login_time', '>=', $oneMonthAgo)
    ->get();

$dates = [];
$counts = [];

// Group logins by date
foreach ($loginHistory as $login) {
    $date = \Carbon\Carbon::parse($login->login_time)->format('Y-m-d');
    if (!isset($counts[$date])) {
        $counts[$date] = 0;
        $dates[] = $date;
    }
    $counts[$date]++;
}

$loginCounts = array_values($counts);


//dd($dates);

         $secondLastLogin = DB::table('tbl_user_login_history')->where('user_id', $user->id)->orderBy('login_time', 'desc')->skip(1)->take(1)->first(); 

        if (!$secondLastLogin) {
            $secondLastLogin = DB::table('tbl_user_login_history')->where('user_id', $user->id)->orderBy('login_time', 'desc')->first(); 
        }

        // $total_courses =AsignedUser::where('user_id',$user->id)->whereHas('course_details', function($q) use ($request) {
        //     $q->where('course_type', 1);
          
        //     if(!empty($request->category_id)){
        //       $q->where('category_id', $request->category_id);

        //     }
        //      })->count();// Completed courses count
        
        $total_courses = AsignedUser::leftJoin('tbl_courses', 'tbl_courses.id', '=', 'tbl_assignedusers.course_id')
            ->where('tbl_assignedusers.user_id', $user->id)
            ->where(function ($q){
                $q->where('tbl_courses.course_type', 1)
                ->orWhereNull('tbl_courses.id'); 
            });

        if (!empty($request->category_id)) {
            $total_courses->where('courses.category_id', $request->category_id);
        }

        $total_courses = $total_courses->count();
           
        // $completed_course = AsignedUser::where('user_id', $user->id)
        //     ->whereHas('course_details', function($q) use ($request) {
        //         $q->where('course_type', 1);
        //         if(!empty($request->category_id)){
        //         $q->where('category_id', $request->category_id);
        //         } 
        //     })
        //     ->where('status', 3)
        //     ->count();

        $completed_course = AsignedUser::leftJoin('tbl_courses', 'tbl_courses.id', '=', 'tbl_assignedusers.course_id')
            ->where('tbl_assignedusers.user_id', $user->id)
            ->where('tbl_assignedusers.status', 3)
            ->where(function ($q) {
                $q->where('tbl_courses.course_type', 1)
                ->orWhereNull('tbl_courses.id');
            });

        if (!empty($request->category_id)) {
            $completed_course->where('tbl_courses.category_id', $request->category_id);
        }

        $completed_course = $completed_course->count();

        // $inprogress_count = AsignedUser::where('user_id', $user->id)
        //     ->whereHas('course_details', function($q) use ($request) {
        //         $q->where('course_type', 1);
        //          if(!empty($request->category_id)){
        //           $q->where('category_id', $request->category_id);
        //           }
        //     })
        //     ->where('status', 1)
        //     ->count();


        $inprogress_count = AsignedUser::leftJoin('tbl_courses', 'tbl_courses.id', '=', 'tbl_assignedusers.course_id')
            ->where('tbl_assignedusers.user_id', $user->id)
            ->where('tbl_assignedusers.status', 1)
            ->where(function ($q) {
                $q->where('tbl_courses.course_type', 1)
                ->orWhereNull('tbl_courses.id');
            });

        if (!empty($request->category_id)) {
            $inprogress_count->where('tbl_courses.category_id', $request->category_id);
        }

        $inprogress_count = $inprogress_count->count();




        // $pending_count = AsignedUser::where('user_id', $user->id)
        //     ->where('course_details', function($q) use ($request) {
        //         $q->where('course_type', 1);
        //         if(!empty($request->category_id)){
        //           $q->where('category_id', $request->category_id);
        //           }
        //     })
        //     ->where('status', 0)
        //     ->count();

        $pending_count = AsignedUser::leftJoin('tbl_courses', 'tbl_courses.id', '=', 'tbl_assignedusers.course_id')
            ->where('tbl_assignedusers.user_id', $user->id)
            ->where('tbl_assignedusers.status', 0)
            ->where(function ($q) use ($request) {
                $q->where('tbl_courses.course_type', 1)
                ->orWhereNull('tbl_courses.id'); // keeps missing ones
            });

        if (!empty($request->category_id)) {
            $pending_count->where('courses.category_id', $request->category_id);
        }

        $pending_count = $pending_count->count();

        // dd($pending_count);

        $instructor_lead = AsignedUser::where('user_id', $user->id)
            ->whereHas('course_details', function($q) use ($request) {
                $q->where('course_type', 2);
                if(!empty($request->category_id)){
                  $q->where('category_id', $request->category_id);
                  }
                  if(!empty($request->instructor_category_id)){
                  $q->where('category_id', $request->instructor_category_id);
                  }
            })
            ->count();

            // $instructor_lead=0;

            $instructor_completed_course = AsignedUser::where('user_id', $user->id)
            ->whereHas('course_details', function($q) use ($request) {
                $q->where('course_type', 2);
                if(!empty($request->instructor_category_id)){
                $q->where('category_id', $request->instructor_category_id);
                } 
            })
            ->where('status', 3)
            ->count();
           
        $instructor_inprogress_count = AsignedUser::where('user_id', $user->id)
            ->whereHas('course_details', function($q) use ($request) {
                $q->where('course_type', 2);
                 if(!empty($request->instructor_category_id)){
                  $q->where('category_id', $request->instructor_category_id);
                  }
            })
            ->where('status', 1)
            ->count();
        $instructor_pending_count = AsignedUser::where('user_id', $user->id)
            ->whereHas('course_details', function($q) use ($request) {
                $q->where('course_type', 2);
                if(!empty($request->instructor_category_id)){
                  $q->where('category_id', $request->instructor_category_id);
                  }
            })
            ->where('status', 0)
            ->count();

        $expired_count = AsignedUser::where('user_id', $user->id)->where('status', 0)
            ->whereHas('course_details', function($q) use ($request) {
                  if(!empty($request->category_id)){
                  $q->where('category_id', $request->category_id);
                  }
                  $q->whereDate('expiration_date', '<', now()->toDateString()); // Use `now()` for current date
            }) 
            ->count();

            $instructor_expired_count = AsignedUser::where('user_id', $user->id)->where('status', 0)
            ->whereHas('course_details', function($q) use ($request) {
                $q->where('course_type', 2);
                  if(!empty($request->instructor_category_id)){
                  $q->where('category_id', $request->instructor_category_id);
                  }
                  $q->whereDate('expiration_date', '<', now()->toDateString()); // Use `now()` for current date
            }) 
            ->count();

            $certificate_count = Asigneduser::where('user_id',Auth::user()->id)->where('status',3)->whereHas('course_details', function($q) use ($request) {
            if(!empty($request->certificate_category_id)){
              $q->where('category_id', $request->certificate_category_id);
            }
             })->count();

          //dd($certificate_count);

$filter = $request->get('day_learn_filter', 'this_month'); // default filter to 'this_month'
    
$activities_query = Activity::where('user_id', Auth::user()->id)
    ->orderBy('created_at');

// Apply filter based on selected filter type
if ($filter == 'day') {
    // Get today's activities only
    $activities_query->whereDate('created_at', Carbon::today());
} elseif ($filter == 'past_week') {
    // Get activities for the last full week (Sunday to Saturday)
    $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek(); // Previous Sunday
    $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();     // Previous Saturday

    $activities_query->whereBetween('created_at', [
        $startOfLastWeek,
        $endOfLastWeek
    ]);
} elseif ($filter == 'this_month') {
    // Get activities for the current month
    $activities_query->whereYear('created_at', Carbon::now()->year)
        ->whereMonth('created_at', Carbon::now()->month);
}

// Get filtered activities
$activities_data = $activities_query->get();

// Initialize variables to hold login times and total working hours for each day
$working_hours = [];
$login_time = null;

foreach ($activities_data as $activity) {
    // Check if the activity is a login (activity_type = 1)
    if ($activity->type == 1) {
        // Store the login time
        $login_time = Carbon::parse($activity->created_at);
    }

    // Check if the activity is a logout (activity_type = 2) and we have a valid login time
    if ($activity->type == 2 && $login_time) {
        // Store the logout time and calculate the duration in minutes
        $logout_time = Carbon::parse($activity->created_at);
        $duration = $logout_time->diffInMinutes($login_time); // Duration in minutes

        // Get the date for the login/logout
        $date = $login_time->format('Y-m-d');

        // Add the duration to the working hours for the specific date
        if (!isset($working_hours[$date])) {
            $working_hours[$date] = 0;
        }
        $working_hours[$date] += $duration;

        // Reset the login time for the next pair
        $login_time = null;
    }
}

// dd($working_hours); // Uncomment to debug and see the working hours for each day


    // Prepare the data for the graph
    $dates = array_keys($working_hours);
    $hours = array_values($working_hours);


        return view('user.organization_dashboard',compact('request','recently','bookmark','expired','due_soon','recently_assign','xvalues','assignedyvalues','loginyvalues','total_courses','completed_course','inprogress_count','pending_count','instructor_lead','user','expired_count','categories','secondLastLogin','instructor_completed_course','instructor_inprogress_count','instructor_pending_count','instructor_expired_count','certificate_count','dates', 'loginCounts','roles','dates', 'hours'));
    }


    public function mycourse_catalog()
    {
        //dd(Auth::user()->id);

     if (Auth::check()) {
  
     $categories = Category::with(['assigned_user'=>function($q){
         $q->where('user_id', '=', Auth::user()->id);
     }])->whereHas('assigned_user', function ($query) {
                       $query->where('user_id', Auth::user()->id);
                     })->get();

 $assigned_latest_course = CourseVideoProgress::with('Assign_userdetails')->where('user_id', Auth::user()->id)
    ->orderBy('updated_at', 'desc')
    ->first();
    //dd($assigned_latest_course);

        return view('user.mycourse_catalog',compact('categories','assigned_latest_course'));
} else {

    return redirect()->route('login');
}
}

      public function mycourse_videos(Request $request)
    {
         $courses = Courses::where('id', $request->id)->first();
            $videoId = $courses->content_type_upload; 
        return view('user.course_videos',compact('courses','videoId'));
    }


    public function authenticate(Request $request)
    {
         if (auth()->user()->user_type == 1) {
        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            return redirect('users')->with('error', 'Email already exists.');
        }

        $hashedPassword = Hash::make($request->password);
        $userData = $request->except('_token');
        $userData['password'] = $hashedPassword; 
        $user = User::create($userData);

        return redirect('users')->with('success', 'User registered successfully.');
    } else {
        return redirect('users')->with('error', 'You are not authorized to perform this action.');
    }
}
    


    public function logout()
    {
        Auth::logout();
        return redirect('/');

    }

    public function saveVideoTime(Request $request) {
    // dd($request->all());
    $user = Auth::user();
    $courseId = $request->input('course_id');
    $videoTime = $request->input('video_time_played');
    $videoProgress = CourseVideoProgress::where('user_id', $user->id)
                                       ->where('course_id', $courseId)
                                       ->first();

    if (!$videoProgress) {
        $videoProgress = new CourseVideoProgress(); 
        $videoProgress->user_id = $user->id;
        $videoProgress->course_id = $courseId;
    }

    $videoProgress->video_time_played = $videoTime;
    $videoProgress->save();

    return response()->json(['success' => true]);
}

 public function getVideoPlaybackTime(Request $request)
    {
        //dd(request->all());
        $courseId = $request->input('course_id');
        $videoProgress = CourseVideoProgress::where('user_id',Auth::user()->id)->where('course_id', $courseId)
                                            ->first();
        if ($videoProgress) {
            $videoPlaybackTime = $videoProgress->video_time_played;
        } else {
            $videoPlaybackTime = 0;
        }
        return response()->json(['video_time_played' => $videoPlaybackTime]);
    }


    public function markAllNotificationsAsRead(Request $request)
    {
        $user = Auth::user();
        Notifications::where('user_id', $user->id)->update(['status' => 1]);

        return response()->json(['message' => 'All notifications marked as read.']);
    }
    public function user_courses(Request $request)
    {
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
                $q->where('course_type',1);
            }
            else{
               $q->where('course_type',1);
            }
        })->where(function($q) use($request){
            if(!empty($request->category_id)){
                $q->where('category_id',$request->category_id);
            }
           

        })->with('bookmark_data');

        if($request->bookmark==1){
           $list =$list->has('bookmark_data'); 
        }

        if($request->assign_status==3){
            
           $list =$list->where('status',3); 
        }elseif($request->assign_status ==0 &&  $request->assign_status!=""){
            // dd('hii');
          $list =$list->where('status',0); 
        }else{
        //dd('hi');
        }

        if($request->assign_status==3){
             //dd('hi');
           $list =$list->where('status',3); 
        }

        
         if($request->menu=='progress'){
           // $list =$list->has('scorm_details'); 
             $list =$list->where('status',1); 

        }
        $list =$list->orderBy('id','desc')->get();
      $courses_data = Asigneduser::with(['course_details','category_details'])->where('user_id',Auth::user()->id)->orderBy('id','desc')->where('id',0)->first();
        //   dd($courses_data);


        $category_list=Category::whereHas('category_assigned_cousers')->get();

        $category_view = Category::with(['category_assigned_cousers'=>function($q){
            $q->where('user_id',Auth::user()->id);
        }])->whereHas('category_assigned_cousers', function ($query) {
                       $query->where('user_id', Auth::user()->id);
                            $query->where('status','!=',3);
                     })->where(function($q) use($request){
            if(!empty($request->category_id)){
                $q->where('id',$request->category_id);
            }
        })->whereHas('category_assigned_cousers.course_details', function ($q) use($request) {

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

        })->orderBy('category_name','ASC')->get();

        // $countlist = Asigneduser::has('course_details')->has('category_details')->where('user_id',Auth::user()->id)->get();
        $countlist = Asigneduser::with(['course_details', 'category_details'])
        ->where('user_id', Auth::id())
        ->get();
        // dd($countlist);


    $assigned_category_ids = Asigneduser::where('user_id', Auth::id())
        ->whereNotNull('category_id')
        ->pluck('category_id')
        ->unique();
        // dd($assigned_category_ids);

    $feedback_ratings = FeedbackRatingsSetting::where('is_active', 1)
        ->where('type', 2)
        ->whereIn('category_id', $assigned_category_ids)
        ->whereHas('category', function ($q) {
            $q->where('status', 1);
        })
        ->whereHas('course', function ($q) {
            $q->where('active', 1);
        })
        ->get();

    // dd($feedback_ratings);

        
         return view('user.courses.index',compact('list','courses_data','category_list','category_view','request','countlist','feedback_ratings'));
    }
    public function get_assign_course_data(Request $request)
    {
       $courses_data = Asigneduser::with([
            'course_details.assessments' => function ($q) {
                $q->where('is_active', 1);
            }
        ])
        ->has('course_details')
        ->has('category_details')
        ->where('user_id', Auth::id())
        ->where('id', $request->assign_id)
        ->first();


        //  dd($courses_data);

         
         $category_list=Category::get();
         $requiredAssessmentVideoIds = $this->requiredAssessmentVideoIds($courses_data->course_id);
         $assessmentVideoAccessGranted = $this->hasCompletedAllRequiredVideos(
             $courses_data->id,
             Auth::id(),
             $requiredAssessmentVideoIds
         );
         $feedbackRatings = FeedbackRatingsSetting::where('is_active', 1)
             ->where('type', 2)
             ->where('category_id', $courses_data->category_id)
             ->where('course_id', $courses_data->course_id)
             ->whereHas('category', function ($q) {
                 $q->where('status', 1);
             })
             ->whereHas('course', function ($q) {
                 $q->where('active', 1);
             })
             ->where(function ($query) {
                 $query->where('rating_enabled', 1)
                     ->orWhere('feedback_enabled', 1);
             })
             ->orderBy('id', 'desc')
             ->get();
         $employeeFeedbackRatings = EmployeeFeedbackRating::where('employee_id', Auth::id())
             ->where('course_id', $courses_data->course_id)
             ->where('category_id', $courses_data->category_id)
             ->where('type', 2)
             ->whereIn('feedback_rating_setting_id', $feedbackRatings->pluck('id'))
             ->get()
             ->keyBy('feedback_rating_setting_id');

         // Gather assessment & exam attempts for this course & user to build Reports data
         $courseDocIds = Course_documents::where('course_id', $courses_data->course_id)
             ->where('type', 6)
             ->where('is_delete', 0)
             ->pluck('id');

         $assessmentResults = Assessment_results::where('user_id', Auth::id())
             ->where(function($q) use ($courses_data, $courseDocIds) {
                 $q->where('assign_id', $courses_data->id)
                   ->orWhereIn('course_document_id', $courseDocIds);
             })
             ->whereNull('deleted_at')
             ->orderBy('id', 'asc')
             ->get();

         $examAttempts = ExamAttempt::where('user_id', Auth::id())
             ->where(function($q) use ($courses_data) {
                 $q->where('assigned_id', $courses_data->id)
                   ->orWhere('course_id', $courses_data->course_id);
             })
             ->orderBy('id', 'asc')
             ->get();

         // 1. Total Learning Time (Time on Exam)
         $totalSeconds = 0;
         foreach ($assessmentResults as $res) {
             $sec = 0;
             if (!empty($res->total_time_taken) && is_numeric($res->total_time_taken)) {
                 $sec = (int)$res->total_time_taken;
             } elseif (!empty($res->completed_at) && !empty($res->created_at)) {
                 $sec = max(0, Carbon::parse($res->completed_at)->diffInSeconds(Carbon::parse($res->created_at)));
             }
             $totalSeconds += $sec;
         }
         foreach ($examAttempts as $att) {
             if (!empty($att->total_time) && is_numeric($att->total_time)) {
                 $totalSeconds += ((int)$att->total_time) * 60;
             }
         }

         if ($totalSeconds >= 3600) {
             $hours = floor($totalSeconds / 3600);
             $minutes = floor(($totalSeconds % 3600) / 60);
             $totalTimeFormatted = $hours . ' hr ' . $minutes . ' min';
         } elseif ($totalSeconds >= 60) {
             $minutes = floor($totalSeconds / 60);
             $seconds = $totalSeconds % 60;
             $totalTimeFormatted = $minutes . ' min' . ($seconds > 0 ? ' ' . $seconds . ' sec' : '');
         } elseif ($totalSeconds > 0) {
             $totalTimeFormatted = $totalSeconds . ' sec';
         } else {
             $totalTimeFormatted = '0 min';
         }

         // First Accessed & Last Accessed Date & Time
         $earliestDate = null;
         if ($assessmentResults->isNotEmpty()) {
             $earliestDate = $assessmentResults->min('created_at');
         }
         if ($examAttempts->isNotEmpty()) {
             $examMin = $examAttempts->min('created_at');
             if (!$earliestDate || ($examMin && $examMin < $earliestDate)) {
                 $earliestDate = $examMin;
             }
         }
         $firstAccessedFormatted = $earliestDate ? Carbon::parse($earliestDate)->format('d M Y, h:i A') : 'Not Yet Accessed';

         $latestDate = null;
         foreach ($assessmentResults as $res) {
             $d = $res->completed_at ?? $res->created_at;
             if (!$latestDate || ($d && $d > $latestDate)) {
                 $latestDate = $d;
             }
         }
         foreach ($examAttempts as $att) {
             $d = $att->evaluation_completed_date ?? ($att->updated_at ?? $att->created_at);
             if (!$latestDate || ($d && $d > $latestDate)) {
                 $latestDate = $d;
             }
         }
         $lastAccessedFormatted = $latestDate ? Carbon::parse($latestDate)->format('d M Y, h:i A') : 'Not Yet Accessed';

         // 2. Assessments: No. of Attempts, Passed / Failed / Not Attempted, Highest & Lowest Score
         $attemptCount = $assessmentResults->count() + $examAttempts->count();

         $hasAnyPassed = false;
         foreach ($assessmentResults as $res) {
             if (method_exists($res, 'hasPassed') && $res->hasPassed()) {
                 $hasAnyPassed = true;
                 break;
             } else {
                 $payload = json_decode($res->result_data ?? '', true);
                 $details = $payload['results'] ?? json_decode($res->results ?? '', true);
                 $pf = strtolower(trim((string)($details['pass_or_fail'] ?? '')));
                 if ($pf === 'passed' || (isset($details['percentage'], $details['cutoff']) && (float)$details['percentage'] >= (float)$details['cutoff'])) {
                     $hasAnyPassed = true;
                     break;
                 }
             }
         }

         if (!$hasAnyPassed) {
             foreach ($examAttempts as $att) {
                 if (strtolower(trim($att->exam_result ?? '')) === 'passed') {
                     $hasAnyPassed = true;
                     break;
                 }
             }
         }

         if ($hasAnyPassed) {
             $passedInAttempt = 'Passed';
         } elseif ($attemptCount > 0) {
             $passedInAttempt = 'Failed';
         } else {
             $passedInAttempt = 'Not Attempted';
         }

         $scores = [];
         $attemptHistory = [];
         $itemIndex = 1;

         foreach ($assessmentResults as $res) {
             $payload = json_decode($res->result_data ?? '', true);
             $details = $payload['results'] ?? json_decode($res->results ?? '', true);
             $score = null;
             $status = 'Failed';

             if (isset($details['percentage']) && is_numeric($details['percentage'])) {
                 $score = round((float)$details['percentage'], 1);
                 $scores[] = $score;
             }

             if (method_exists($res, 'hasPassed') && $res->hasPassed()) {
                 $status = 'Passed';
             } else {
                 $pf = strtolower(trim((string)($details['pass_or_fail'] ?? '')));
                 if ($pf === 'passed') {
                     $status = 'Passed';
                 }
             }

             $sec = !empty($res->total_time_taken) && is_numeric($res->total_time_taken) ? (int)$res->total_time_taken : 0;
             $timeTakenText = $sec >= 60 ? floor($sec / 60) . ' min ' . ($sec % 60) . ' sec' : ($sec > 0 ? $sec . ' sec' : '-');

             $attemptHistory[] = [
                 'attempt' => $itemIndex++,
                 'type' => 'Assessment',
                 'date' => $res->created_at ? Carbon::parse($res->created_at)->format('d M Y, h:i A') : '-',
                 'time_taken' => $timeTakenText,
                 'score' => $score !== null ? $score . '%' : '-',
                 'status' => $status
             ];
         }

         foreach ($examAttempts as $att) {
             $score = null;
             if (isset($att->percentage) && is_numeric($att->percentage)) {
                 $score = round((float)$att->percentage, 1);
                 $scores[] = $score;
             }
             $status = ucfirst(strtolower(trim($att->exam_result ?? 'Pending')));

             $attemptHistory[] = [
                 'attempt' => $itemIndex++,
                 'type' => 'Assignment',
                 'date' => $att->created_at ? Carbon::parse($att->created_at)->format('d M Y, h:i A') : '-',
                 'time_taken' => !empty($att->total_time) ? $att->total_time . ' min' : '-',
                 'score' => $score !== null ? $score . '%' : '-',
                 'status' => $status
             ];
         }

         $highestScore = !empty($scores) ? max($scores) . '%' : '-';
         $lowestScore = !empty($scores) ? min($scores) . '%' : '-';

         $reportData = [
             'total_time' => $totalTimeFormatted,
             'first_accessed' => $firstAccessedFormatted,
             'last_accessed' => $lastAccessedFormatted,
             'attempt_count' => $attemptCount,
             'passed_in' => $passedInAttempt,
             'highest_score' => $highestScore,
             'lowest_score' => $lowestScore,
             'attempt_history' => $attemptHistory
         ];

         $html = view('user.courses.ajax_page', compact(
             'courses_data',
             'category_list',
             'requiredAssessmentVideoIds',
             'assessmentVideoAccessGranted',
             'feedbackRatings',
             'employeeFeedbackRatings',
             'reportData'
         ))->render();
         return $html;
    }
    public function category_courses(Request $request)
    {
        $category_view = Category::with(['category_assigned_cousers'=>function($q){
            $q->where('user_id',Auth::user()->id);
        }])->whereHas('category_assigned_cousers', function ($query) {
                       $query->where('user_id', Auth::user()->id);
                     })->where('id',$request->id)->first();
         return view('user.category_courses',compact('category_view'));
    }
    public function start_course(Request $request)
    {

        //   $courses_data = Asigneduser::has('course_details')->with(['course_details.assessments'=>function($q){
        //       $q->where('is_delete',0);
        //       }])->has('category_details')->where('user_id',Auth::user()->id)->where('id',$request->id)->orderBy('id','desc')->first();
            $courses_data = Asigneduser::with([
                    'course_details.assessments',
                    'category_details'
                ])
                ->where('user_id', Auth::id())
                ->where('id', $request->id)
            ->firstOrFail();
          abort_unless($courses_data->course_details && $courses_data->category_details, 404, 'Course details are unavailable.');
          $category_courses = Asigneduser::has('course_details')->has('category_details')->where('user_id',Auth::user()->id)->where('id','!=',$request->id)->where('category_id',$courses_data->category_id??0)->orderBy('id','desc')->get();
          Recently_view::updateOrCreate(['assign_id'=>$request->id,'user_id'=>Auth::user()->id],['view_time'=>now()]);
          if($courses_data->status !=3){

              if($courses_data->status ==0){
               ActivityLog::log(auth()->user(), 'Started a course: ' . $courses_data->course_details->course_name,0);
              }else{
               ActivityLog::log(auth()->user(), 'Resumed a course: ' . $courses_data->course_details->course_name,0);

              }



             Asigneduser::where('id',$request->id)->update(['status'=>1]);
          }


          foreach ($courses_data->course_details->only_scorm as $key => $value) {
              if(!file_exists(storage_path('app/public/scrom_videos/'.$value->id.'/story.html')) && file_exists(storage_path('app/public/'.$value->file_path))){
                if(!file_exists(storage_path('app/public/scrom_videos/'.$value->id))){
                mkdir(storage_path('app/public/scrom_videos/'.$value->id),0777); }
                $zip = Zip::open(storage_path('app/public/'.$value->file_path));
                $zip->extract(storage_path('app/public/scrom_videos/'.$value->id));
              }
          }
          $scorm_progress = Scorm_data::where('course_id',$request->id)->where('user_id',Auth::user()->id)->first();
          $scormProgressByDocument = Scorm_data::where('course_id', $request->id)
              ->where('user_id', Auth::id())
              ->whereNotNull('video_id')
              ->get()
              ->keyBy('video_id');
          if(!empty($scorm_progress)){
                $scorm_data = ['student_name'=>Auth::user()->first_name,'student_id'=>Auth::user()->id,'suspend_data'=>$scorm_progress->suspend_data,'total_time'=>$scorm_progress->total_time,'lesson_location'=>$scorm_progress->lesson_location,'lesson_status'=>$scorm_progress->lesson_status,'datafromlms'=>$scorm_progress->datafromlms,'score_raw'=>$scorm_progress->score_raw,'commit_url'=>url('update_scorm_progress')."?id=".$request->id,'entry'=>'resume','course_id'=>$request->id];
            }else{
                $scorm_data = ['student_name'=>Auth::user()->first_name,'student_id'=>Auth::user()->id,'suspend_data'=>'','total_time'=>'','lesson_location'=>'','lesson_status'=>'incomplete','datafromlms'=>'','score_raw'=>'','commit_url'=>url('update_scorm_progress')."?id=".$request->id,'entry'=>'resume','course_id'=>$request->id];
            }

          $scormDocument = $courses_data->course_details->only_scorm->first();
          if ($scormDocument) {
              $scorm_data['commit_url'] .= '&document_id=' . $scormDocument->id;
          }

          $requiredAssessmentVideoIds = $this->requiredAssessmentVideoIds($courses_data->course_id);
          $assessmentVideoAccessGranted = $this->hasCompletedAllRequiredVideos(
              $courses_data->id,
              Auth::id(),
              $requiredAssessmentVideoIds
          );

         return view('user.start_course',compact(
             'courses_data',
             'category_courses',
             'scorm_data',
             'scormProgressByDocument',
             'requiredAssessmentVideoIds',
             'assessmentVideoAccessGranted'
         ));
    }
    public function activity(Request $request)
    {

        $activities_data = Activity::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        //dd( $activities_data);

         return view('user.activity',compact('activities_data'));
    }
    public function add_remove_bookmark(Request $request)
    {
        $data = Bookmark::where('assign_id',$request->assign_id)->first();
        if(!empty($data)){
            Bookmark::where('assign_id',$request->assign_id)->delete();
            $list=['html'=>'<i class="fa-regular fa-star"></i>','status'=>0];
            return json_encode($list);
        }else{
            Bookmark::create(['assign_id'=>$request->assign_id,'user_id'=>Auth::user()->id]);
             $list=['html'=>'<i class="fa-solid fa-star"></i>','status'=>1];
            return json_encode($list);
        }
    }
    public function update_scorm_progress(Request $request)
    {
        $documentId = $request->filled('document_id') ? (int) $request->document_id : null;
        $progressKey = ['course_id' => $request->id, 'user_id' => Auth::id()];
        if ($documentId) {
            $progressKey['video_id'] = $documentId;
        }

        $existingProgress = Scorm_data::where($progressKey)->first();
        $previousStatus = strtolower((string) optional($existingProgress)->lesson_status);
        $currentStatus = strtolower((string) $request->lesson_status);

        Scorm_data::updateOrCreate($progressKey,['suspend_data'=>$request->suspend_data,'total_time'=>$request->total_time,'lesson_location'=>$request->lesson_location,'lesson_status'=>$request->lesson_status,'datafromlms'=>$request->datafromlms,'score'=>$request->score_raw,'entry'=>$request->entry]);

        $access = null;
        $terminalStatuses = ['completed', 'passed', 'failed'];
        if ($documentId
            && in_array($currentStatus, $terminalStatuses, true)
            && !in_array($previousStatus, $terminalStatuses, true)) {
            $access = $this->recordCompletedAssessmentVideo(
                (int) $request->id,
                $documentId,
                Auth::id()
            );
        }

        return response()->json($access ?: ['access_granted' => false]);
    }

    public function completeAssessmentVideo(Request $request)
    {
        $validated = $request->validate([
            'assign_id' => ['required', 'integer'],
            'document_id' => ['required', 'integer'],
        ]);

        $access = $this->recordCompletedAssessmentVideo(
            (int) $validated['assign_id'],
            (int) $validated['document_id'],
            Auth::id()
        );

        return response()->json($access);
    }

    public function launchCourseAssessment(Request $request)
    {
        $validated = $request->validate([
            'assign_id' => ['required', 'integer'],
            'assessment_id' => ['required', 'integer'],
            'return_url' => ['nullable', 'string'],
        ]);

        return DB::transaction(function () use ($validated, $request) {
            $assignment = Asigneduser::where('id', $validated['assign_id'])
                ->where('user_id', Auth::id())
                ->lockForUpdate()
                ->firstOrFail();

            $assessment = Course_documents::where('id', $validated['assessment_id'])
                ->where('course_id', $assignment->course_id)
                ->where('type', 6)
                ->where('is_active', 1)
                ->where('is_delete', 0)
                ->firstOrFail();

            if ($assessment->expiration_date
                && Carbon::parse($assessment->expiration_date)->startOfDay()->lte(now()->startOfDay())) {
                return response()->json(['message' => 'This assessment has expired.'], 422);
            }

            $results = Assessment_results::where('course_document_id', $assessment->id)
                ->where('assign_id', $assignment->id)
                ->where('user_id', Auth::id())
                ->get();

            if ($results->count() >= 3) {
                return response()->json(['message' => 'Maximum of 3 assessment attempts reached.'], 422);
            }

            $alreadyPassed = $results->contains(fn ($result) => $result->hasPassed());

            if ($alreadyPassed) {
                return response()->json(['message' => 'This assessment is already completed.'], 422);
            }

            $requiredVideoIds = $this->requiredAssessmentVideoIds($assignment->course_id);
            if (!$this->hasCompletedAllRequiredVideos($assignment->id, Auth::id(), $requiredVideoIds)) {
                    return response()->json([
                        'message' => 'Watch every course video completely before taking an assessment.',
                    ], 422);
            }

            $returnUrl = $request->input('return_url');
            if (empty($returnUrl)) {
                $referer = $request->header('referer');
                if ($referer && !str_contains($referer, 'launch_course_assessment') && !str_contains($referer, 'get_assign_course_data')) {
                    $returnUrl = $referer;
                } else {
                    $returnUrl = url('start_course?id=' . $assignment->id);
                }
            }

            $assessmentBaseUrl = config('app.assessment_url', env('ASSESSMENT_URL', 'http://127.0.0.1:8001'));
            $launchUrl = rtrim($assessmentBaseUrl, '/') . '/start_assessment?' . http_build_query([
                'url' => $assessment->file_path,
                'email' => Auth::user()->email,
                'username' => Auth::user()->username,
                'first_name' => Auth::user()->first_name,
                'last_name' => Auth::user()->emp_id,
                'course_id' => $assessment->id,
                'assign_id' => $assignment->id,
                'return_url' => $returnUrl,
                'lms_url' => url('/'),
                'ts' => time(),
            ], '', '&', PHP_QUERY_RFC3986);

            return response()->json(['launch_url' => $launchUrl]);
        });
    }

    private function recordCompletedAssessmentVideo(int $assignId, int $documentId, int $userId): array
    {
        return DB::transaction(function () use ($assignId, $documentId, $userId) {
            $assignment = Asigneduser::where('id', $assignId)
                ->where('user_id', $userId)
                ->lockForUpdate()
                ->firstOrFail();

            $requiredIds = $this->requiredAssessmentVideoIds($assignment->course_id);

            abort_unless($requiredIds->contains($documentId), 422, 'This video is not required for the assigned course.');

            $access = AssessmentVideoAccess::where('user_id', $userId)
                ->where('assign_id', $assignment->id)
                ->whereNull('consumed_at')
                ->lockForUpdate()
                ->latest('id')
                ->first();

            if (!$access) {
                $access = AssessmentVideoAccess::create([
                    'user_id' => $userId,
                    'assign_id' => $assignment->id,
                    'course_id' => $assignment->course_id,
                    'completed_video_ids' => [],
                ]);
            }

            $completedIds = collect($access->completed_video_ids ?: [])
                ->push($documentId)
                ->map(fn ($id) => (int) $id)
                ->unique()
                ->values();
            $granted = $requiredIds->diff($completedIds)->isEmpty();

            $access->update([
                'completed_video_ids' => $completedIds->all(),
                'granted_at' => $granted ? ($access->granted_at ?: now()) : null,
            ]);

            return [
                'access_granted' => $granted,
                'completed_videos' => $completedIds->count(),
                'required_videos' => $requiredIds->count(),
            ];
        });
    }

    private function requiredAssessmentVideoIds(int $courseId)
    {
        return Course_documents::where('course_id', $courseId)
            ->where('is_active', 1)
            ->where('is_delete', 0)
            ->where(function ($query) {
                $query->where('type', 4)
                    ->orWhereNotIn('type', [4, 5, 6, 7]);
            })
            ->pluck('id')
            ->map(fn ($id) => (int) $id)
            ->values();
    }

    private function hasCompletedAllRequiredVideos(int $assignId, int $userId, $requiredIds): bool
    {
        if ($requiredIds->isEmpty()) {
            return true;
        }

        $assignment = Asigneduser::where('id', $assignId)
            ->where('user_id', $userId)
            ->first();

        // 1. Completed assignments remain unlocked even when older video progress is missing.
        if ($assignment && $assignment->status == 3) {
            return true;
        }

        // 2. If user already has any assessment results (attempted or passed) for this assignment or course, access is granted
        if ($assignment) {
            $hasAssessmentResult = Assessment_results::where('user_id', $userId)
                ->where(function ($q) use ($assignId, $assignment) {
                    $q->where('assign_id', $assignId);
                    if (!empty($assignment->course_id)) {
                        $docIds = Course_documents::where('course_id', $assignment->course_id)->where('type', 6)->pluck('id');
                        if ($docIds->isNotEmpty()) {
                            $q->orWhereIn('course_document_id', $docIds);
                        }
                    }
                })
                ->exists();

            if ($hasAssessmentResult) {
                return true;
            }
        }

        // 3. Check AssessmentVideoAccess record by assign_id or course_id
        $courseId = $assignment ? $assignment->course_id : null;
        $access = AssessmentVideoAccess::where('user_id', $userId)
            ->where(function ($q) use ($assignId, $courseId) {
                $q->where('assign_id', $assignId);
                if ($courseId) {
                    $q->orWhere('course_id', $courseId);
                }
            })
            ->latest('id')
            ->first();

        if ($access) {
            $completedIds = collect($access->completed_video_ids ?: [])
                ->map(fn ($id) => (int) $id)
                ->unique();

            if ($requiredIds->diff($completedIds)->isEmpty()) {
                return true;
            }
        }

        // 4. Check Scorm_data for completion status (lesson_status = 'completed' or 'passed')
        if ($courseId) {
            $scormCompleted = Scorm_data::where('user_id', $userId)
                ->where(function ($q) use ($assignId, $courseId) {
                    $q->where('course_id', $assignId)
                      ->orWhere('course_id', $courseId);
                })
                ->where(function ($q) {
                    $q->whereIn('lesson_status', ['completed', 'passed', 'complete']);
                })
                ->exists();

            if ($scormCompleted) {
                return true;
            }
        }

        return false;
    }

public function userslist(Request $request)
{
    
    $currentUserId = Auth::user()->emp_id;
    $users = User::with('roles')
        ->where('reporting_manager1', '=', $currentUserId)
        ->orWhere('reporting_manager2', '=', $currentUserId)
        ->orWhere('team_lead', '=', $currentUserId)
        ->get();
        // dd($users);

    $reportingManagerIds = $users->pluck('emp_id')->toArray();
    // dd($reportingManagerIds);

    $additionalUsers = User::with('roles')
        ->whereIn('reporting_manager1', $reportingManagerIds)
        ->orWhereIn('reporting_manager2', $reportingManagerIds)
        ->orWhereIn('team_lead', $reportingManagerIds)
        ->get();

    $allUsers = $users->merge($additionalUsers)->unique('emp_id'); 
    // dd($allUsers);

    foreach ($allUsers as $user) {
      
        $userTypes = json_decode($user->user_type, true); 
        // dd($userTypes);

        if (is_array($userTypes) && count($userTypes) > 0) {
            $roles = Roles::whereIn('id', $userTypes)->pluck('role')->toArray();
            $user->role_names = $roles;
        } else {
            $user->role_names = [];
        }
    }

    return view('user.Myteam.userslist', compact('allUsers'));
}


//    public function fetch_myteam_userdetails(Request $request)
// {
//     $user = User::findOrFail($request->user_id);

//     $users_lists = User::with(['assigned_users' => function ($q) use ($user) {
//         $q->where('course_id', $user->id);
//     }])->where('active', 1)->get();

//     $assignedUser = Asigneduser::where('user_id', $user->id)->get();

//     // BASE JOIN
//     $base = AsignedUser::with([
//             'course_details.assessments' => function ($q) {
//                 $q->where('is_active', 1);
//             }
//         ])->leftJoin('tbl_courses', 'tbl_courses.id', '=', 'tbl_assignedusers.course_id')
//         ->where('tbl_assignedusers.user_id', $user->id);

//     // TOTAL
//     $total_courses = (clone $base)->count();

//     // COMPLETED
//     $completed_course = (clone $base)
//         ->where('tbl_assignedusers.status', 3)
//         ->count();

//     // IN PROGRESS
//     $inprogress_count = (clone $base)
//         ->where('tbl_assignedusers.status', 1)
//         ->where(function ($q) {
//             $q->where('tbl_courses.course_type', 1)
//               ->orWhereNull('tbl_courses.id');
//         })
//         ->count();

//     // PENDING
//     $pending_count = (clone $base)
//         ->where('tbl_assignedusers.status', 0)
//         ->where(function ($q) {
//             $q->where('tbl_courses.course_type', 1)
//               ->orWhereNull('tbl_courses.id');
//         })
//         ->count();

//     // INSTRUCTOR 
//     $instructor_lead = (clone $base)
//         ->where('tbl_courses.course_type', 2)
//         ->count();

//     // OTHER DATA
//     $departments = Department::get();
//     $designations = Designation::get();

//     // ASSESSMENTS
//     $assessments = (clone $base)
//         ->where('tbl_courses.course_type', 1)
//         ->select('tbl_assignedusers.*')
//         ->get();

//     $html = view('user.Myteam.myteam_ajax', compact(
//         'user',
//         'users_lists',
//         'total_courses',
//         'inprogress_count',
//         'pending_count',
//         'instructor_lead',
//         'departments',
//         'designations',
//         'request',
//         'completed_course',
//         'assignedUser',
//         'assessments'
//     ))->render();

//     return $html;
// }

public function fetch_myteam_userdetails(Request $request)
{
    $user = User::findOrFail($request->user_id);

    // All counts in ONE query incorporating status codes (0=Pending, 1=In-progress, 2=Not attend, 3=Completed)
    $counts = AsignedUser::leftJoin('tbl_courses', 'tbl_courses.id', '=', 'tbl_assignedusers.course_id')
        ->where('tbl_assignedusers.user_id', $user->id)
        ->selectRaw("
            COUNT(*) as total_courses,
            SUM(CASE WHEN tbl_assignedusers.status = 3 THEN 1 ELSE 0 END) as completed_course,
            SUM(CASE WHEN tbl_assignedusers.status = 1 AND (tbl_courses.course_type = 1 OR tbl_courses.id IS NULL) THEN 1 ELSE 0 END) as inprogress_count,
            SUM(CASE WHEN (tbl_assignedusers.status = 0 OR tbl_assignedusers.status = 2) AND (tbl_courses.course_type = 1 OR tbl_courses.id IS NULL) THEN 1 ELSE 0 END) as pending_count,
            SUM(CASE WHEN tbl_courses.course_type = 2 THEN 1 ELSE 0 END) as instructor_lead
        ")->first();

    $total_courses    = $counts->total_courses;
    $completed_course = $counts->completed_course;
    $inprogress_count = $counts->inprogress_count;
    $pending_count    = $counts->pending_count;
    $instructor_lead  = $counts->instructor_lead;

    // Assessments with all needed relations eager loaded safely
    $assessments = AsignedUser::where('user_id', $user->id)
        ->whereHas('course_details', function ($q) {
            $q->where('course_type', 1);
        })
        ->with([
            'course_details.assessments' => fn($q) => $q->where('is_active', 1),
            'course_details.assignment_exam.assignment_exam_name',
        ])
        ->get();

    // Pull ALL assessment results for multiple attempts, sorted by latest first
    $assessmentIds = $assessments->flatMap(fn($a) => optional($a->course_details)->assessments ? $a->course_details->assessments->pluck('id') : [])->unique();
    
    $allResults = \App\Models\Assessment_results::where('user_id', $user->id)
        ->whereIn('course_document_id', $assessmentIds)
        ->orderBy('id', 'desc') // Get latest attempt first
        ->get()
        ->groupBy('course_document_id');

    // Pre-fetch ALL exam attempts, sorting by latest attempt so the 3rd/final try overrides previous fails
    $courseIds = $assessments->pluck('course_details.id')->filter()->unique();
    $examIds = $assessments->flatMap(fn($a) => optional($a->course_details)->assignment_exam ? $a->course_details->assignment_exam->map(fn($e) => optional($e->assignment_exam_name)->id) : [])->filter()->unique();
    $assignedUserIds = $assessments->pluck('id')->filter()->unique();

    $rawExamAttempts = \App\Models\ExamAttempt::whereIn('exam_id', $examIds)
        ->where(function($q) use ($user, $assignedUserIds, $courseIds) {
            $q->whereIn('assigned_id', $assignedUserIds)
              ->orWhere('user_id', $user->id)
              ->orWhereIn('course_id', $courseIds);
        })
        ->orderBy('id', 'desc') // Ensures latest attempt is prioritized
        ->get();

    $allExamAttempts = $rawExamAttempts->groupBy(function($e) use ($assessments) {
        $au = $assessments->firstWhere('id', $e->assigned_id);
        $realCourseId = $au ? $au->course_id : $e->course_id;
        return $e->exam_id . '_' . $realCourseId;
    });

    // Pre-fetch answer marks and question marks grouped
    $allAnswerMarks = \App\Models\Answer::whereIn('exam_attendance_id', $rawExamAttempts->pluck('id'))
        ->selectRaw('exam_attendance_id, SUM(answer_marks) as total')
        ->groupBy('exam_attendance_id')
        ->pluck('total', 'exam_attendance_id');

    $allQuestionMarks = \App\Models\Question::whereIn('exam_id', $examIds)
        ->selectRaw('exam_id, SUM(question_mark) as total')
        ->groupBy('exam_id')
        ->pluck('total', 'exam_id');

    $assignedUser = AsignedUser::where('user_id', $user->id)->get();
    $departments  = Department::get();
    $designations = Designation::get();
    $users_lists  = collect();

    $html = view('user.Myteam.myteam_ajax', compact(
        'user',
        'users_lists',
        'total_courses',
        'inprogress_count',
        'pending_count',
        'instructor_lead',
        'departments',
        'designations',
        'request',
        'completed_course',
        'assignedUser',
        'assessments',
        'allResults',
        'allExamAttempts',
        'allAnswerMarks',
        'allQuestionMarks'
    ))->render();

    return $html;
}




       public function showChangePasswordForm()
    {
        return view('user.changepassword');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Your current password does not match');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('password.change')->with('success', 'Password changed successfully');

    }
    public function mycompleted_courses(Request $request)
    {
        $list = Asigneduser::has('course_details')->has('category_details')->where('user_id',Auth::user()->id)->whereHas('course_details',function($q) use($request){
            if(!empty($request->search)){
                $q->where('course_name','like', '%' . $request->search . '%');
            }
            if(!empty($request->expire)){
                $date=date('Y-m-d');
                $q->whereDate('expiration_date','<=', date('Y-m-d
                    ',strtotime(date("Y-m-d", strtotime($date)) . " +".$request->expire." day")));
            }
        })->where(function($q) use($request){
            if(!empty($request->category_id)){
                $q->where('category_id',$request->category_id);
            }

        })->with('bookmark_data')->where('status',3);

        if($request->bookmark==1){
           $list =$list->has('bookmark_data'); 
        }
        $list = $list->orderBy('id','desc')->get()->filter(function ($assignment) {
            if (!$assignment->isCompletedAndPassed()) {
                $assignment->update(['status' => 1]);
                return false;
            }
            return true;
        })->values();
         $courses_data = Asigneduser::has('course_details')->has('category_details')->where('user_id',Auth::user()->id)->orderBy('id','desc')->where('id',$list[0]->id??0)->first();


        $category_list=Category::get();
        $category_view = Category::with(['category_assigned_cousers'=>function($q){
            $q->where('user_id',Auth::user()->id);
        }])->whereHas('category_assigned_cousers', function ($query) {
                       $query->where('user_id', Auth::user()->id);
                       $query->where('status',3);
                     })->where(function($q) use($request){
            if(!empty($request->category_id)){
                $q->where('id',$request->category_id);
            }

        })->get();
        return view('user.myprogress',compact('list','courses_data','category_view','category_list','request'));
    }

    // public function update_assessment_result(Request $request)
    // {
    //     $user= User::where('email',$request->email)->first();
    //     $list=json_decode($request->results);
       
    //   $data = Assessment_results::create(['course_document_id'=>$request->course_id, 'assign_id'=>$request->assign_id, 'user_id'=>$user->id??0, 'result_data'=>$request->results, 'code'=>$list->code, 'total_time_taken'=>$list->total_time_taken, 'results'=>json_encode($list->results), 'completed_at'=>$list->completed_at, 'status'=>$list->status,'quiz_data'=>$request->quiz]);
    // //   Asigneduser::where('id',$request->assign_id)->update(['status'=>3,'completed_on'=>$list->completed_at]);
    //   return json_encode($data);
    // }
    
    public function update_assessment_result(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'course_id' => ['required', 'integer'],
            'assign_id' => ['required', 'integer'],
            'results' => ['required', 'json'],
        ]);

        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            \Log::error('User NOT FOUND', ['email' => $request->email]);
            return response()->json(['error' => 'User not found'], 404);
        }
    
        // Decode results
        $list = json_decode($request->results);
    
        if (!$list) {
            \Log::error('Invalid results JSON');
            return response()->json(['error' => 'Invalid results'], 400);
        }
    
        $assessment = Course_documents::where('id', $request->course_id)
            ->where('type', 6)
            ->where('is_active', 1)
            ->first();

        if (!$assessment) {
            return response()->json(['error' => 'Assessment is not available'], 404);
        }

        return DB::transaction(function () use ($request, $user, $list, $assessment) {
            $assigned = Asigneduser::where('id', $request->assign_id)
                ->where('user_id', $user->id)
                ->where('course_id', $assessment->course_id)
                ->lockForUpdate()
                ->first();

            if (!$assigned) {
                \Log::error('Assigned user NOT FOUND', [
                    'assign_id' => $request->assign_id,
                    'user_id' => $user->id,
                    'assessment_id' => $assessment->id,
                ]);

                return response()->json(['error' => 'Course assignment not found'], 404);
            }

            $requiredVideoIds = $this->requiredAssessmentVideoIds($assigned->course_id);
            if (!$this->hasCompletedAllRequiredVideos($assigned->id, $user->id, $requiredVideoIds)) {
                    return response()->json([
                        'error' => 'Watch every course video completely before taking an assessment.',
                    ], 422);
            }

            $attemptCount = Assessment_results::where('course_document_id', $assessment->id)
                ->where('user_id', $user->id)
                ->where('assign_id', $assigned->id)
                ->count();

            if ($attemptCount >= 3) {
                return response()->json([
                    'error' => 'Maximum of 3 assessment attempts reached',
                    'attempt_count' => $attemptCount,
                ], 422);
            }

            $data = Assessment_results::create([
                'course_document_id' => $assessment->id,
                'assign_id' => $assigned->id,
                'user_id' => $user->id,
                'result_data' => $request->results,
                'code' => $list->code ?? null,
                'total_time_taken' => $list->total_time_taken ?? null,
                'results' => json_encode($list->results ?? []),
                'completed_at' => $list->completed_at ?? now(),
                'status' => $list->status ?? null,
                'quiz_data' => $request->quiz,
            ]);

            $passFail = $list->results->pass_or_fail ?? 'Failed';
            // External quiz IDs are not local assignment-exam IDs. The assessment
            // result above is the record for this attempt; do not duplicate it
            // into tbl_exam_attempts, which belongs to assignment exams only.

            if ($passFail === 'Passed') {
                if ($assigned->isCompletedAndPassed()) {
                    $assigned->update([
                        'status' => 3,
                        'completed_on' => now(),
                    ]);
                } else {
                    $assigned->update(['status' => 1]);
                }
            } else {
                $assigned->update(['status' => 1]);
            }

            $data->setAttribute('attempt_count', $attemptCount + 1);
            $data->setAttribute('attempts_remaining', 2 - $attemptCount);

            return response()->json($data);
        });
    }
   
     public function my_profile()
    {

        $user = Auth::user();
        //dd($user);
         $total_courses =AsignedUser::where('user_id',$user->id)->count();
          $completed_course =AsignedUser::where('user_id',$user->id)->where('status',3)->count();
          $inprogress_count = Asigneduser::where('user_id',$user->id)->whereHas('course_details',function($q){
            $q->where('course_type',1);
          })->where('status',1)->count();
          $pending_count = Asigneduser::where('user_id',$user->id)->whereHas('course_details',function($q){
            $q->where('course_type',1);
          })->where('status',0)->count();
          $instructor_lead = Asigneduser::where('user_id',$user->id)->whereHas('course_details',function($q){
            $q->where('course_type',2);
          })->count();
        return view('user.my_profile',compact('user','total_courses','completed_course','inprogress_count','pending_count','instructor_lead'));
    }

    public function update_profile_image(Request $request)
    {

     //dd($request->all());
       $user = Auth::user();

    $request->validate([
        'profile_image' => 'required|image|mimes:jpeg,png,jpg|max:5048', 
    ]);

    if ($request->hasFile('profile_image')) {
        if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
            Storage::disk('public')->delete($user->profile_image);
        }

    
        $imagePath = $request->file('profile_image')->store('profile_images', 'public');

        $user->profile_image = $imagePath;
        $user->save();

        if(!empty($request->orignasation_dashboard_url)){

            return redirect()->route('user.organization_dashboard')->with('success', 'Profile picture changed successfully');
        }
        return redirect()->route('my_profile.view')->with('success', 'Profile picture changed successfully');
    }


      return redirect()->route('my_profile.view')->with('error', 'Error uploading image');

    }
    public function accept_course(Request $request)
    {
        // dd($request->assign_id);
        $data = AsignedUser::where('id',$request->assign_id)->first();
        
            $data->status=$request->status;
        
        $data->save();

        return json_encode(['status'=>$request->status]);

    }
    public function user_upload_feedback_document(Request $request)
{
    if ($request->hasFile('document')) {
            try{

            $videoFile = $request->file('document');
            $videoFileName = uniqid() . '_' . str_replace(" ", "", $videoFile->getClientOriginalName());
            $videoFilePath = $videoFile->storeAs('documets', $videoFileName, 'public');
            $data = Offline_Documents::create(['course_id'=>$request->course_id, 'type'=>1, 'document_name'=>$videoFileName, 'document_path'=>$videoFilePath, 'assined_id'=>$request->assined_id]);

            } catch (\Exception $e) {

                return response()->json(['message' => $e->getMessage(),'status'=>0], 400);
            }
           return response()->json(['message' => '<span style="color:green;">File successfully uploaded.</span>','files'=>$data,'status'=>1]);
        }      
}
public function course_view(Request $request)
{
    $courses_data = Asigneduser::has('course_details')->has('category_details')->where('user_id',Auth::user()->id)->where('id',$request->id)->orderBy('id','desc')->first();
   
    return view('user.calender_course_view',compact('courses_data'));
}
public function myfiles(Request $request)
{
    $data = Asigneduser::where('user_id',Auth::user()->id)->get();
    return view('user.myfiles',compact('data'));
}
public function user_course_status_update(Request $request)
{
     $data = Asigneduser::where('id',$request->assign_id)->update(['status'=>3,'completed_on'=>date('Y-m-d H:i:s')]);
     return redirect(url('mycompleted_courses'))->withSuccess('Course Completed successfully');
}
public function get_certificate(Request $request)
{
    $siteLogo = \DB::table('tbl_logo_application')->latest()->first();
    $data = Asigneduser::with(['course_details.certificate_data.template_data', 'users_data'])->where('id', $request->assign_id ?? $request->id)->first();

    if (!$data || !$data->course_details) {
        return '<div class="p-4 text-center text-muted">Course details not found.</div>';
    }

    $userType = Auth::check() ? Auth::user()->user_type : null;
    $userTypeArr = is_string($userType) ? json_decode($userType, true) : (is_array($userType) ? $userType : [$userType]);
    if (!is_array($userTypeArr)) {
        $userTypeArr = [$userType];
    }
    $isAdmin = $request->has('admin') 
        || $request->get('admin') == 1
        || str_contains($request->headers->get('referer') ?? '', 'admin')
        || str_contains($request->headers->get('referer') ?? '', 'users')
        || (Auth::check() && (in_array(1, $userTypeArr) || in_array('1', $userTypeArr) || !in_array(2, $userTypeArr) || !in_array('2', $userTypeArr)));

    if (!$isAdmin && (int)$data->status !== 3 && !$data->isCompletedAndPassed()) {
        return '<div class="p-4 text-center text-muted">Certificate is not available until all course assessments and assignments are passed.</div>';
    }

    $certificate = $data->course_details->certificate_data ?? null;

    // If certificate is not set or has no signature, resolve from category or parent category
    $hasSignature = $certificate && (!empty($certificate->signature_drawn) || !empty($certificate->signature_image));
    if (!$hasSignature) {
        $catId = $data->course_details->category_id ?? $data->category_id;
        if (!empty($catId)) {
            $category = \App\Models\Category::find($catId);
            $catCert = \App\Models\Certificate::where(function ($q) use ($catId, $category) {
                    $q->where('category_id', $catId);
                    if ($category && !empty($category->parent_id)) {
                        $q->orWhere('category_id', $category->parent_id);
                        $q->orWhere('parent_id', $category->parent_id);
                    }
                })
                ->where('status', 1)
                ->where(function ($q) {
                    $q->where(function ($sq) {
                        $sq->whereNotNull('signature_drawn')->where('signature_drawn', '!=', '');
                    })->orWhere(function ($sq) {
                        $sq->whereNotNull('signature_image')->where('signature_image', '!=', '');
                    });
                })
                ->latest('id')
                ->first();

            if ($catCert) {
                $certificate = $catCert;
            }
        }
    }

    if (!$certificate && !empty($data->course_details->category_id)) {
        $certificate = \App\Models\Certificate::where('category_id', $data->course_details->category_id)->first();
    }
    if (!$certificate && !empty($data->category_id)) {
        $certificate = \App\Models\Certificate::where('category_id', $data->category_id)->first();
    }
    if (!$certificate) {
        $certificate = \App\Models\Certificate::where('status', 1)->latest('id')->first();
    }

    if (!$certificate || !$certificate->template_data) {
        return '<div class="p-4 text-center text-muted">Certificate template not configured for this course.</div>';
    }

    $html = $certificate->template_data->template_html ?: $certificate->template_data->template_pdf_html;
    $learnerName = trim(($data->users_data->first_name ?? '') . ' ' . ($data->users_data->last_name ?? ''));
    $content = str_replace('[Learner_name]', $learnerName, $html);
    
    // Course / Assessment name with clean styling
    $courseName = e($data->course_details->course_name ?? '');
    $content = str_replace('[Course_name]', '<span class="certificate-course-name text-dark fw-bold">' . $courseName . '</span>', $content);
    
    $firstImageSrc = '';
    if ($siteLogo && !empty($siteLogo->banner_image)) {
        $logoCandidates = [
            storage_path('app/public/' . $siteLogo->banner_image),
            public_path('storage/' . $siteLogo->banner_image),
            public_path($siteLogo->banner_image),
        ];
        foreach ($logoCandidates as $cand) {
            if (file_exists($cand) && is_file($cand)) {
                $type = pathinfo($cand, PATHINFO_EXTENSION);
                $firstImageSrc = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($cand));
                break;
            }
        }
    }
    if (empty($firstImageSrc)) {
        $firstImageSrc = asset('public/images/tas-logo.png');
    }
    $content = str_replace('[first_image]', $firstImageSrc, $content);
    $content = str_replace('[second_image]', asset('public/images/certificate-logo.png'), $content);
    
    $issueDate = !empty($data->completed_on) ? date('d/m/Y', strtotime($data->completed_on)) : date('d/m/Y');
    $content = str_replace('[issue_date]', $issueDate, $content);

    $signatureImage = $certificate->signature_image ?? null;
    $signatureDrawn = $certificate->signature_drawn ?? null;

    $signatureBlock = '';

    if (!empty($signatureDrawn)) {
        $signatureBlock = '
            <div class="sig-wrapper text-center position-relative" style="min-height: 90px; display: flex; align-items: center; justify-content: center;">
                <div class="sig-loader spinner-border spinner-border-sm text-secondary position-absolute" role="status" style="width: 1.5rem; height: 1.5rem;"></div>
                <img src="' . $signatureDrawn . '" onload="var p = this.previousElementSibling; if(p) p.style.display=\'none\'; this.style.opacity=\'1\';" style="opacity: 0; transition: opacity 0.25s ease-in; display: block; width: auto; height: auto; max-width: 280px !important; max-height: 115px !important; object-fit: contain; margin: 0 auto;">
            </div>
        ';
        $content = str_replace('align-items: flex-end;', 'align-items: center;', $content);
        $content = str_replace('align-items:flex-end;', 'align-items:center;', $content);
    } elseif (!empty($signatureImage)) {
        $sigUrl = asset('storage/app/public/signature_images/' . $signatureImage);
        $signatureBlock = '
            <div class="sig-wrapper text-center position-relative" style="min-height: 80px; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                <div class="sig-loader spinner-border spinner-border-sm text-secondary position-absolute" role="status" style="top: 25px; width: 1.5rem; height: 1.5rem;"></div>
                <img src="' . $sigUrl . '" onload="var p = this.previousElementSibling; if(p) p.style.display=\'none\'; this.style.opacity=\'1\';" onerror="var p = this.previousElementSibling; if(p) p.style.display=\'none\';" style="opacity: 0; transition: opacity 0.25s ease-in; display: block; width: auto; height: auto; max-width: 220px !important; max-height: 85px !important; object-fit: contain; margin: 0 auto;">
                <div style="width: 100%; border-top: 2px solid black; margin-top: 6px;"></div>
                <h5 class="mt-2" style="font-weight: 600;">Signature</h5>
            </div>
        ';
    } else {
        // Fast instant fallback when no signature is available
        $signatureBlock = '
            <div class="sig-wrapper text-center">
                <div style="min-height: 45px; display: flex; align-items: flex-end; justify-content: center; margin-bottom: 5px;">
                    <span style="font-size: 13px; color: #6c757d; font-style: italic;">Authorized Signature</span>
                </div>
                <div style="width: 100%; border-top: 2px solid black;"></div>
                <h5 class="mt-2" style="font-weight: 600;">Signature</h5>
            </div>
        ';
    }
    $content = str_replace('[signature_image]', $signatureBlock, $content);
    return $content;
}
public function mycertificates(Request $request)
{
    $data = Asigneduser::where('user_id', Auth::user()->id)
        ->where('status', 3)
        ->get()
        ->filter(function ($assignment) {
            if (!$assignment->isCompletedAndPassed()) {
                $assignment->update(['status' => 1]);
                return false;
            }
            return true;
        })
        ->values();

    return view('user.mycertificates', compact('data'));
}

    public function download_certificates(Request $request)
    {
        $siteLogo = \DB::table('tbl_logo_application')->latest()->first();

        $data = Asigneduser::with(['course_details.certificate_data.template_data', 'users_data'])->where('id', $request->id ?? $request->assign_id)->first();

        if (!$data || !$data->course_details) {
            return redirect()->back()->with('error', 'Assigned course not found.');
        }

        $userType = Auth::check() ? Auth::user()->user_type : null;
        $userTypeArr = is_string($userType) ? json_decode($userType, true) : (is_array($userType) ? $userType : [$userType]);
        if (!is_array($userTypeArr)) {
            $userTypeArr = [$userType];
        }
        $isAdmin = $request->has('admin') 
            || $request->get('admin') == 1
            || str_contains($request->headers->get('referer') ?? '', 'admin')
            || str_contains($request->headers->get('referer') ?? '', 'users')
            || (Auth::check() && (in_array(1, $userTypeArr) || in_array('1', $userTypeArr) || !in_array(2, $userTypeArr) || !in_array('2', $userTypeArr)));

        if (!$isAdmin && (int)$data->status !== 3 && !$data->isCompletedAndPassed()) {
            return redirect()->back()->with('error', 'Certificate is not available until all course assessments and assignments are passed.');
        }

        $certificate = $data->course_details->certificate_data ?? null;
        $hasSignature = $certificate && (!empty($certificate->signature_drawn) || !empty($certificate->signature_image));
        if (!$hasSignature) {
            $catId = $data->course_details->category_id ?? $data->category_id;
            if (!empty($catId)) {
                $category = \App\Models\Category::find($catId);
                $catCert = \App\Models\Certificate::where(function ($q) use ($catId, $category) {
                        $q->where('category_id', $catId);
                        if ($category && !empty($category->parent_id)) {
                            $q->orWhere('category_id', $category->parent_id);
                            $q->orWhere('parent_id', $category->parent_id);
                        }
                    })
                    ->where('status', 1)
                    ->where(function ($q) {
                        $q->where(function ($sq) {
                            $sq->whereNotNull('signature_drawn')->where('signature_drawn', '!=', '');
                        })->orWhere(function ($sq) {
                            $sq->whereNotNull('signature_image')->where('signature_image', '!=', '');
                        });
                    })
                    ->latest('id')
                    ->first();

                if ($catCert) {
                    $certificate = $catCert;
                }
            }
        }

        if (!$certificate && !empty($data->course_details->category_id)) {
            $certificate = \App\Models\Certificate::where('category_id', $data->course_details->category_id)->first();
        }
        if (!$certificate && !empty($data->category_id)) {
            $certificate = \App\Models\Certificate::where('category_id', $data->category_id)->first();
        }
        if (!$certificate) {
            $certificate = \App\Models\Certificate::where('status', 1)->latest('id')->first();
        }

        if (!$certificate || !$certificate->template_data) {
            return redirect()->back()->with('error', 'Certificate template not found.');
        }

        $html = $certificate->template_data->template_pdf_html ?: $certificate->template_data->template_html;

        $firstImageSrc = '';
        if ($siteLogo && !empty($siteLogo->banner_image)) {
            $logoCandidates = [
                storage_path('app/public/' . $siteLogo->banner_image),
                public_path('storage/' . $siteLogo->banner_image),
                public_path($siteLogo->banner_image),
            ];
            foreach ($logoCandidates as $cand) {
                if (file_exists($cand) && is_file($cand)) {
                    $type = pathinfo($cand, PATHINFO_EXTENSION);
                    $firstImageSrc = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($cand));
                    break;
                }
            }
        }
        if (empty($firstImageSrc)) {
            $firstImageSrc = asset('public/images/tas-logo.png');
        }

        $secondImagePath = public_path('images/certificate-logo.png');
        $secondImageSrc = '';
        if (file_exists($secondImagePath)) {
            $type = pathinfo($secondImagePath, PATHINFO_EXTENSION);
            $secondImageSrc = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($secondImagePath));
        } else {
            $secondImageSrc = asset('public/images/certificate-logo.png');
        }

        $learnerName = trim(($data->users_data->first_name ?? '') . ' ' . ($data->users_data->last_name ?? ''));
        $content = str_replace(
            '[Learner_name]',
            $learnerName,
            $html
        );

        $content = str_replace(
            '[Course_name]',
            $data->course_details->course_name ?? '',
            $content
        );

        $content = str_replace('[first_image]', $firstImageSrc, $content);
        $content = str_replace('[second_image]', $secondImageSrc, $content);

        $content = str_replace(
            '[first_link]',
            asset('public/vendors/css/bootstrap.min.css'),
            $content
        );

        $content = str_replace(
            '[second_link]',
            asset('public/css/horizontal-layout/style.css'),
            $content
        );

        $content = str_replace(
            '[third_link]',
            asset('public/css/horizontal-layout/lms.css'),
            $content
        );

        $formattedDate = !empty($data->completed_on) ? date('d/m/Y', strtotime($data->completed_on)) : date('d/m/Y');
        $content = str_replace('[issue_date]', $formattedDate, $content);

        $signatureImage = $certificate->signature_image ?? null;
        $signatureDrawn = $certificate->signature_drawn ?? null;
        $signatureHtml = '';

        if (!empty($signatureDrawn)) {
            $signatureHtml = '<img src="' . $signatureDrawn . '" alt="Signature Stamp" style="max-height: 110px; max-width: 280px; width: auto; height: auto; display: block; margin: 0 auto; object-fit: contain;">';
        } elseif (!empty($signatureImage)) {
            $sigPath = storage_path('app/public/signature_images/' . $signatureImage);
            $sigSrc = '';
            if (file_exists($sigPath)) {
                $type = pathinfo($sigPath, PATHINFO_EXTENSION);
                $sigSrc = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($sigPath));
            } else {
                $sigSrc = asset('storage/app/public/signature_images/' . $signatureImage);
            }
            $signatureHtml = '
                <div style="text-align: center;">
                    <img src="' . $sigSrc . '" alt="Signature" style="max-height: 80px; max-width: 220px; width: auto; height: auto; display: block; margin: 0 auto 4px; object-fit: contain;">
                    <div style="width: 200px; border-top: 2px solid #000; margin: 0 auto;"></div>
                    <div style="font-size: 16px; font-weight: 700; color: #000; padding-top: 4px; font-family: Arial, sans-serif;">Signature</div>
                </div>
            ';
        } else {
            $signatureHtml = '
                <div style="text-align: center;">
                    <div style="height: 45px; display: flex; align-items: flex-end; justify-content: center; font-size: 13px; color: #666; font-style: italic;">Authorized Signature</div>
                    <div style="width: 200px; border-top: 2px solid #000; margin: 0 auto;"></div>
                    <div style="font-size: 16px; font-weight: 700; color: #000; padding-top: 4px; font-family: Arial, sans-serif;">Signature</div>
                </div>
            ';
        }

        $alignedFooter = '
            <table class="certificate-footer" align="center" style="width: 660px; margin: 25px auto 10px; border-collapse: collapse; table-layout: fixed; font-family: Arial, sans-serif;">
                <colgroup>
                    <col style="width: 280px;" />
                    <col style="width: 100px;" />
                    <col style="width: 280px;" />
                </colgroup>
                <tr>
                    <td style="width: 280px; text-align: center; vertical-align: bottom; padding: 0;">
                        ' . $signatureHtml . '
                    </td>
                    <td style="width: 100px; padding: 0;"></td>
                    <td style="width: 280px; text-align: center; vertical-align: bottom; padding: 0;">
                        <div style="font-size: 18px; font-weight: 600; color: #000; padding-bottom: 6px; font-family: Arial, sans-serif;">
                            ' . $formattedDate . '
                        </div>
                        <div style="width: 200px; border-top: 2px solid #000; margin: 0 auto;"></div>
                        <div style="font-size: 18px; font-weight: 700; color: #000; padding-top: 6px; font-family: Arial, sans-serif;">
                            Issued Date
                        </div>
                    </td>
                </tr>
            </table>
        ';

        if (preg_match('/<table\s+class=["\']certificate-footer["\'][\s\S]*?<\/table>/i', $content)) {
            $content = preg_replace('/<table\s+class=["\']certificate-footer["\'][\s\S]*?<\/table>/i', $alignedFooter, $content);
        } else {
            $content = str_replace('[signature_image]', $signatureHtml, $content);
        }

        $content = str_replace('padding: 1.5% 2%;', 'padding: 10px 15px;', $content);
        $content = str_replace('padding: 15px 20px 25px;', 'padding: 10px 20px 15px;', $content);

        $pdf = App::make('dompdf.wrapper');

        $options = $pdf->getDomPDF()->getOptions();
        $options->set('isRemoteEnabled', true);
        $options->set('isFontSubsettingEnabled', false);
        $options->set('defaultFont', 'DejaVu Sans');

        $pdf->getDomPDF()->setOptions($options);

        $pdf->setPaper('a4', 'landscape');

        $pdf->loadHTML($content);

        return $pdf->download(
            ($data->course_details->course_name ?? 'Certificate') . '.pdf',
            array("Attachment" => false)
        );
    }



public function update_notification_count(Request $request)
{
    Notifications::where('user_id',Auth::user()->id)->update(['status'=>1]);
    return "<p>success...</p>";

}
public function get_results(Request $request)
{

    // dd('hi');
    $list = Assessment_results::where('course_document_id',$request->id)->where('assign_id',$request->assign_id)->get();
    $i=1;$html="";
    foreach ($list as $key => $value) {
                $result=json_decode($value->results);

       $html.="<tr><td>".$i++."</td><td>".date('Y-m-d',strtotime($value->completed_at))."</td><td>".$result->percentage."%</td><td>".$result->pass_or_fail."</td></tr>";

    }
    return $html;
}


public function myinstructorled_courses(Request $request)
    {
        $list = Asigneduser::has('course_details')->has('category_details')->where('user_id',Auth::user()->id)->whereHas('course_details',function($q) use($request){
            // $q->whereDate('expiration_date','>=',date('Y-m-d'));
            $q->where('course_type',2);

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

            if(!empty($request->assign_status)){
                $q->where('course_type',$request->status);
            }else{
                //$q->where('course_type',1);
            }

        })->where(function($q) use($request){
            if(!empty($request->category_id)){
                $q->where('category_id',$request->category_id);
            }
           

        })->with('bookmark_data');

        if($request->bookmark==1){
           $list =$list->has('bookmark_data'); 
        }

        if($request->assign_status==0 && !empty($request->assign_status)){
           $list =$list->where('status',0); 
        }

        if($request->menu=='bookmark'){
           $list =$list->where('status',3); 
        }

                if ($request->menu == 'Offline') {
    $list = $list->where(function($query) {
        $query->Where('status', 0);
    });
}


        if ($request->menu == 'progress') {
    $list = $list->where(function($query) {
        $query->has('scorm_details')
              ->orWhere('status', 1);
    });
}

        $list =$list->orderBy('id','desc')->get();
      $courses_data = Asigneduser::has('course_details')->has('category_details')->where('user_id',Auth::user()->id)->orderBy('id','desc')->where('id',0)->first();


        $category_list=Category::whereHas('category_assigned_cousers')->get();

        $category_view = Category::with(['category_assigned_cousers'=>function($q){
            $q->where('user_id',Auth::user()->id);
        }])->whereHas('category_assigned_cousers', function ($query) {
                       $query->where('user_id', Auth::user()->id);
                            $query->where('status','!=',3);
                     })->where(function($q) use($request){
            if(!empty($request->category_id)){
                $q->where('id',$request->category_id);
            }
        })->whereHas('category_assigned_cousers.course_details', function ($q) use($request) {

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

        })->orderBy('category_name','ASC')->get();
        //dd($category_view);
         return view('user.instructorled_courses.index',compact('list','courses_data','category_list','category_view','request'));
    }

    public function searchCategories(Request $request)
{
    $query = $request->get('query');
    $results = Category::whereHas('category_assigned_cousers')->where('category_name', 'LIKE', "%{$query}%")
              ->get(['id', 'category_name as name']); // Adjust fields as needed

    return response()->json($results);
}

}
