<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_login;
use App\Models\Courses;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Asigneduser;
use App\Models\Notifications;
use App\Models\Assigned_Group;
use App\Models\Group;
use App\Models\Roles;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Assessment_results;
use App\Models\Course_documents;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Auth;
use GuzzleHttp\Client;
use App\Models\ExamAttempt;
use App\Models\Exam;
use App\Models\Activity;
use App\Models\Question;
use App\Models\Answer;
use Laravolt\Avatar\Facade as Avatar;


class AdminRegistrationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Request $request)
    {
        $courses_count = Courses::where(function($q) use($request){
            if(!empty($request->category_id)){
                $q->where('category_id',$request->category_id);
            }
        })->Where('is_delete',0)->count();
        $active_courses_count = Courses::where(function($q) use($request){
            if(!empty($request->category_id)){
                $q->where('category_id',$request->category_id);
            }
        })->Where('is_delete',0)->where('active',1)->count();

        $inactive_courses_count = Courses::where(function($q) use($request){
            if(!empty($request->category_id)){
                $q->where('category_id',$request->category_id);
            }
        })->Where('is_delete',0)->where('active','!=',1)->count();

       // ->whereDate('expiration_date','>',date('Y-m-d'))
        $assigned_courses_count = Courses::where(function($q) use($request){
            if(!empty($request->category_id)){
                $q->where('category_id',$request->category_id);
            }
        })->has('Assign_userdetails')->Where('is_delete',0)->count();
         $expire_courses_count = Courses::where(function($q) use($request){
            if(!empty($request->category_id)){
                $q->where('category_id',$request->category_id);
            }
        })->Where('is_delete',0)->whereDate('expiration_date','<',date('Y-m-d'))->count();

         $inprogress_courses_count = Courses::where(function($q) use($request){
            if(!empty($request->category_id)){
                $q->where('category_id',$request->category_id);
            }
        })->has('Assign_userdetails.scorm_details')->Where('is_delete',0)->count();

         $completed_course_count = Courses::where(function($q) use($request) {
                if (!empty($request->category_id)) {
                    $q->where('category_id', $request->category_id);
                }
            })->whereHas('Assign_userdetails', function($q) {
                $q->where('status', 3);
            })->Where('is_delete',0)->count();

        $pending_course_count = Courses::where(function($q) use($request) {
                if (!empty($request->category_id)) {
                    $q->where('category_id', $request->category_id);
                }
            })->whereHas('Assign_userdetails', function($q) {
                $q->where('status', 0);
            })->Where('is_delete',0)->count();

        $user_count = User::where('user_type', '!=', 1)
                  ->when(!empty($request->department_id), function($query) use ($request) {
                      $query->where('department', $request->department_id);
                  })
                  ->count();

        $user_active_count = User::where('user_type', '!=', 1)->where('active',1)
                  ->when(!empty($request->department_id), function($query) use ($request) {
                      $query->where('department', $request->department_id);
                  })
                  ->count();          

        $user_enrolled_count = User::whereHas('assigned_users')->where('user_type', '!=', 1)->where('active', 1)
                               ->when(!empty($request->department_id), function($query) use ($request) {
                                  $query->where('department', $request->department_id);
                                  })
                                ->count();  

                               $userChartLabels = ['Active', 'Enrolled']; 
        $userChartData = [$user_active_count, $user_enrolled_count]; 
        $category_list=Category::get();
        $department_list=Department::get();
        $user_today_logins = User_login::whereDate('login_time',date('Y-m-d'))->count();
    $filterOption = $request->input('enroll_created_date');

// Initialize date variables
$startDate = null;
$endDate = null;

$query = AsignedUser::query(); // Starting query builder for AsignedUser

switch ($filterOption) {
    case '1': 
        $startDate = Carbon::today();
        $endDate = Carbon::today();
        break;
    case '2': 
        $startDate = Carbon::yesterday();
        $endDate = Carbon::yesterday();
        break;
    case '3': 
        $startDate = Carbon::today()->subDays(6);
        $endDate = Carbon::now();
        break;
    case '4': 
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now();
        break;
    default: 
        $startDate = Carbon::today()->subDays(6);
        $endDate = Carbon::today();
        break;
}
//dd($startDate,$endDate);

$xvalues = [];
$assignedyvalues = [];
$loginyvalues = [];
$courses_graph_count = [];

for ($i = 0; $i < 7; $i++) {
    $currentDate = Carbon::parse($startDate)->addDays($i)->format('Y-m-d');
    $xvalues[] = Carbon::parse($currentDate)->format('l');

    //dd($currentDate);
    
    $assignedyvalues[] = AsignedUser::whereDate('created_at', $currentDate)
        ->count();
        
    $loginyvalues[] = User_login::whereDate('login_time', $currentDate)->count();
    
    $courses_graph_count[] = Courses::whereDate('created_at', $currentDate)
        ->when($request->course_created_category_id, function ($q) use ($request) {
            return $q->where('category_id', $request->course_created_category_id);
        })
        ->count();
}

 $filterOption = $request->input('enroll_created_date');
 $course_createdOption = $request->input('course_created_date');

    $xvalues = ['Sunday','Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    $assignedyvalues = array_fill(0, 7, 0); // Initialize with zeros

    // Initialize date variables
    $startDate = Carbon::now()->startOfWeek(); // Start of the week (Monday)
    $endDate = Carbon::now()->endOfWeek(); // End of the week (Sunday)

    if ($filterOption === '1') { 
    $startDate = Carbon::today();
    $endDate = Carbon::today();
    $currentDate = $startDate->format('Y-m-d');
    
    // For today, set the count of assigned users on the correct day of the week
    $assignedyvalues[Carbon::parse($currentDate)->dayOfWeek] = AsignedUser::whereDate('created_at', $currentDate)
        ->when($request->course_category_id, function ($q) use ($request) {
            return $q->where('category_id', $request->course_category_id);
        })
        ->count();
    //dd($assignedyvalues);
} elseif ($filterOption === '2') { 
    // Yesterday
    $startDate = Carbon::yesterday();
    $endDate = Carbon::yesterday();
    $currentDate = $startDate->format('Y-m-d');

    // Update the assignedyvalues array for yesterday
    $assignedyvalues[Carbon::parse($currentDate)->dayOfWeek] = AsignedUser::whereDate('created_at', $currentDate)
        ->when($request->course_category_id, function ($q) use ($request) {
            return $q->where('category_id', $request->course_category_id);
        })
        ->count();
    //dd($assignedyvalues);
} elseif ($filterOption === '3') { 
    // Last Week (Start of last week to the end of last week)
    $startDate = Carbon::now()->subWeek()->startOfWeek();  // Start of the previous week (Sunday)
    $endDate = Carbon::now()->subWeek()->endOfWeek();      // End of the previous week (Saturday)

    // Initialize the assignedyvalues array with zeros for each day of the week (Sunday, Monday, Tuesday, etc.)
    $assignedyvalues = array_fill(0, 7, 0);

    // Loop through the days of the last week
    $currentDate = $startDate;

    while ($currentDate <= $endDate) {
        // Get the day of the week (0 = Sunday, 6 = Saturday)
        $dayOfWeek = $currentDate->dayOfWeek;

        // Update the assignedyvalues array for this specific day
        $assignedyvalues[$dayOfWeek] += AsignedUser::whereDate('created_at', $currentDate->format('Y-m-d'))
            ->when($request->course_category_id, function ($q) use ($request) {
                return $q->where('category_id', $request->course_category_id);
            })
            ->count();

        // Move to the next day
        $currentDate->addDay();
    }

    //dd($assignedyvalues); // Uncomment to debug and see the values
}
 elseif ($filterOption === '4') { 
    // Current Month (Start of the month to the end of the month)
    $startDate = Carbon::now()->startOfMonth();
    $endDate = Carbon::now()->endOfMonth();

    // Initialize the assignedyvalues array with zeros for each day of the week (Sunday, Monday, Tuesday, etc.)
    $assignedyvalues = array_fill(0, 7, 0);

    // Loop through the days of the current month
    $currentDate = $startDate;

    while ($currentDate <= $endDate) {
        // Get the day of the week (0 = Sunday, 6 = Saturday)
        $dayOfWeek = $currentDate->dayOfWeek;

        // Update the assignedyvalues array for this specific day
        $assignedyvalues[$dayOfWeek] += AsignedUser::whereDate('created_at', $currentDate->format('Y-m-d'))
            ->when($request->course_category_id, function ($q) use ($request) {
                return $q->where('category_id', $request->course_category_id);
            })
            ->count();

        // Move to the next day
        $currentDate->addDay();
    }

    //dd($assignedyvalues); 
} else {
    // Default filter (same as option 1)
    $startDate = Carbon::today();
    $endDate = Carbon::today();
    $currentDate = $startDate->format('Y-m-d');
    $assignedyvalues[Carbon::parse($currentDate)->dayOfWeek] = AsignedUser::whereDate('created_at', $currentDate)
        ->when($request->course_category_id, function ($q) use ($request) {
            return $q->where('category_id', $request->course_category_id);
        })
        ->count();
    //dd($assignedyvalues);
}

   

                    $loginyvalues[] = User_login::whereDate('login_time', $currentDate)->count();
    

 $courses_graph_count = array_fill(0, 7, 0); // Initialize with zeros

  if ($course_createdOption === '1') { 
    $startDate = Carbon::today();
    $endDate = Carbon::today();
    $currentDate = $startDate->format('Y-m-d');
    
    // For today, set the count of assigned users on the correct day of the week
    $courses_graph_count[Carbon::parse($currentDate)->dayOfWeek] = Courses::whereDate('created_at', $currentDate)
        ->when($request->course_created_category_id, function ($q) use ($request) {
            return $q->where('category_id', $request->course_created_category_id);
        })
        ->count();
    //dd($assignedyvalues);
} elseif ($course_createdOption === '2') { 
    // Yesterday
    $startDate = Carbon::yesterday();
    $endDate = Carbon::yesterday();
    $currentDate = $startDate->format('Y-m-d');

    // Update the assignedyvalues array for yesterday
    $courses_graph_count[Carbon::parse($currentDate)->dayOfWeek] = Courses::whereDate('created_at', $currentDate)
        ->when($request->course_created_category_id, function ($q) use ($request) {
            return $q->where('category_id', $request->course_created_category_id);
        })
        ->count();
    //dd($assignedyvalues);
} elseif ($course_createdOption === '3') { 
    // Last Week (Start of last week to the end of last week)
    $startDate = Carbon::now()->subWeek()->startOfWeek();  // Start of the previous week (Sunday)
    $endDate = Carbon::now()->subWeek()->endOfWeek();      // End of the previous week (Saturday)

    // Initialize the assignedyvalues array with zeros for each day of the week (Sunday, Monday, Tuesday, etc.)
    $courses_graph_count = array_fill(0, 7, 0);

    // Loop through the days of the last week
    $currentDate = $startDate;

    while ($currentDate <= $endDate) {
        // Get the day of the week (0 = Sunday, 6 = Saturday)
        $dayOfWeek = $currentDate->dayOfWeek;

        // Update the assignedyvalues array for this specific day
        $courses_graph_count[$dayOfWeek] += Courses::whereDate('created_at', $currentDate->format('Y-m-d'))
            ->when($request->course_created_category_id, function ($q) use ($request) {
                return $q->where('category_id', $request->course_created_category_id);
            })
            ->count();

        // Move to the next day
        $currentDate->addDay();
    }

    //dd($assignedyvalues); // Uncomment to debug and see the values
} elseif ($course_createdOption === '4') { 
    // Current Month (Start of the month to the end of the month)
    $startDate = Carbon::now()->startOfMonth();
    $endDate = Carbon::now()->endOfMonth();

    // Initialize the assignedyvalues array with zeros for each day of the week (Sunday, Monday, Tuesday, etc.)
    $currentDate = $startDate;

    while ($currentDate <= $endDate) {
        // Get the day of the week (0 = Sunday, 6 = Saturday)
        $dayOfWeek = $currentDate->dayOfWeek;

        // Update the assignedyvalues array for this specific day
        $courses_graph_count[$dayOfWeek] += Courses::whereDate('created_at', $currentDate->format('Y-m-d'))
            ->when($request->course_created_category_id, function ($q) use ($request) {
                return $q->where('category_id', $request->course_created_category_id);
            })
            ->count();

        // Move to the next day
        $currentDate->addDay();
    }

    //dd($assignedyvalues); 
} else {
    // Default filter (same as option 1)
    $startDate = Carbon::today();
    $endDate = Carbon::today();
    $currentDate = $startDate->format('Y-m-d');
    $courses_graph_count[Carbon::parse($currentDate)->dayOfWeek] = Courses::whereDate('created_at', $currentDate)
        ->when($request->course_created_category_id, function ($q) use ($request) {
            return $q->where('category_id', $request->course_created_category_id);
        })
        ->count();
    //dd($assignedyvalues);
}
    
   
    



//dd($courses_count);
       
    

    $categoriesCounts = DB::table('tbl_courses')
    ->leftJoin('tbl_assignedusers', 'tbl_courses.id', '=', 'tbl_assignedusers.course_id')
    ->when(!empty($request->cat_id), function ($query) use ($request) {
        $query->where('tbl_assignedusers.category_id', $request->cat_id);
    })
    ->select(
        'tbl_courses.id as course_id',
        'tbl_courses.course_name as course_name',
        DB::raw('COUNT(DISTINCT tbl_assignedusers.user_id) as user_count'),
        DB::raw('SUM(CASE WHEN tbl_assignedusers.status = 0 THEN 1 ELSE 0 END) as pending_status_count'),
        DB::raw('SUM(CASE WHEN tbl_assignedusers.status = 1 THEN 1 ELSE 0 END) as inprocess_status_count'),
        DB::raw('SUM(CASE WHEN tbl_assignedusers.status = 3 THEN 1 ELSE 0 END) as completed_status_count')
    )
    ->groupBy('tbl_courses.id', 'tbl_courses.course_name')
    ->get();



    

// $topCoursesQuery = DB::table(DB::raw('(SELECT course_id,
//                                              COUNT(*) as total_users,
//                                              SUM(CASE WHEN status = "3" THEN 1 ELSE 0 END) as completed_users
//                                       FROM tbl_assignedusers
//                                       GROUP BY course_id) as subquery'))
//     ->join('tbl_courses', 'subquery.course_id', '=', 'tbl_courses.id')
//     ->select('subquery.course_id', 
//              'tbl_courses.course_name as course_name', 
//              'subquery.total_users',  
//              'subquery.completed_users',
//              DB::raw('(SUBQUERY.completed_users / SUBQUERY.total_users) * 100 AS completion_percentage'))
//     ->orderBy('completion_percentage', 'desc')
//     ->limit(3);

    $topCoursesQuery = DB::table(DB::raw('(SELECT course_id,
                                             COUNT(*) as total_users,
                                             SUM(CASE WHEN status = "3" THEN 1 ELSE 0 END) as completed_users
                                      FROM tbl_assignedusers
                                      GROUP BY course_id) as subquery'))
    ->join('tbl_courses', 'subquery.course_id', '=', 'tbl_courses.id')
    ->select('subquery.course_id', 
             'tbl_courses.course_name as course_name', 
             'subquery.total_users',  
             'subquery.completed_users',
             DB::raw('
                 CASE 
                     WHEN subquery.total_users > 0 
                     THEN (subquery.completed_users * 100.0 / subquery.total_users) 
                     ELSE 0 
                 END AS completion_percentage'))
    ->orderBy('completion_percentage', 'desc')
    ->limit(5);

if (!empty($request->highperform_category_id)) {
    $topCoursesQuery->where('tbl_courses.category_id', $request->highperform_category_id);
}

$topCourses = $topCoursesQuery->get();

            //dd($topCourses);


$leastCoursesQuery = DB::table(DB::raw('(SELECT course_id,
                                             COUNT(*) as total_users,
                                             SUM(CASE WHEN status = "3" THEN 1 ELSE 0 END) as completed_users
                                      FROM tbl_assignedusers
                                      GROUP BY course_id) as subquery'))
    ->join('tbl_courses', 'subquery.course_id', '=', 'tbl_courses.id')
    ->select('subquery.course_id', 
             'tbl_courses.course_name as course_name', 
             'subquery.total_users',  
             'subquery.completed_users',
             DB::raw('
                 CASE 
                     WHEN subquery.total_users > 0 
                     THEN (subquery.completed_users * 100.0 / subquery.total_users) 
                     ELSE 0 
                 END AS completion_percentage'))
    ->orderBy('completion_percentage', 'asc')
    ->limit(5);

            if (!empty($request->lowperform_category_id)) {
    $leastCoursesQuery->where('tbl_courses.category_id', $request->lowperform_category_id);
}
           $leastCompletedCourses = $leastCoursesQuery->get();



// $query = DB::table('tbl_course_assessment_result')
//     ->leftJoin('tbl_course_documents_list', 'tbl_course_documents_list.id', '=', 'tbl_course_assessment_result.course_document_id')
//     ->select(
//         'tbl_course_assessment_result.course_document_id',
//         'tbl_course_assessment_result.assign_id',
//         'tbl_course_assessment_result.user_id',
//         DB::raw('COUNT(*) as attempt_count')
//     )
//     ->groupBy('tbl_course_assessment_result.course_document_id', 'tbl_course_assessment_result.assign_id', 'tbl_course_assessment_result.user_id');

// if (!empty($request->assesment_category)) {
//     $query->where('tbl_course_documents_list.course_id', '=', $request->assesment_category);
// }

// $attemptCounts = $query->get();


// $attemptGroups = [
//     '1_attempt' => ['total' => 0],
//     '2_attempts' => ['total' => 0],
//     '3_or_more_attempts' => ['total' => 0]
// ];


// foreach ($attemptCounts as $attempt) {
//     if ($attempt->attempt_count == 1) {
//         $category = '1_attempt';
//     } elseif ($attempt->attempt_count == 2) {
//         $category = '2_attempts';
//     } elseif ($attempt->attempt_count >= 3) {
//         $category = '3_or_more_attempts';
//     } else {
//         continue;
//     }
//     $attemptGroups[$category]['total'] += 1;
// }


// $query = DB::table('tbl_course_assessment_result')
//     ->leftJoin('tbl_course_documents_list', 'tbl_course_documents_list.id', '=', 'tbl_course_assessment_result.course_document_id')
//     ->whereRaw('JSON_EXTRACT(results, "$.pass_or_fail") = "Passed"');


// if (!empty($request->assesment_category)) {
//     $query->where('tbl_course_documents_list.course_id', '=', $request->assesment_category);
// }


// $totalCompletedCount = $query->count();


// $assignmentQuery = Asigneduser::whereHas('course_data.assessments', function($q) use ($request) {
//     if (!empty($request->assesment_category)) {
//         $q->where('course_id', '=', $request->assesment_category);
//     }
// });


// $assignmentIds = $assignmentQuery->pluck('id')->toArray();


// $totalAssignmentCount = count($assignmentIds);
// $assessedQuery = Assessment_results::whereIn('assign_id', $assignmentIds)
//     ->whereHas('course_document', function($q) use ($request) {
//         if (!empty($request->assesment_category)) {
//             $q->where('course_id', '=', $request->assesment_category);
//         }
//     });


// $assessedCount = $assessedQuery->count();
// $notAssessedCount = $totalAssignmentCount - $assessedCount;


// $chartData = [
//     'completed' => $assessedCount,
//     'not_started' => $notAssessedCount,
//     '1_attempt' => $attemptGroups['1_attempt']['total'] ?? 0,
//     '2_attempts' => $attemptGroups['2_attempts']['total'] ?? 0,
//     '3_or_more_attempts' => $attemptGroups['3_or_more_attempts']['total'] ?? 0,
// ];

        // /dd($chartData);


          $oneweekCoursescount = Courses::where('expiration_date', '>=', Carbon::today())  // Today
    ->where('expiration_date', '<=', Carbon::today()->addDays(7))  // Expiration date within 7 days
    ->get();  // Count instead of get() if you only need the count

//dd($oneweekCoursescount);



$query = Course_documents::selectRaw('
        COUNT(CASE WHEN is_active = 1 THEN 1 END) as active_count,
        COUNT(CASE WHEN is_active = 0 THEN 1 END) as inactive_count,
        COUNT(*) as total_count
    ')
    ->where('type', 6)
    ->first(); // We use first() because we are only expecting one row of counts

// Build the chartData array with the counts
$chartData = [
    'total_active' => $query->active_count,
    'in_active' => $query->inactive_count,
    'total_count' => $query->total_count ?? 0, // Using null coalescing for safety
];

//dd($assignedyvalues);
       return view('admin.organization_dashboard',compact('request','courses_count','active_courses_count','assigned_courses_count','expire_courses_count','user_count','category_list','user_today_logins','xvalues','assignedyvalues','loginyvalues','inprogress_courses_count','categoriesCounts','topCourses','leastCompletedCourses','courses_graph_count','completed_course_count','pending_course_count','user_active_count','user_enrolled_count','userChartLabels', 'userChartData','department_list','chartData','inactive_courses_count','oneweekCoursescount'));
    }


     public function admin_users(Request $request)
    {
        if ($request->ajax() && $request->has('ajax_search')) {
            return $this->search_users_ajax($request);
        }

        $adminCreatedUserId = session('admin_created_user_id');
        //dd(Auth::user()->roles->permissions->contains('1'));

        $users_query = User::withTrashed()->with('designationdetails', 'departmentdetails');

    if ($request->filled('dept_id')) {
        $users_query->where('department', $request->dept_id);
    }
    
    // Status Filter (Supports Single Select dropdown 'user_active' & Multiple Select 'user_status')
    $selectedStatuses = [];
    $selectMode = $request->input('select_mode', 'single');

    if ($selectMode === 'multiple' && $request->has('user_status')) {
        $rawStatuses = $request->input('user_status');
        if (is_array($rawStatuses)) {
            $selectedStatuses = array_map('strval', $rawStatuses);
        } elseif (!empty($rawStatuses) || $rawStatuses === '0') {
            $selectedStatuses = [strval($rawStatuses)];
        }
    } elseif ($request->has('user_active') && $request->user_active !== '' && $request->user_active !== null) {
        $rawActive = $request->input('user_active');
        if (is_array($rawActive)) {
            $selectedStatuses = array_map('strval', $rawActive);
        } elseif ($rawActive === 'all') {
            $selectedStatuses = ['1', '0', '2'];
        } elseif (strpos((string)$rawActive, ',') !== false) {
            $selectedStatuses = array_map('trim', explode(',', (string)$rawActive));
        } else {
            $selectedStatuses = [strval($rawActive)];
        }
        $selectMode = 'single';
    } elseif ($request->has('user_status')) {
        $rawStatuses = $request->input('user_status');
        if (is_array($rawStatuses)) {
            $selectedStatuses = array_map('strval', $rawStatuses);
        } elseif (!empty($rawStatuses) || $rawStatuses === '0') {
            $selectedStatuses = [strval($rawStatuses)];
        }
        $selectMode = 'multiple';
    } else {
        // Default: Active users list
        $selectedStatuses = ['1'];
        $selectMode = 'single';
    }

    if (in_array('deactivated', $selectedStatuses, true) && !in_array('2', $selectedStatuses, true)) {
        $selectedStatuses[] = '2';
    }

    $hasActive = in_array('1', $selectedStatuses, true);
    $hasInactive = in_array('0', $selectedStatuses, true);
    $hasDeactivated = in_array('2', $selectedStatuses, true);

    if ($hasActive && $hasInactive && $hasDeactivated) {
        // All list: no status query constraint
    } elseif ($hasActive || $hasInactive || $hasDeactivated) {
        $users_query->where(function ($query) use ($hasActive, $hasInactive, $hasDeactivated) {
            $hasCondition = false;

            if ($hasActive) {
                $query->where(function ($q) {
                    $q->whereNull('deleted_at')
                      ->whereNull('deactivation_reason')
                      ->where('active', 1);
                });
                $hasCondition = true;
            }

            if ($hasInactive) {
                $inactiveClause = function ($q) {
                    $q->whereNull('deleted_at')
                      ->whereNull('deactivation_reason')
                      ->where(function ($sub) {
                          $sub->where('active', 0)->orWhereNull('active');
                      });
                };
                if ($hasCondition) {
                    $query->orWhere($inactiveClause);
                } else {
                    $query->where($inactiveClause);
                    $hasCondition = true;
                }
            }

            if ($hasDeactivated) {
                $deactivatedClause = function ($q) {
                    $q->whereNotNull('deleted_at')
                      ->orWhere('active', 2)
                      ->orWhereNotNull('deactivation_reason');
                };
                if ($hasCondition) {
                    $query->orWhere($deactivatedClause);
                } else {
                    $query->where($deactivatedClause);
                    $hasCondition = true;
                }
            }
        });
    } else {
        // Fallback default: Active users
        $selectedStatuses = ['1'];
        $users_query->whereNull('deleted_at')
                    ->whereNull('deactivation_reason')
                    ->where('active', 1);
    }


    if ($request->filled('desig_id')) {
        $users_query->where('designation', $request->desig_id);
    }
    if ($request->filled('search_name')) {
      
          $users_query->where(function ($q) use ($request) {
        $q->where('first_name', 'like', '%' . $request->search_name . '%')
          ->orWhere('last_name', 'like', '%' . $request->search_name . '%')
          ->orWhere('username', 'like', '%' . $request->search_name . '%')
           ->orWhere('emp_id', 'like', '%' . $request->search_name . '%')
          ->orWhereHas('designationdetails', function ($query) use ($request) {
              $query->where('designation_name', 'like', '%' . $request->search_name . '%');
          })
          ->orWhereHas('departmentdetails', function ($query) use ($request) {
              $query->where('department_name', 'like', '%' . $request->search_name . '%');
          });
      });
    }

    $users = $users_query->get();

    // Calculate record counts for each status (scoped by current search / department / designation if applied)
    $count_base = User::withTrashed();
    if ($request->filled('dept_id')) {
        $count_base->where('department', $request->dept_id);
    }
    if ($request->filled('desig_id')) {
        $count_base->where('designation', $request->desig_id);
    }
    if ($request->filled('search_name')) {
        $count_base->where(function ($q) use ($request) {
            $q->where('first_name', 'like', '%' . $request->search_name . '%')
              ->orWhere('last_name', 'like', '%' . $request->search_name . '%')
              ->orWhere('username', 'like', '%' . $request->search_name . '%')
              ->orWhere('emp_id', 'like', '%' . $request->search_name . '%')
              ->orWhereHas('designationdetails', function ($query) use ($request) {
                  $query->where('designation_name', 'like', '%' . $request->search_name . '%');
              })
              ->orWhereHas('departmentdetails', function ($query) use ($request) {
                  $query->where('department_name', 'like', '%' . $request->search_name . '%');
              });
        });
    }

    $statusCounts = [
        '1' => (clone $count_base)->whereNull('deleted_at')->whereNull('deactivation_reason')->where('active', 1)->count(),
        '0' => (clone $count_base)->whereNull('deleted_at')->whereNull('deactivation_reason')->where(function ($sub) {
            $sub->where('active', 0)->orWhereNull('active');
        })->count(),
        '2' => (clone $count_base)->where(function ($q) {
            $q->whereNotNull('deleted_at')->orWhere('active', 2)->orWhereNotNull('deactivation_reason');
        })->count(),
    ];




        // $team_leads = [];
        // $client = new \GuzzleHttp\Client();
        // $res = $client->get('https://tasengg.com/tasskillmax/api/getTeamLeads');
        // $response = json_decode($res->getBody(),true);
        // $team_leads =$response['user_data']??[];
    $team_leads = User::where('user_type', 'like', '%[%"5"%]')->orWhere('user_type', 'like', '%"5"%')->get();

        // $manager1_users = [];
        // $client = new \GuzzleHttp\Client();
        // $res = $client->get('https://tasengg.com/tasskillmax/api/getManagerOne');
        // $response = json_decode($res->getBody(),true);
        // $manager1_users =$response['user_data']??[];

        $manager1_users = User::where('user_type', 'like', '%[%"3"%]')->orWhere('user_type', 'like', '%"3"%')->get();

        // $manager2_users = [];
        // $client = new \GuzzleHttp\Client();
        // $res = $client->get('https://tasengg.com/tasskillmax/api/getgetManagerTwo');
        // $response = json_decode($res->getBody(),true);
        // $manager2_users =$response['user_data']??[];
        $manager2_users = User::where('user_type', 'like', '%[%"4"%]')->orWhere('user_type', 'like', '%"4"%')->get();


    
      $training_managers = User::where('user_type', 'like', '%[%"7"%]')->orWhere('user_type', 'like', '%"7"%')->get();
      $senior_training_managers = User::where('user_type', 'like', '%[%"8"%]')->orWhere('user_type', 'like', '%"8"%')->get();

        
        

        $category_list=Category::get();
        $edit_user=User::whereId($request->id)->first();
        $courses_lists=Courses::with('category_details');
         if ($request->filled('category_id')) {
            $courses_lists->whereHas('category_details', function ($query) use ($request) {
                $query->where('id', $request->category_id);
            });
        }

        if ($request->filled('status')) {
            $courses_lists->where('active', $request->status);
        }

       

         $courses_lists = $courses_lists->get();

        $roles_lists=Roles::where('status','=',1)->get();


        $groups_lists=Group::orderby('id','desc')->get();
        $groups_id = Group::where('id', $request->id)->first();

        $departments = Department::get();
       $designations = Designation::get();
        return view('admin.users.users',compact('users','edit_user','courses_lists','groups_lists','groups_id','roles_lists','manager1_users','manager2_users','team_leads','departments','designations','category_list','request','training_managers','senior_training_managers','selectedStatuses','statusCounts','selectMode'));
    }

    public function search_users_ajax(Request $request)
    {
        $term = trim($request->input('term', $request->input('search_name', '')));
        if ($term === '') {
            return response()->json([]);
        }

        $query = User::withTrashed()->with('departmentdetails', 'designationdetails');

        // Apply department filter if selected
        if ($request->filled('dept_id')) {
            $query->where('department', $request->dept_id);
        }

        // Apply designation filter if selected
        if ($request->filled('desig_id')) {
            $query->where('designation', $request->desig_id);
        }

        // Apply status filter if present
        if ($request->has('user_status')) {
            $rawStatuses = (array)$request->input('user_status');
            $hasActive = in_array('1', $rawStatuses, true);
            $hasInactive = in_array('0', $rawStatuses, true);
            $hasDeactivated = in_array('2', $rawStatuses, true);

            if ($hasActive && $hasInactive && $hasDeactivated) {
                // all
            } elseif ($hasActive || $hasInactive || $hasDeactivated) {
                $query->where(function ($q) use ($hasActive, $hasInactive, $hasDeactivated) {
                    $hasCond = false;
                    if ($hasActive) {
                        $q->where(function ($sub) {
                            $sub->whereNull('deleted_at')->whereNull('deactivation_reason')->where('active', 1);
                        });
                        $hasCond = true;
                    }
                    if ($hasInactive) {
                        $method = $hasCond ? 'orWhere' : 'where';
                        $q->$method(function ($sub) {
                            $sub->whereNull('deleted_at')->whereNull('deactivation_reason')->where(function ($s) {
                                $s->where('active', 0)->orWhereNull('active');
                            });
                        });
                        $hasCond = true;
                    }
                    if ($hasDeactivated) {
                        $method = $hasCond ? 'orWhere' : 'where';
                        $q->$method(function ($sub) {
                            $sub->whereNotNull('deleted_at')->orWhere('active', 2)->orWhereNotNull('deactivation_reason');
                        });
                    }
                });
            }
        }

        // Search user by name, username, emp_id, or email
        $query->where(function ($q) use ($term) {
            $q->where('first_name', 'like', '%' . $term . '%')
              ->orWhere('last_name', 'like', '%' . $term . '%')
              ->orWhere('username', 'like', '%' . $term . '%')
              ->orWhere('emp_id', 'like', '%' . $term . '%')
              ->orWhere('email', 'like', '%' . $term . '%')
              ->orWhereRaw("CONCAT(COALESCE(first_name, ''), ' ', COALESCE(last_name, '')) LIKE ?", ['%' . $term . '%']);
        });

        $users = $query->limit(20)->get();

        $results = $users->map(function ($u) {
            $fullName = trim(($u->first_name ?? '') . ' ' . ($u->last_name ?? ''));
            if ($fullName === '') {
                $fullName = $u->username ?? $u->email ?? ('User #' . $u->id);
            }
            $deptName = $u->departmentdetails->department_name ?? 'No Department';

            return [
                'id' => $u->id,
                'name' => $fullName,
                'email' => $u->email ?? '',
                'emp_id' => $u->emp_id ?? '',
                'department' => $deptName,
                'designation' => $u->designationdetails->designation_name ?? '',
            ];
        });

        return response()->json($results);
    }
    public function fetchUserDataApi(Request $request)
    {
         $userData = [];
        $client = new \GuzzleHttp\Client();
        $res = $client->get('https://tasengg.com/tasskillmax/api/getUserData?email='.$request->email);
        $response = json_decode($res->getBody(),true);
        $userData =$response['user_data']??[];
        return json_encode($userData);
    }

//   public function user_registrations_store(Request $request)
// {
//     if (auth()->check()) {
//         if (auth()->user()->user_type == 1) {
//             $validationRules = [
//                 'email' => 'required|email|unique:users,email,' . ($request->id ?? 0),
//             ];

//             if ($request->has('password')) {
//                 $validationRules['password'] = 'required';
//             }

//             $validation = Validator::make($request->all(), $validationRules);

//             if ($validation->fails()) {
//                 return redirect('users')->withError($validation->getMessageBag()->first());
//             }

//             $userData = $request->except('_token');
//             if ($request->has('password')) {
//                 $hashedPassword = Hash::make($request->password);
//                 $userData['password'] = $hashedPassword;
//             }
//             if ($request->hasFile('profile_image')) {
//                 $profile_imageFile = $request->file('profile_image');
//                 $profile_imageFileName = uniqid() . '_' . $profile_imageFile->getClientOriginalName();
//                 $profile_imagesFilePath = $profile_imageFile->storeAs('profile_images', $profile_imageFileName, 'public');
//                 $userData['profile_image'] = 'profile_images/' . $profile_imageFileName;
//             }
//             $user = User::updateOrCreate(['id' => $request->id], $userData);
//             $user->update(['last_login' => now()]);
//             session(['admin_created_user_id' => $user->id]);

//             if($request->tab=2 && isset($request->id)){
//     //dd('hi');
//      return redirect(url('users?tab=2'))->with('success', 'User ' . ($request->has('id') ? 'updated' : 'updated') . ' successfully.');
// }

//             $message = $request->has('id') ? 'updated' : 'registered';
//             return redirect(url('users?tab=1&menu=1&id='.$user->id))->with('success', 'User ' . $message . ' successfully.');
//         } else {
//             return redirect('users')->with('error', 'You are not authorized to perform this action.');
//         }
//     } else {
//         return redirect('users')->with('error', 'You need to be logged in to perform this action.');
//     }
// }

public function user_registrations_store(Request $request)
{
   if (auth()->check()) {
    $userRoles = json_decode(auth()->user()->user_type, true); // Decode the user_type JSON to an array

    // Check if the user has role '1' (Admin)
    if (in_array(1, $userRoles)) {
            $activeVal = $request->input('active');
            $isActive = ($activeVal === '1' || $activeVal == 1) ? 1 : 0;
            $isDeactivate = ($activeVal === '2' || $activeVal == 2 || $activeVal === 'deactivate');

            // Direct deactivation handling if full form validation fields are omitted
            if ($isDeactivate && !empty($request->id) && (!$request->has('email') || !$request->has('roles'))) {
                $user = User::withTrashed()->find($request->id);
                if ($user) {
                    $user->update([
                        'active' => 0,
                        'deactivation_date' => now(),
                        'deactivation_reason' => $request->input('deactivation_reason')
                    ]);
                    if (!$user->trashed()) {
                        $user->delete();
                    }
                    if ($request->ajax() || $request->wantsJson()) {
                        return response()->json([
                            'success' => true,
                            'message' => 'User deactivated successfully.',
                            'user_id' => $user->id
                        ]);
                    }
                    return redirect(url('users?tab=2'))->with('success', 'User deactivated successfully.');
                }
            }

            $validationRules = [
                'email' => 'required|email|unique:users,email,' . ($request->id ?? 0),
                'roles' => 'required|array', // Validate roles as an array
            ];

            if ($request->has('password')) {
                $validationRules['password'] = 'required';
            }

            $validation = Validator::make($request->all(), $validationRules);

            if ($validation->fails()) {
                return redirect('users')->withError($validation->getMessageBag()->first());
            }

            $userData = $request->except('_token', 'roles'); // Exclude roles from user data
            $userData['active'] = $isActive;
            if ($isDeactivate) {
                $userData['deactivation_date'] = now();
                if ($request->filled('deactivation_reason')) {
                    $userData['deactivation_reason'] = $request->input('deactivation_reason');
                }
            } else {
                $userData['deactivation_date'] = null;
                $userData['deactivation_reason'] = null;
            }

            if ($request->has('password')) {
                $hashedPassword = Hash::make($request->password);
                $userData['password'] = $hashedPassword;
            }

            if ($request->hasFile('profile_image')) {
                $profile_imageFile = $request->file('profile_image');
                $profile_imageFileName = uniqid() . '_' . $profile_imageFile->getClientOriginalName();
                $profile_imagesFilePath = $profile_imageFile->storeAs('profile_images', $profile_imageFileName, 'public');
                $userData['profile_image'] = 'profile_images/' . $profile_imageFileName;
            }

            // Store or update the user (accounting for SoftDeletes)
            if (!empty($request->id)) {
                $user = User::withTrashed()->find($request->id);
                if ($user) {
                    $user->update($userData);
                } else {
                    $user = User::create($userData);
                }
            } else {
                $user = User::create($userData);
            }

            // Handle soft delete / restore
            if ($isDeactivate) {
                if (!$user->trashed()) {
                    $user->delete(); // Soft delete user
                }
            } else {
                if ($user->trashed()) {
                    $user->restore(); // Restore soft-deleted user
                }
            }

            $user->update(['last_login' => now()]);

            // Store roles in the user_type column as JSON
            if ($request->has('roles')) {
                $user->user_type = json_encode($request->input('roles')); // Convert array to JSON
                $user->save(); // Save user with updated user_type
            }

            session(['admin_created_user_id' => $user->id]);

            $successMsg = $isDeactivate ? 'User deactivated successfully.' : ($request->has('id') ? 'User updated successfully.' : 'User registered successfully.');

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => $successMsg,
                    'user_id' => $user->id
                ]);
            }

            if ($request->tab == 2 && isset($request->id)) {
                if ($user->active == 1 && !$isDeactivate) {
                    return redirect(url('users?tab=2&userId=' . $user->id . '&open_tab=info'))->with('success', $successMsg);
                }
                return redirect(url('users?tab=2'))->with('success', $successMsg);
            }

            return redirect(url('users?tab=1&menu=1&id=' . $user->id))->with('success', $successMsg);
        } else {
            return redirect('users')->with('error', 'You are not authorized to perform this action.');
        }
    } else {
        return redirect('users')->with('error', 'You need to be logged in to perform this action.');
    }
}



       public function delete_admin_users(Request $request) {
            $user = User::findOrFail($request->id);
            $user->delete();

            return redirect('users?tab=2')->with('success', 'User deleted successfully.');
        }

public function fetchUserData(Request $request)
{
    $user = User::withTrashed()->where('id', $request->userId)->first();

    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    $user_department_id = $user->department;

   $courses = Courses::whereHas('category_details', function ($q) use ($user) {
    $q->where('department_id', $user->department);
})->get();

$courseNames = $courses->map(function ($course) {
    return $course->category_details->category_name; 
})->unique()->implode(',');

//dd($courseNames);


    $userprofile_image = !empty($user->profile_image) 
        ? url("storage/app/public/" . $user->profile_image) 
        : url("public/images/face12.jpg"); // Default image URL

        if(!empty($user->profile_image)){ 
            $userprofile_image=url("storage/app/public/" . $user->profile_image);
        }else{
          $userprofile_image = getUserImage($user->first_name,$user->last_name);
        }


    $userData = [
        'id' => $user->id,
        'first_name' => $user->first_name,
        'last_name' => $user->last_name,
        'emp_id' => $user->emp_id,
        'email' => $user->email,
        'password' => $user->password,
        'description' => $user->description,
        'username' => $user->username,
        'user_type' => $user->user_type,
        'language' => $user->language,
        'profile_image' => $userprofile_image,
        'team_lead' => $user->team_lead,
        'reporting_manager1' => $user->reporting_manager1,
        'reporting_manager2' => $user->reporting_manager2,
        'training_manager' => $user->training_manager,
        'senior_training_manager' => $user->senior_training_manager,
        'department' => $user->department,
        'designation' => $user->designation,
        'active' => $user->active,
        'is_deleted' => (method_exists($user, 'trashed') && $user->trashed()) ? 1 : 0,
        'deleted_at' => $user->deleted_at,
        'deactivation_date' => $user->deactivation_date,
        'deactivation_reason' => $user->deactivation_reason,
        'updated_at' => $user->updated_at ? Carbon::parse($user->updated_at)->format('d-m-Y') : null,
        'courses' => $courseNames??null, 
    ];

    $assignedUserData = [];
    foreach ($courses as $course) {
        $assign = AsignedUser::where('user_id', $user->id)->where('course_id', $course->id)->first();
        $course_image = !empty($course->course_image) 
            ? url("storage/app/public/" . $course->course_image) 
            : url("public/images/face12.jpg"); // Default image URL

        $assignedUserData[] = [
            'course_id' => $course->id ?? '',
            'course_name' => $course->course_name ?? '',
            'category_name' => $course->category_details->category_name ?? '',
            'category_id' => $course->category_id ?? '',
            'course_image' => $course_image ?? '',
            'subcategory_id' => $course->subcategory_id ?? '',
            'assign_id' => $assign->id ?? 0,
            'updated_at' => $assign->updated_at ?? '',
        ];
    }
    $userData['course'] = $assignedUserData;


    $total_courses = AsignedUser::has('course_details')->has('category_details')
        ->where('user_id', $user->id)
        ->whereHas('course_details', function($q) use ($request) {
            $q->where('course_type', 1);
        })->count();

    $completed_course = AsignedUser::has('course_details')->has('category_details')
        ->where('user_id', $user->id)
        ->whereHas('course_details', function ($q) {
            $q->where('course_type', 1);
        })
        ->where('status', 3)->count();

    $inprogress_count = AsignedUser::has('course_details')->has('category_details')
        ->where('user_id', $user->id)
        ->whereHas('course_details', function ($q) {
            $q->where('course_type', 1)
              ->where(function ($expQ) {
                  $expQ->whereNull('expiration_date')
                       ->orWhere('expiration_date', '>=', Carbon::now())
                       ->orWhere('expiration_date', '=', '1970-01-01 00:00:00')
                       ->orWhere('expiration_date', '=', '1970-01-01');
              });
        })->where('status', 1)->count();

    $pending_count = AsignedUser::has('course_details')->has('category_details')
        ->where('user_id', $user->id)
        ->whereHas('course_details', function ($q) {
            $q->where('course_type', 1)
              ->where(function ($expQ) {
                  $expQ->whereNull('expiration_date')
                       ->orWhere('expiration_date', '>=', Carbon::now())
                       ->orWhere('expiration_date', '=', '1970-01-01 00:00:00')
                       ->orWhere('expiration_date', '=', '1970-01-01');
              });
        })
        ->where(function ($query) {
            $query->where('status', 0)
                  ->orWhere('status', 2)
                  ->orWhereNull('status');
        })
        ->count();

    $expired_count = AsignedUser::has('course_details')->has('category_details')
        ->where('user_id', $user->id)
        ->where('status', '!=', 3)
        ->whereHas('course_details', function ($q) {
            $q->where('course_type', 1)
              ->whereNotNull('expiration_date')
              ->where('expiration_date', '!=', '1970-01-01 00:00:00')
              ->where('expiration_date', '!=', '1970-01-01')
              ->where('expiration_date', '<', Carbon::now());
        })
        ->count();

    $instructor_lead = AsignedUser::has('course_details')
        ->where('user_id', $user->id)
        ->whereHas('course_details', function ($q) {
            $q->where('course_type', 2);
        })->count();

    $userData['total_courses'] = $total_courses;
    $userData['completed_course'] = $completed_course;
    $userData['inprogress_count'] = $inprogress_count;
    $userData['pending_count'] = $pending_count;
    $userData['expired_count'] = $expired_count;
    $userData['instructor_lead'] = $instructor_lead;

    // Generate reports HTML
    $deactivationNoticeHtml = '';
    if ($user->trashed() || !empty($user->deactivation_reason) || (int)$user->active === 2) {
        $deactDate = $user->deactivation_date ? Carbon::parse($user->deactivation_date)->format('d M Y, h:i A') : 'N/A';
        $deactReason = $user->deactivation_reason ?: 'No reason description provided';
        $deactivationNoticeHtml = '
        <div class="alert alert-danger border-0 rounded-3 p-3 mb-3 d-flex align-items-start shadow-sm" style="background-color: #fef2f2; border-left: 5px solid #dc2626 !important;">
            <div class="me-3 mt-1 text-danger fs-5"><i class="fa-solid fa-user-slash"></i></div>
            <div class="w-100">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-1">
                    <span class="badge bg-danger text-white px-2 py-1 font-smallsize">Deactivated Account</span>
                    <span class="text-muted font-smallsize"><i class="fa-regular fa-clock me-1"></i>Deactivated On: <strong>' . $deactDate . '</strong></span>
                </div>
                <div class="text-dark font-smallsize pt-1">
                    <strong>Deactivation Reason:</strong> <span class="text-secondary">' . htmlspecialchars($deactReason) . '</span>
                </div>
            </div>
        </div>';
    }

    $html = '<div class="col-12 col-sm-12 col-md-12 col-lg-12 p-2">' . $deactivationNoticeHtml . '
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3 my-2">
                <div class="reports-card reports-card1">
                    <div class="d-flex align-items-center justify-content-start">
                        <div class="reports-icon reports-icon1"><i class="fa-solid fa-book-open-reader"></i></div>
                        <div class="ms-3">
                            <h6>Assigned Courses</h6>
                            <h6 class="text-center mb-0">' . $total_courses . '</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 my-2">
                <div class="reports-card reports-card2">
                    <div class="d-flex align-items-center justify-content-start">
                        <div class="reports-icon reports-icon2"><i class="fa-solid fa-user-check"></i></div>
                        <div class="ms-3">
                            <h6>Completed</h6>
                            <h6 class="text-center mb-0">' . $completed_course . '</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 my-2">
                <div class="reports-card reports-card3">
                    <div class="d-flex align-items-center justify-content-start">
                        <div class="reports-icon reports-icon3"><i class="fa-solid fa-user-xmark"></i></div>
                        <div class="ms-3">
                            <h6>In-Progress</h6>
                            <h6 class="text-center mb-0">' . $inprogress_count . '</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 my-2">
                <div class="reports-card reports-card4">
                    <div class="d-flex align-items-center justify-content-start">
                        <div class="reports-icon reports-icon4"><i class="fa-solid fa-user-slash"></i></div>
                        <div class="ms-3">
                            <h6>Pending</h6>
                            <h6 class="text-center mb-0">' . $pending_count . '</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 my-2">
                <div class="reports-card reports-card5">
                    <div class="d-flex align-items-center justify-content-start">
                        <div class="reports-icon reports-icon5"><i class="bi bi-calendar-x text-danger"></i></div>
                        <div class="ms-3">
                            <h6>Expired</h6>
                            <h6 class="text-center mb-0">' . $expired_count . '</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 my-2">
                <div class="reports-card reports-card5">
                    <div class="d-flex align-items-center justify-content-start">
                        <div class="reports-icon reports-icon4"><i class="fa-solid fa-person-chalkboard"></i></div>
                        <div class="ms-3">
                            <h6>Instructor Led</h6>
                            <h6 class="text-center mb-0">' . $instructor_lead . '</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 my-2">
                <div class="reports-card reports-card5">
                    <div class="d-flex align-items-center justify-content-start">
                        <div class="reports-icon reports-icon4"><i class="fa-solid fa-award"></i></div>
                        <div class="ms-3">
                            <h6>Reward Points</h6>
                            <h6 class="text-center mb-0">' . 0 . '</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        ';

    // Generate the assessments & assignments HTML
    $assessments = AsignedUser::with([
        'course_details.assignment_exam.assignment_exam_name',
        'assigned_exam_datas.exam_details'
    ])->whereHas('course_details', function ($q) {
        $q->where(function($sub) {
            $sub->where('course_type', '!=', 2)->orWhereNull('course_type');
        });
    })->where('user_id', $user->id)->get();

    $course_html_data = '<div class="table-responsive">
        <table class="table table-bordered align-middle mb-0" style="table-layout: fixed; width: 100%;">
            <thead class="table-light">
                <tr>
                    <th style="width: 60%; font-weight: 600; padding: 12px 18px; font-size: 14px;">Course Name</th>
                    <th style="width: 40%; text-align: right; font-weight: 600; padding: 12px 18px; font-size: 14px;">Action</th>
                </tr>
            </thead>
            <tbody>';

    $assignment_modals_html = '';

    if ($assessments->isEmpty()) {
        $course_html_data .= '<tr><td colspan="2" class="text-center py-3 text-muted">No courses found for this user.</td></tr>';
    } else {
        $hasAnyCourses = false;

        foreach ($assessments as $data) {
            if (!$data->course_details) {
                continue;
            }

            // Active assessments for this course (type 6) - only active, non-deleted
            $courseAssessments = Course_documents::where('course_id', $data->course_id)
                ->where('type', 6)
                ->where('is_delete', 0)
                ->where(function ($q) {
                    $q->where('is_active', 1)->orWhereNull('is_active');
                })
                ->whereNotNull('file_name')
                ->where('file_name', '!=', '')
                ->get();

            // Active assignments for this course (type 7) - only active, non-deleted
            $courseAssignments = Course_documents::where('course_id', $data->course_id)
                ->where('type', 7)
                ->where('is_delete', 0)
                ->where(function ($q) {
                    $q->where('is_active', 1)->orWhereNull('is_active');
                })
                ->get();

            $defined_exams = $data->course_details->assignment_exam ?? collect();

            $hasAssessments = $courseAssessments->isNotEmpty();
            $hasAssignments = $courseAssignments->isNotEmpty();
            $hasDefinedExams = $defined_exams->isNotEmpty();

            // If course has neither assessments nor assignments, skip
            if (!$hasAssessments && !$hasAssignments && !$hasDefinedExams) {
                continue;
            }

            $hasAnyAssessmentAttempted = false;
            $hasFailedAssessment = false;
            $allAssessmentsPassed = true;

            // Check if assessments were passed/attempted
            if ($hasAssessments) {
                foreach ($courseAssessments as $assess) {
                    $result_datas = Assessment_results::where('course_document_id', $assess->id)
                        ->where('user_id', $user->id)
                        ->where(function($q) use ($data) {
                            $q->where('assign_id', $data->id)->orWhereNull('assign_id');
                        })
                        ->whereNull('deleted_at')
                        ->latest()
                        ->first();

                    $isAttempted = !empty($result_datas);
                    $isPassed = false;

                    if ($isAttempted) {
                        $hasAnyAssessmentAttempted = true;
                        $payload = json_decode($result_datas->result_data ?? '', true);
                        $details = $payload['results'] ?? json_decode($result_datas->results ?? '', true);
                        $passFail = strtolower(trim((string)($details['pass_or_fail'] ?? '')));

                        if ($result_datas->hasPassed() || $passFail === 'passed') {
                            $isPassed = true;
                        } elseif ($passFail === 'failed' || strtolower($result_datas->status ?? '') === 'completed') {
                            $hasFailedAssessment = true;
                            $allAssessmentsPassed = false;
                        } else {
                            $allAssessmentsPassed = false;
                        }
                    } else {
                        $allAssessmentsPassed = false;
                    }

                    if (!$isPassed) {
                        $allAssessmentsPassed = false;
                    }
                }
            }

            // Check if user passed all active course assignments (Rule 1 & Rule 2)
            $allAssignmentsPassed = true;
            if ($hasAssignments) {
                $uniqueExamCodes = $courseAssignments->pluck('file_path')->filter()->unique();
                if ($uniqueExamCodes->isEmpty()) {
                    $allAssignmentsPassed = false;
                } else {
                    foreach ($uniqueExamCodes as $examCode) {
                        $exam = Exam::where('exam_code', $examCode)->first();
                        if (!$exam) {
                            $allAssignmentsPassed = false;
                            break;
                        }

                        $passed = ExamAttempt::where('exam_id', $exam->id)
                            ->where(function ($q) use ($data, $user) {
                                $q->where('assigned_id', $data->id)
                                  ->orWhere(function ($sub) use ($data, $user) {
                                      $sub->where('user_id', $user->id)
                                          ->where('course_id', $data->course_id);
                                  });
                            })
                            ->whereRaw('LOWER(exam_result) = ?', ['passed'])
                            ->exists();

                        if (!$passed) {
                            $allAssignmentsPassed = false;
                            break;
                        }
                    }
                }
            }

            // Certificate eligibility evaluation
            $canShowCertificate = false;
            if ($hasAssessments && $hasAssignments) {
                $canShowCertificate = $allAssessmentsPassed && $allAssignmentsPassed && ((int)$data->status === 3);
            } elseif ($hasAssessments && !$hasAssignments) {
                $canShowCertificate = $allAssessmentsPassed && !$hasFailedAssessment && ((int)$data->status === 3);
            } elseif (!$hasAssessments && $hasAssignments) {
                $canShowCertificate = $allAssignmentsPassed && ((int)$data->status === 3 || $allAssignmentsPassed);
            } else {
                $canShowCertificate = ((int)$data->status === 3);
            }

            if (method_exists($data, 'isCompletedAndPassed')) {
                $canShowCertificate = $canShowCertificate && $data->isCompletedAndPassed();
            }

            // Gather assignment exam items for this course & user
            $assignment_exams = ExamAttempt::with('exam_details')
                ->whereHas('exam_details')
                ->where('user_id', $user->id)
                ->where(function ($q) use ($data) {
                    $q->where('assigned_id', $data->id)
                      ->orWhere('course_id', $data->course_id);
                })
                ->get();

            $hasAnyAssignmentAttempted = $assignment_exams->isNotEmpty();
            $hasFailedAssignment = false;
            foreach ($assignment_exams as $att) {
                if (strtolower(trim($att->exam_result ?? '')) === 'failed') {
                    $hasFailedAssignment = true;
                }
            }

            $hasAnyCourses = true;

            // Overall course status badge
            if ($canShowCertificate) {
                $courseStatusBadge = '<span class="badge bg-success px-3 py-2" style="font-size: 12px; font-weight: 500; border-radius: 4px;">Completed</span>';
            } else {
                $isCourseExpired = !empty($data->course_details->expiration_date) 
                    && $data->course_details->expiration_date !== '1970-01-01 00:00:00' 
                    && $data->course_details->expiration_date !== '1970-01-01' 
                    && \Carbon\Carbon::parse($data->course_details->expiration_date)->isPast();

                if ($isCourseExpired) {
                    $courseStatusBadge = '<span class="badge bg-danger px-3 py-2" style="font-size: 12px; font-weight: 500; border-radius: 4px;"><i class="bi bi-calendar-x me-1"></i>Expired</span>';
                } elseif ($hasFailedAssessment || $hasFailedAssignment || (int)$data->status === 2) {
                    $courseStatusBadge = '<span class="badge bg-danger px-3 py-2" style="font-size: 12px; font-weight: 500; border-radius: 4px;">Failed</span>';
                } elseif ($hasAnyAssessmentAttempted || $hasAnyAssignmentAttempted || (int)$data->status === 1) {
                    $courseStatusBadge = '<span class="badge bg-warning text-dark px-3 py-2" style="font-size: 12px; font-weight: 500; border-radius: 4px;">In Progress</span>';
                } else {
                    $courseStatusBadge = '<span class="badge bg-secondary px-3 py-2" style="font-size: 12px; font-weight: 500; border-radius: 4px;">Not Attempted</span>';
                }
            }

            // Build Table 1 Rows (Course Assessments)
            $table1_rows = '';
            if ($hasAssessments) {
                $totalAssessments = $courseAssessments->count();
                foreach ($courseAssessments as $index => $assess) {
                    $result_datas = Assessment_results::where('course_document_id', $assess->id)
                        ->where('user_id', $user->id)
                        ->where(function($q) use ($data) {
                            $q->where('assign_id', $data->id)->orWhereNull('assign_id');
                        })
                        ->whereNull('deleted_at')
                        ->latest()
                        ->first();

                    $isPassed = false;
                    $statusLabel = 'Not Attempted';
                    $badgeClass = 'bg-secondary';

                    if (!empty($result_datas)) {
                        $payload = json_decode($result_datas->result_data ?? '', true);
                        $details = $payload['results'] ?? json_decode($result_datas->results ?? '', true);
                        $passFail = strtolower(trim((string)($details['pass_or_fail'] ?? '')));

                        if ($result_datas->hasPassed() || $passFail === 'passed') {
                            $isPassed = true;
                            $badgeClass = 'bg-success';
                            $statusLabel = 'Passed';
                        } elseif ($passFail === 'failed' || strtolower($result_datas->status ?? '') === 'completed') {
                            $badgeClass = 'bg-danger';
                            $statusLabel = 'Failed';
                        } elseif (in_array(strtolower($result_datas->status ?? ''), ['in-progress', 'inprogress'])) {
                            $badgeClass = 'bg-warning text-dark';
                            $statusLabel = 'In Progress';
                        } else {
                            $badgeClass = 'bg-secondary';
                            $statusLabel = 'Not Attempted';
                        }
                    } else {
                        $badgeClass = 'bg-secondary';
                        $statusLabel = 'Not Attempted';
                    }

                    $assessmentStatusBadge = '<span class="badge ' . $badgeClass . ' px-3 py-2" style="font-size: 12px; font-weight: 500; border-radius: 4px;">' . $statusLabel . '</span>';

                    // Individual certificate for this assessment if passed
                    if ($isPassed) {
                        $assessmentCertHtml = '<div class="d-flex align-items-center justify-content-center flex-wrap gap-2">
                            <a href="#" data-id="' . $data->id . '" class="btn btn-outline-primary btn-sm get_certificates text-nowrap px-2 py-1 d-inline-flex align-items-center justify-content-center" style="font-size: 12px; border-radius: 4px; width: 95px;" data-bs-toggle="modal" data-bs-target="#certificateView">
                                <i class="fa-solid fa-eye me-1"></i>View
                            </a>
                            <a href="' . url('admin/download_certificate/' . $data->id) . '" target="_blank" class="btn btn-outline-primary btn-sm text-nowrap px-2 py-1 d-inline-flex align-items-center justify-content-center" style="font-size: 12px; border-radius: 4px; width: 95px;">
                                <i class="fa-solid fa-download me-1"></i>Download
                            </a>
                        </div>';
                    } else {
                        $assessmentCertHtml = '<span class="text-muted small">-</span>';
                    }

                    // View Result action button to assessment_dev with return_url
                    $result_html = '<span class="text-muted small">-</span>';
                    if (!empty($result_datas)) {
                        $link = explode('/', $assess->file_path ?? '');
                        $code = $result_datas->code ?? '';
                        if (!empty($link[0]) && !empty($link[1]) && !empty($code)) {
                            $result_link = "{$link[0]}/{$link[1]}/results/{$code}";
                            $assessmentBaseUrl = config('app.assessment_url', env('ASSESSMENT_URL', 'http://127.0.0.1:8001'));
                            $returnUrl = url('users?tab=2&userId=' . $user->id . '&open_tab=reports&course_id=' . $data->id);

                            $launchUrl = rtrim($assessmentBaseUrl, '/') . '/start_assessment?' . http_build_query([
                                'url' => $result_link,
                                'email' => $user->email,
                                'username' => $user->username,
                                'first_name' => $user->first_name,
                                'last_name' => $user->emp_id,
                                'course_id' => $assess->id,
                                'assign_id' => $data->id,
                                'return_url' => $returnUrl,
                                'lms_url' => url('/')
                            ]);

                            $result_html = '<a href="javascript:;" data-user-id="' . $user->id . '" data-course-id="' . $data->id . '" data-link="' . htmlspecialchars($launchUrl) . '" class="btn btn-sm btn-outline-primary text-nowrap px-3 py-1 take_result" style="font-size: 12px; border-radius: 4px;"><i class="fa-solid fa-eye me-1"></i>View Result</a>';
                        }
                    }

                    $assessmentScoreHtml = '<span class="text-muted small">-</span>';
                    if (!empty($result_datas)) {
                        $payload = json_decode($result_datas->result_data ?? '', true);
                        $details = $payload['results'] ?? json_decode($result_datas->results ?? '', true);

                        $scoreVal = isset($details['score']) && $details['score'] !== '' ? $details['score'] : (isset($details['marks_earned']) && $details['marks_earned'] !== '' ? $details['marks_earned'] : null);
                        $totalMarks = isset($details['total_marks']) && $details['total_marks'] !== '' ? $details['total_marks'] : (isset($details['total_questions']) && $details['total_questions'] !== '' ? $details['total_questions'] : null);
                        $percentage = isset($details['percentage']) && $details['percentage'] !== '' ? $details['percentage'] : null;

                        if ($scoreVal !== null && $totalMarks !== null) {
                            $pctStr = ($percentage !== null) ? ' <span class="text-muted small">(' . round((float)$percentage, 1) . '%)</span>' : '';
                            $assessmentScoreHtml = '<span class="fw-bold" style="color: #212529;">' . $scoreVal . ' / ' . $totalMarks . '</span>' . $pctStr;
                        } elseif ($percentage !== null) {
                            $assessmentScoreHtml = '<span class="fw-bold" style="color: #212529;">' . round((float)$percentage, 1) . '%</span>';
                        } elseif ($scoreVal !== null) {
                            $assessmentScoreHtml = '<span class="fw-bold" style="color: #212529;">' . $scoreVal . '</span>';
                        }
                    }

                    $typeTd = '';
                    if ($index === 0) {
                        $typeTd = '<td rowspan="' . $totalAssessments . '" class="text-center align-middle bg-white" style="padding: 12px 14px;"><span class="badge bg-light text-primary border px-2 py-1" style="font-size: 12px; font-weight: 600;">Assessment</span></td>';
                    }

                    $table1_rows .= '<tr>
                        ' . $typeTd . '
                        <td class="align-middle fw-semibold" style="padding: 12px 16px; color: #212529 !important;">' . htmlspecialchars($assess->file_name ?? 'Assessment') . '</td>
                        <td class="text-center align-middle" style="padding: 12px 14px;">' . $assessmentScoreHtml . '</td>
                        <td class="text-center align-middle" style="padding: 12px 14px;">' . $assessmentStatusBadge . '</td>
                        <td class="text-center align-middle" style="padding: 12px 14px;">' . $result_html . '</td>
                    </tr>';
                }
            }

            // Gather assignment exam items for Table 2
            $items = [];
            $handled_exam_ids = [];

            if ($defined_exams->isNotEmpty()) {
                foreach ($defined_exams as $assignExamDoc) {
                    $examModel = $assignExamDoc->assignment_exam_name ?? null;
                    $examId = $examModel->id ?? null;
                    $examName = $examModel->name ?? ($assignExamDoc->file_name ?? 'Assignment Exam');

                    $attempt = null;
                    if ($examId) {
                        $attempt = $assignment_exams->firstWhere('exam_id', $examId);
                    }
                    if (!$attempt && $assignExamDoc->file_path) {
                        $attempt = $assignment_exams->first(function ($att) use ($assignExamDoc) {
                            return optional($att->exam_details)->exam_code === $assignExamDoc->file_path;
                        });
                    }

                    if ($attempt) {
                        $handled_exam_ids[] = $attempt->id;
                        $items[] = [
                            'status' => $attempt->exam_result ?? ($attempt->status ?? 'N/A'),
                            'name' => $examName,
                            'attempt' => $attempt,
                            'assigned_id' => $attempt->assigned_id ?: $data->id,
                            'course_id' => $attempt->course_id ?: $data->course_id,
                            'exam_id' => $attempt->exam_id ?: $examId,
                            'exam_code' => optional($attempt->exam_details)->exam_code ?? ($assignExamDoc->file_path ?? ''),
                        ];
                    } else {
                        $items[] = [
                            'status' => 'Not Attempted',
                            'name' => $examName,
                            'attempt' => null,
                            'assigned_id' => $data->id,
                            'course_id' => $data->course_id,
                            'exam_id' => $examId,
                            'exam_code' => $assignExamDoc->file_path ?? '',
                        ];
                    }
                }
            }

            // Any remaining attempts not covered by defined_exams
            foreach ($assignment_exams as $attempt) {
                if (in_array($attempt->id, $handled_exam_ids)) {
                    continue;
                }
                $examName = optional($attempt->exam_details)->name ?? 'N/A';
                $items[] = [
                    'status' => $attempt->exam_result ?? ($attempt->status ?? 'N/A'),
                    'name' => $examName,
                    'attempt' => $attempt,
                    'assigned_id' => $attempt->assigned_id ?: $data->id,
                    'course_id' => $attempt->course_id ?: $data->course_id,
                    'exam_id' => $attempt->exam_id,
                    'exam_code' => optional($attempt->exam_details)->exam_code ?? '',
                ];
            }

            // Build Table 2 Rows (Course Assignments)
            $table2_rows = '';
            if (!empty($items)) {
                $totalAssignments = count($items);
                foreach ($items as $index => $item) {
                    $rawStatus = trim($item['status'] ?? 'Not Attempted');
                    $statusLower = strtolower($rawStatus);
                    $isExamPassed = ($statusLower === 'passed' || $statusLower === 'completed');

                    if ($isExamPassed) {
                        $statusBadge = '<span class="badge bg-success px-3 py-2" style="font-size: 12px; font-weight: 500; border-radius: 4px;">Passed</span>';
                        $assignmentCertHtml = '<div class="d-flex align-items-center justify-content-center flex-wrap gap-2">
                            <a href="#" data-id="' . $data->id . '" class="btn btn-outline-primary btn-sm get_certificates text-nowrap px-2 py-1 d-inline-flex align-items-center justify-content-center" style="font-size: 12px; border-radius: 4px; width: 95px;" data-bs-toggle="modal" data-bs-target="#certificateView">
                                <i class="fa-solid fa-eye me-1"></i>View
                            </a>
                            <a href="' . url('admin/download_certificate/' . $data->id) . '" target="_blank" class="btn btn-outline-primary btn-sm text-nowrap px-2 py-1 d-inline-flex align-items-center justify-content-center" style="font-size: 12px; border-radius: 4px; width: 95px;">
                                <i class="fa-solid fa-download me-1"></i>Download
                            </a>
                        </div>';
                    } elseif ($statusLower === 'failed') {
                        $statusBadge = '<span class="badge bg-danger px-3 py-2" style="font-size: 12px; font-weight: 500; border-radius: 4px;">Failed</span>';
                        $assignmentCertHtml = '<span class="text-muted small">-</span>';
                    } elseif ($statusLower === 'pending' || $statusLower === 'in-progress' || $statusLower === 'inprogress') {
                        $statusBadge = '<span class="badge bg-warning text-dark px-3 py-2" style="font-size: 12px; font-weight: 500; border-radius: 4px;">' . ucfirst($rawStatus) . '</span>';
                        $assignmentCertHtml = '<span class="text-muted small">-</span>';
                    } else {
                        $statusBadge = '<span class="badge bg-secondary px-3 py-2" style="font-size: 12px; font-weight: 500; border-radius: 4px;">Not Attempted</span>';
                        $assignmentCertHtml = '<span class="text-muted small">-</span>';
                    }

                    $actionBtn = '';
                    if (!empty($item['attempt'])) {
                        $resultUrl = route('admin.exams.Resultview') . '?course_id=' . $item['course_id'] . '&exam_name=' . urlencode($item['exam_code']) . '&ex_c=' . $item['exam_id'] . '&user_id=' . $user->id . '&attempt_id=' . $item['attempt']->id;
                        $viewAttemptUrl = url('view_attempted_exam') . '?assigned_id=' . $item['assigned_id'] . '&course_id=' . $item['course_id'] . '&exam_id=' . $item['exam_id'] . '&user_id=' . $user->id;

                        if ($statusLower === 'pending') {
                            $actionBtn = '<div class="d-flex align-items-center justify-content-center gap-1">
                                <a href="' . $resultUrl . '" target="_blank" class="btn btn-sm btn-outline-primary text-nowrap px-3 py-1" style="font-size: 12px; border-radius: 4px;">
                                    <i class="fa-solid fa-eye me-1"></i>View Result
                                </a>
                                <a href="' . $viewAttemptUrl . '" target="_blank" class="btn btn-outline-primary btn-sm text-nowrap px-3 py-1" style="font-size: 12px; border-radius: 4px;">
                                    <i class="fa-solid fa-pen-to-square me-1"></i>Evaluate
                                </a>
                            </div>';
                        } else {
                            $actionBtn = '<a href="' . $resultUrl . '" target="_blank" class="btn btn-sm btn-outline-primary text-nowrap px-3 py-1" style="font-size: 12px; border-radius: 4px;">
                                <i class="fa-solid fa-eye me-1"></i>View Result
                            </a>';
                        }
                    } else {
                        // "if not attempted no need to show"
                        $actionBtn = '<span class="text-muted small">-</span>';
                    }

                    $assignmentScoreHtml = '<span class="text-muted small">-</span>';
                    if (!empty($item['attempt'])) {
                        if ($statusLower === 'pending') {
                            $assignmentScoreHtml = '<span class="badge bg-warning text-dark px-2 py-1" style="font-size: 11px;">Under Evaluation</span>';
                        } else {
                            $totalExamMarks = Question::where('exam_id', $item['exam_id'])->sum('question_mark');
                            $userObtainedMarks = Answer::where('exam_attendance_id', $item['attempt']->id)->sum('answer_marks');
                            if ($totalExamMarks > 0) {
                                $pct = round(($userObtainedMarks / $totalExamMarks) * 100, 1);
                                $assignmentScoreHtml = '<span class="fw-bold" style="color: #212529;">' . $userObtainedMarks . ' / ' . $totalExamMarks . '</span> <span class="text-muted small">(' . $pct . '%)</span>';
                            } else {
                                $assignmentScoreHtml = '<span class="fw-bold" style="color: #212529;">' . $userObtainedMarks . '</span>';
                            }
                        }
                    }

                    $typeTd = '';
                    if ($index === 0) {
                        $typeTd = '<td rowspan="' . $totalAssignments . '" class="text-center align-middle bg-white" style="padding: 12px 14px;"><span class="badge bg-light text-info border px-2 py-1" style="font-size: 12px; font-weight: 600;">Assignment</span></td>';
                    }

                    $table2_rows .= '<tr>
                        ' . $typeTd . '
                        <td class="align-middle fw-semibold" style="padding: 12px 16px; color: #212529 !important;">' . htmlspecialchars($item['name']) . '</td>
                        <td class="text-center align-middle" style="padding: 12px 14px;">' . $assignmentScoreHtml . '</td>
                        <td class="text-center align-middle" style="padding: 12px 14px;">' . $statusBadge . '</td>
                        <td class="text-center align-middle" style="padding: 12px 14px;">' . $actionBtn . '</td>
                    </tr>';
                }
            }

            // Build Dropdown Accordion Section for this Course
            $collapseId = 'courseCollapse_' . $data->id;

            $hasAssignmentItems = !empty($items);
            $allAssignmentsPassed = true;
            if ($hasAssignmentItems) {
                foreach ($items as $item) {
                    $st = strtolower(trim($item['status'] ?? ''));
                    if ($st !== 'passed' && $st !== 'completed') {
                        $allAssignmentsPassed = false;
                        break;
                    }
                }
            } elseif ($hasAssignments) {
                $allAssignmentsPassed = false;
            }

            // Can show certificate only if all assigned assessments and assignments are passed
            $canShowCertificate = false;
            if ($hasAssessments && $hasAssignmentItems) {
                $canShowCertificate = $allAssessmentsPassed && $allAssignmentsPassed;
            } elseif ($hasAssessments && !$hasAssignmentItems) {
                $canShowCertificate = $allAssessmentsPassed;
            } elseif (!$hasAssessments && $hasAssignmentItems) {
                $canShowCertificate = $allAssignmentsPassed;
            }

            $certButtonsHtml = '';
            if ($canShowCertificate) {
                $certButtonsHtml = '
                    <a href="#" data-id="' . $data->id . '" class="btn btn-outline-primary btn-sm get_certificates text-nowrap px-2 py-1 d-inline-flex align-items-center justify-content-center" style="font-size: 12px; border-radius: 4px;" data-bs-toggle="modal" data-bs-target="#certificateView">
                        <i class="fa-solid fa-eye me-1"></i>View Certificate
                    </a>
                    <a href="' . url('admin/download_certificate/' . $data->id) . '" target="_blank" class="btn btn-outline-primary btn-sm text-nowrap px-2 py-1 d-inline-flex align-items-center justify-content-center" style="font-size: 12px; border-radius: 4px;">
                        <i class="fa-solid fa-download me-1"></i>Download Certificate
                    </a>';
            }

            $childCardsHtml = '';

            // Card 1: Course Assessments (only if course has assessments)
            if ($hasAssessments && !empty($table1_rows)) {
                $childCardsHtml .= '
                <div class="card border rounded-3 ' . (!empty($table2_rows) ? 'mb-3' : 'mb-0') . ' shadow-sm bg-white overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0" style="table-layout: fixed; width: 100%;">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 14%; text-align: center; font-weight: 600; padding: 12px 14px;">Type</th>
                                    <th style="width: 38%; font-weight: 600; padding: 12px 16px;">Name</th>
                                    <th style="width: 16%; text-align: center; font-weight: 600; padding: 12px 14px;">Score</th>
                                    <th style="width: 16%; text-align: center; font-weight: 600; padding: 12px 14px;">Status</th>
                                    <th style="width: 16%; text-align: center; font-weight: 600; padding: 12px 14px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                ' . $table1_rows . '
                            </tbody>
                        </table>
                    </div>
                </div>';
            }

            // Card 2: Course Assignments (only if course has assignments)
            if (!empty($table2_rows)) {
                $hasHeaderAbove = ($hasAssessments && !empty($table1_rows));
                $childCardsHtml .= '
                <div class="card border rounded-3 mb-0 shadow-sm bg-white overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0" style="table-layout: fixed; width: 100%;">
                            <colgroup>
                                <col style="width: 14%;">
                                <col style="width: 38%;">
                                <col style="width: 16%;">
                                <col style="width: 16%;">
                                <col style="width: 16%;">
                            </colgroup>' . (!$hasHeaderAbove ? '
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 14%; text-align: center; font-weight: 600; padding: 12px 14px;">Type</th>
                                    <th style="width: 38%; font-weight: 600; padding: 12px 16px;">Name</th>
                                    <th style="width: 16%; text-align: center; font-weight: 600; padding: 12px 14px;">Score</th>
                                    <th style="width: 16%; text-align: center; font-weight: 600; padding: 12px 14px;">Status</th>
                                    <th style="width: 16%; text-align: center; font-weight: 600; padding: 12px 14px;">Action</th>
                                </tr>
                            </thead>' : '') . '
                            <tbody>
                                ' . $table2_rows . '
                            </tbody>
                        </table>
                    </div>
                </div>';
            }

            if (empty($childCardsHtml)) {
                $childCardsHtml = '
                <div class="card border rounded-3 mb-0 shadow-sm bg-white p-3 text-center text-muted">
                    No assessments or assignments found for this course.
                </div>';
            }

            $dropdownTablesHtml = '
            <div class="collapse" id="' . $collapseId . '">
                <div class="p-4 border-bottom" style="background-color: #f8fafc;">
                    ' . $childCardsHtml . '
                </div>
            </div>';

            // Main course row
            $course_html_data .= '<tr>
                <td class="fw-bold align-middle" style="padding: 14px 18px; font-size: 14px; color: #212529 !important;">
                    <i class="fa-solid fa-graduation-cap text-primary me-2"></i>' . htmlspecialchars($data->course_details->course_name ?? 'N/A') . '
                </td>
                <td class="align-middle" style="padding: 10px 18px;">
                    <div class="d-flex align-items-center justify-content-end gap-2">
                        ' . $certButtonsHtml . '
                        <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle-course px-3 py-1" data-bs-toggle="collapse" data-bs-target="#' . $collapseId . '" data-assign-id="' . $data->id . '" data-course-id="' . $data->course_id . '" aria-expanded="false" aria-controls="' . $collapseId . '" title="View Details">
                            <i class="fa-solid fa-chevron-down"></i>
                        </button>
                    </div>
                </td>
            </tr>
            <tr class="collapse-row">
                <td colspan="2" class="p-0 border-0">
                    ' . $dropdownTablesHtml . '
                </td>
            </tr>';
        }

        if (!$hasAnyCourses) {
            $course_html_data .= '<tr><td colspan="2" class="text-center py-3 text-muted">No courses found for this user.</td></tr>';
        }
    }

    $course_html_data .= '</tbody></table></div>';

    $userData['assignments_html'] = '';


$activity_data = Activity::where('user_id', $user->id)->orderBy('id', 'desc')->get();

//dd($activity_data);

$activity_html_data = ''; 

if (!$activity_data->isEmpty()) {
    foreach ($activity_data as $activity_datas) {
        // Append to the existing activity HTML instead of overwriting it
        $activity_html_data .= '<div class="row py-3">
                            <div class="col-12">
                                <div class="d-flex align-items-center">
                                    <div class="icon-bg-stiles">
                                        <i class="fa-regular fa-clipboard icon icon-stiles"></i>
                                    </div>
                                    <div class="activity-course-block">
                                    <span class="icon bg-primary"><i class="fa-regular fa-file icon-tag"></i></span> 
                                                <span class="ps-2 activity-course-name">' . $activity_datas->activity .' </span> 
                                        


                                    </div>
                                    
                                </div>
                                <div class="align-space">
                                           ' . $activity_datas->created_at .'
                                        </div>
                                
                            </div>
                        </div>';

    }
}

// Set the final HTML
$userData['reports_html'] = $html . '<div>
    <label class="my-2 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-award headings-icon py-1"></i> Course Assessments & Certificates</label>
    ' . $course_html_data . '
</div>';

$userData['assignment_modals_html'] = $assignment_modals_html;

$userData['activity_html'] = $activity_html_data;

// Build Course Reports HTML (Identical metrics to user-side reports)
$userAssignedForReports = Asigneduser::with(['course_details.category_details', 'category_details'])
    ->where('user_id', $user->id)
    ->has('course_details')
    ->get();

$overallTotalSeconds = 0;
$overallAttemptCount = 0;
$overallPassedCourses = 0;
$overallScores = [];
$coursesReportsCardsHtml = '';

foreach ($userAssignedForReports as $idx => $assign) {
    $cDetails = $assign->course_details;
    $courseId = $assign->course_id;

    $cDocIds = Course_documents::where('course_id', $courseId)
        ->where('type', 6)
        ->where('is_delete', 0)
        ->pluck('id');

    $cAssessmentResults = Assessment_results::where('user_id', $user->id)
        ->where(function($q) use ($assign, $cDocIds) {
            $q->where('assign_id', $assign->id)
              ->orWhereIn('course_document_id', $cDocIds);
        })
        ->whereNull('deleted_at')
        ->orderBy('id', 'asc')
        ->get();

    $cExamAttempts = ExamAttempt::where('user_id', $user->id)
        ->where(function($q) use ($assign, $courseId) {
            $q->where('assigned_id', $assign->id)
              ->orWhere('course_id', $courseId);
        })
        ->orderBy('id', 'asc')
        ->get();

    // Dynamically resolved application timezone & parser for timestamps
    $appTimezone = config('app.timezone') ?: (date_default_timezone_get() ?: 'UTC');
    $parseTimestamp = function($value) use ($appTimezone) {
        if (empty($value)) return null;
        if ($value instanceof \DateTimeInterface) {
            return Carbon::instance($value)->setTimezone($appTimezone);
        }
        $str = trim((string)$value);
        if ($str === '') return null;
        if (str_ends_with(strtoupper($str), 'Z')) {
            return Carbon::parse($str)->setTimezone($appTimezone);
        }
        return Carbon::parse($str, $appTimezone)->setTimezone($appTimezone);
    };

    // 1. Learning Time
    $cSeconds = 0;
    foreach ($cAssessmentResults as $res) {
        $sec = 0;
        if (!empty($res->total_time_taken) && is_numeric($res->total_time_taken)) {
            $sec = (int)$res->total_time_taken;
        } elseif (!empty($res->completed_at) && !empty($res->created_at)) {
            $tComp = $parseTimestamp($res->completed_at);
            $tCreate = $parseTimestamp($res->created_at);
            $sec = ($tComp && $tCreate) ? max(0, abs($tComp->timestamp - $tCreate->timestamp)) : 0;
        }
        $cSeconds += $sec;
    }
    foreach ($cExamAttempts as $att) {
        if (!empty($att->total_time) && is_numeric($att->total_time)) {
            $cSeconds += ((int)$att->total_time) * 60;
        }
    }
    $overallTotalSeconds += $cSeconds;

    if ($cSeconds >= 3600) {
        $hrs = floor($cSeconds / 3600);
        $mins = floor(($cSeconds % 3600) / 60);
        $cTotalTimeFormatted = $hrs . ' hr ' . $mins . ' min';
    } elseif ($cSeconds >= 60) {
        $mins = floor($cSeconds / 60);
        $secs = $cSeconds % 60;
        $cTotalTimeFormatted = $mins . ' min' . ($secs > 0 ? ' ' . $secs . ' sec' : '');
    } elseif ($cSeconds > 0) {
        $cTotalTimeFormatted = $cSeconds . ' sec';
    } else {
        $cTotalTimeFormatted = '0 min';
    }

    // First & Last Accessed (Dynamically converted to configured application/database timezone)
    $cAllDates = [];
    foreach ($cAssessmentResults as $res) {
        if ($d1 = $parseTimestamp($res->created_at)) $cAllDates[] = $d1;
        if ($d2 = $parseTimestamp($res->completed_at)) $cAllDates[] = $d2;
    }
    foreach ($cExamAttempts as $att) {
        if ($d1 = $parseTimestamp($att->created_at)) $cAllDates[] = $d1;
        $evalDate = $att->evaluation_completed_date ?? $att->updated_at;
        if ($d2 = $parseTimestamp($evalDate)) $cAllDates[] = $d2;
    }

    if (!empty($cAllDates)) {
        usort($cAllDates, function($a, $b) {
            return $a->timestamp <=> $b->timestamp;
        });
        $cFirstAccessed = $cAllDates[0]->format('d M Y, h:i A');
        $cLastAccessed = end($cAllDates)->format('d M Y, h:i A');
    } else {
        $cFirstAccessed = 'Not Yet Accessed';
        $cLastAccessed = 'Not Yet Accessed';
    }

    // 2. Attempts & Pass/Fail (Take latest up to 3 valid attempts per course)
    $rawAttempts = $cAssessmentResults->count() + $cExamAttempts->count();
    $cAttempts = min(3, $rawAttempts);
    $overallAttemptCount += $cAttempts;

    // Latest up to 3 attempts
    $latestAssessmentResults = $cAssessmentResults->count() > 3 ? $cAssessmentResults->slice(-3)->values() : $cAssessmentResults;
    $latestExamAttempts = $cExamAttempts->count() > 3 ? $cExamAttempts->slice(-3)->values() : $cExamAttempts;

    // Check if course has active assessments (type 6) or active assignments (type 7)
    $cActiveAssessments = Course_documents::where('course_id', $courseId)
        ->where('type', 6)
        ->where('is_delete', 0)
        ->where(function ($q) {
            $q->where('is_active', 1)->orWhereNull('is_active');
        })
        ->get();

    $cActiveAssignments = Course_documents::where('course_id', $courseId)
        ->where('type', 7)
        ->where('is_delete', 0)
        ->where(function ($q) {
            $q->where('is_active', 1)->orWhereNull('is_active');
        })
        ->get();

    $hasAssess = $cActiveAssessments->isNotEmpty();
    $hasAssign = $cActiveAssignments->isNotEmpty();

    $cHasPassed = false;
    if ($hasAssess || $hasAssign) {
        $allAssessPassed = true;
        if ($hasAssess) {
            foreach ($cActiveAssessments as $assess) {
                $passed = $cAssessmentResults->where('course_document_id', $assess->id)->contains(function($res) {
                    if (method_exists($res, 'hasPassed') && $res->hasPassed()) {
                        return true;
                    }
                    $payload = json_decode($res->result_data ?? '', true);
                    $details = $payload['results'] ?? json_decode($res->results ?? '', true);
                    $pf = strtolower(trim((string)($details['pass_or_fail'] ?? '')));
                    return ($pf === 'passed' || (isset($details['percentage'], $details['cutoff']) && (float)$details['percentage'] >= (float)$details['cutoff']));
                });
                if (!$passed) {
                    $allAssessPassed = false;
                    break;
                }
            }
        }

        $allAssignPassed = true;
        if ($hasAssign) {
            $uniqueExamCodes = $cActiveAssignments->pluck('file_path')->filter()->unique();
            if ($uniqueExamCodes->isEmpty()) {
                $allAssignPassed = false;
            } else {
                foreach ($uniqueExamCodes as $examCode) {
                    $exam = Exam::where('exam_code', $examCode)->first();
                    if (!$exam) {
                        $allAssignPassed = false;
                        break;
                    }
                    $passed = $cExamAttempts->where('exam_id', $exam->id)->contains(function($att) {
                        return strtolower(trim($att->exam_result ?? '')) === 'passed';
                    });
                    if (!$passed) {
                        $allAssignPassed = false;
                        break;
                    }
                }
            }
        }

        $cHasPassed = ($hasAssess ? $allAssessPassed : true) && ($hasAssign ? $allAssignPassed : true);
    } else {
        $cHasPassed = ((int)($assign->status ?? 0) === 3);
    }

    if ($cHasPassed) {
        $overallPassedCourses++;
        $cBadge = '<span class="report-badge-pass"><i class="fa-solid fa-circle-check me-1"></i>Passed</span>';
    } elseif ($cAttempts > 0) {
        $cBadge = '<span class="report-badge-fail"><i class="fa-solid fa-circle-xmark me-1"></i>Failed</span>';
    } else {
        $cBadge = '<span class="report-badge-neutral">Not Attempted</span>';
    }

    // Scores breakdown from latest up to 3 attempts
    $cScores = [];
    foreach ($latestAssessmentResults as $res) {
        $payload = json_decode($res->result_data ?? '', true);
        $details = $payload['results'] ?? json_decode($res->results ?? '', true);
        if (isset($details['percentage']) && is_numeric($details['percentage'])) {
            $score = round((float)$details['percentage'], 1);
            $cScores[] = $score;
            $overallScores[] = $score;
        }
    }

    foreach ($latestExamAttempts as $att) {
        if (isset($att->percentage) && is_numeric($att->percentage)) {
            $score = round((float)$att->percentage, 1);
            $cScores[] = $score;
            $overallScores[] = $score;
        }
    }

    // If passed on any attempt, ensure passing score is preserved
    if ($cHasPassed) {
        foreach ($cAssessmentResults as $res) {
            $payload = json_decode($res->result_data ?? '', true);
            $details = $payload['results'] ?? json_decode($res->results ?? '', true);
            $pf = strtolower(trim((string)($details['pass_or_fail'] ?? '')));
            if ($pf === 'passed' || (isset($details['percentage'], $details['cutoff']) && (float)$details['percentage'] >= (float)$details['cutoff'])) {
                if (isset($details['percentage']) && is_numeric($details['percentage'])) {
                    $pScore = round((float)$details['percentage'], 1);
                    if (!in_array($pScore, $cScores)) {
                        $cScores[] = $pScore;
                        $overallScores[] = $pScore;
                    }
                }
            }
        }
    }

    $cHighest = !empty($cScores) ? max($cScores) . '%' : '-';
    $cLowest = !empty($cScores) ? min($cScores) . '%' : '-';

    // Build per-assessment dropdown options if course has multiple assessments/assignments
    $cAssessmentOptions = [];
    $cAssessmentOptionsMap = [];

    foreach ($cActiveAssessments as $assessIdx => $assess) {
        $aRes = $cAssessmentResults->where('course_document_id', $assess->id);
        $aCount = min(3, $aRes->count());
        $aIsPassed = $aRes->contains(function($r) {
            if (method_exists($r, 'hasPassed') && $r->hasPassed()) return true;
            $payload = json_decode($r->result_data ?? '', true);
            $details = $payload['results'] ?? json_decode($r->results ?? '', true);
            $pf = strtolower(trim((string)($details['pass_or_fail'] ?? '')));
            return ($pf === 'passed' || (isset($details['percentage'], $details['cutoff']) && (float)$details['percentage'] >= (float)$details['cutoff']));
        });

        $aScores = [];
        $aLatest = $aRes->count() > 3 ? $aRes->slice(-3)->values() : $aRes;
        foreach ($aLatest as $r) {
            $payload = json_decode($r->result_data ?? '', true);
            $details = $payload['results'] ?? json_decode($r->results ?? '', true);
            if (isset($details['percentage']) && is_numeric($details['percentage'])) {
                $aScores[] = round((float)$details['percentage'], 1);
            }
        }
        if ($aIsPassed) {
            foreach ($aRes as $r) {
                $payload = json_decode($r->result_data ?? '', true);
                $details = $payload['results'] ?? json_decode($r->results ?? '', true);
                if (isset($details['percentage']) && is_numeric($details['percentage'])) {
                    $pScore = round((float)$details['percentage'], 1);
                    if (!in_array($pScore, $aScores)) $aScores[] = $pScore;
                }
            }
        }

        $aStatus = $aIsPassed ? 'Passed' : ($aCount > 0 ? 'Failed' : 'Not Attempted');
        $aKey = 'assess_' . $assess->id;
        $aName = !empty($assess->file_name) ? $assess->file_name : ('Assessment ' . ($assessIdx + 1));

        $optData = [
            'key' => $aKey,
            'name' => $aName,
            'type' => 'Assessment',
            'attempts' => $aCount,
            'status' => $aStatus,
            'highest_score' => !empty($aScores) ? max($aScores) . '%' : '-',
            'lowest_score' => !empty($aScores) ? min($aScores) . '%' : '-',
        ];
        $cAssessmentOptions[] = $optData;
        $cAssessmentOptionsMap[$aKey] = $optData;
    }

    if ($hasAssign) {
        $uniqueExamCodes = $cActiveAssignments->pluck('file_path')->filter()->unique();
        foreach ($uniqueExamCodes as $examCode) {
            $exam = Exam::where('exam_code', $examCode)->first();
            $examName = $exam && !empty($exam->name) ? $exam->name : $examCode;
            $examId = $exam ? $exam->id : 0;
            $eAtts = $cExamAttempts->where('exam_id', $examId);
            $eCount = min(3, $eAtts->count());
            $eIsPassed = $eAtts->contains(fn($a) => strtolower(trim($a->exam_result ?? '')) === 'passed');

            $eScores = [];
            $eLatest = $eAtts->count() > 3 ? $eAtts->slice(-3)->values() : $eAtts;
            foreach ($eLatest as $a) {
                if (isset($a->percentage) && is_numeric($a->percentage)) {
                    $eScores[] = round((float)$a->percentage, 1);
                }
            }

            $eStatus = $eIsPassed ? 'Passed' : ($eCount > 0 ? 'Failed' : 'Not Attempted');
            $eKey = 'exam_' . $examId;

            $optData = [
                'key' => $eKey,
                'name' => $examName,
                'type' => 'Assignment',
                'attempts' => $eCount,
                'status' => $eStatus,
                'highest_score' => !empty($eScores) ? max($eScores) . '%' : '-',
                'lowest_score' => !empty($eScores) ? min($eScores) . '%' : '-',
            ];
            $cAssessmentOptions[] = $optData;
            $cAssessmentOptionsMap[$eKey] = $optData;
        }
    }

    $cFirstAssess = !empty($cAssessmentOptions) ? $cAssessmentOptions[0] : null;
    $cCardAttempts = $cFirstAssess ? $cFirstAssess['attempts'] : $cAttempts;
    $cCardStatus = $cFirstAssess ? $cFirstAssess['status'] : ($cHasPassed ? 'Passed' : ($cAttempts > 0 ? 'Failed' : 'Not Attempted'));
    $cCardHighest = $cFirstAssess ? $cFirstAssess['highest_score'] : $cHighest;
    $cCardLowest = $cFirstAssess ? $cFirstAssess['lowest_score'] : $cLowest;

    if ($cCardStatus === 'Passed') {
        $cCardBadge = '<span class="report-badge-pass"><i class="fa-solid fa-circle-check me-1"></i>Passed</span>';
    } elseif ($cCardAttempts > 0) {
        $cCardBadge = '<span class="report-badge-fail"><i class="fa-solid fa-circle-xmark me-1"></i>Failed</span>';
    } else {
        $cCardBadge = '<span class="report-badge-neutral">' . $cCardStatus . '</span>';
    }

    // Dropdown HTML for multi-assessment courses
    $cDropdownHtml = '';
    if (count($cAssessmentOptions) > 1) {
        $cDropdownHtml .= '<div class="ms-auto" style="min-width: 170px; max-width: 240px;">';
        $cDropdownHtml .= '<select class="form-select form-select-sm report-assessment-select" style="font-size: 0.8rem; border-radius: 6px; border-color: #cbd5e1; font-weight: 500; cursor: pointer;">';
        foreach ($cAssessmentOptions as $idxOpt => $opt) {
            $selected = ($idxOpt === 0) ? 'selected' : '';
            $cDropdownHtml .= '<option value="' . htmlspecialchars($opt['key']) . '" ' . $selected . '>' . htmlspecialchars($opt['name']) . '</option>';
        }
        $cDropdownHtml .= '</select></div>';
    }

    $cOptionsJson = htmlspecialchars(json_encode($cAssessmentOptionsMap), ENT_QUOTES, 'UTF-8');

    $courseName = htmlspecialchars($cDetails->course_name ?? 'Course');
    $catName = htmlspecialchars($assign->category_details->category_name ?? ($cDetails->category_details->category_name ?? 'Category'));
    $collapseId = 'reportCourseCollapse_' . $assign->id;

    $isFirst = ($idx === 0);
    $collapseClass = $isFirst ? 'show' : '';
    $headerCollapsedClass = $isFirst ? '' : 'collapsed';
    $ariaExpanded = $isFirst ? 'true' : 'false';

    $coursesReportsCardsHtml .= '
    <div class="card mb-4 border rounded-3 shadow-sm bg-white overflow-hidden" style="border: 1px solid #e2e8f0 !important;">
        <div class="card-header py-3 px-4 d-flex align-items-center justify-content-between flex-wrap gap-2 cursor-pointer ' . $headerCollapsedClass . '" style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0;" data-bs-toggle="collapse" data-bs-target="#' . $collapseId . '" aria-expanded="' . $ariaExpanded . '" aria-controls="' . $collapseId . '">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 42px; height: 42px; background: rgba(0, 84, 82, 0.1); color: #005452;">
                    <i class="fa-solid fa-graduation-cap fs-5"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-dark mb-1" style="font-size: 1rem;">' . $courseName . '</h6>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-white text-secondary border px-2 py-1"><i class="fa-regular fa-folder me-1 text-primary"></i>' . $catName . '</span>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                ' . $cBadge . '
                <div class="rounded-circle bg-white border d-flex align-items-center justify-content-center text-muted" style="width: 32px; height: 32px;">
                    <i class="fa-solid fa-chevron-down fs-7 chevron-icon"></i>
                </div>
            </div>
        </div>
        <div id="' . $collapseId . '" class="collapse ' . $collapseClass . '" data-bs-parent="#courseReportsAccordion">
            <div class="card-body p-4 bg-white">
                <div class="row g-4">
                    <!-- Card 1: Total Learning Time -->
                    <div class="col-12 col-md-6">
                        <div class="report-stat-card">
                            <div class="d-flex align-items-center mb-3 pb-2 border-bottom">
                                <div class="rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="background: rgba(0, 84, 82, 0.1); width: 38px; height: 38px;">
                                    <i class="fa-solid fa-clock fs-5" style="color: #005452;"></i>
                                </div>
                                <div>
                                    <h6 class="report-card-heading">Total Learning Time</h6>
                                    <small class="text-muted">Course duration and access records</small>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="report-label mb-1">Total time on course</div>
                                <div class="report-value-big" style="color: #005452;">' . $cTotalTimeFormatted . '</div>
                            </div>
                            <div class="pt-3 border-top">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="report-label"><i class="fa-regular fa-calendar-check text-muted me-1"></i> First Accessed</div>
                                    <div class="report-value-text">' . $cFirstAccessed . '</div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="report-label"><i class="fa-regular fa-calendar-days text-muted me-1"></i> Last Accessed</div>
                                    <div class="report-value-text">' . $cLastAccessed . '</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Assessments -->
                    <div class="col-12 col-md-6">
                        <div class="report-stat-card" data-assessment-options=\'' . $cOptionsJson . '\'>
                            <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom flex-wrap gap-2">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="background: rgba(0, 84, 82, 0.1); width: 38px; height: 38px;">
                                        <i class="fa-solid fa-chart-line fs-5" style="color: #005452;"></i>
                                    </div>
                                    <div>
                                        <h6 class="report-card-heading">Assessments</h6>
                                        <small class="text-muted">Attempts and score summary</small>
                                    </div>
                                </div>
                                ' . $cDropdownHtml . '
                            </div>
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <div class="p-2 rounded bg-light border">
                                        <div class="report-label mb-1">No. of Attempts</div>
                                        <div class="report-value-big text-dark report-stat-attempts">' . $cCardAttempts . '</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-2 rounded bg-light border">
                                        <div class="report-label mb-1">Passed In</div>
                                        <div class="mt-1 report-stat-badge">' . $cCardBadge . '</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2 pt-2 border-top">
                                <div class="col-6">
                                    <div class="report-label mb-1"><i class="fa-solid fa-arrow-trend-up text-success me-1"></i> Highest Score</div>
                                    <div class="fs-5 fw-bold text-success report-stat-highest">' . $cCardHighest . '</div>
                                </div>
                                <div class="col-6">
                                    <div class="report-label mb-1"><i class="fa-solid fa-arrow-trend-down text-danger me-1"></i> Lowest Score</div>
                                    <div class="fs-5 fw-bold text-secondary report-stat-lowest">' . $cCardLowest . '</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
}

// Overall summary header
if ($overallTotalSeconds >= 3600) {
    $hrs = floor($overallTotalSeconds / 3600);
    $mins = floor(($overallTotalSeconds % 3600) / 60);
    $overallTotalTimeFormatted = $hrs . ' hr ' . $mins . ' min';
} elseif ($overallTotalSeconds >= 60) {
    $mins = floor($overallTotalSeconds / 60);
    $secs = $overallTotalSeconds % 60;
    $overallTotalTimeFormatted = $mins . ' min' . ($secs > 0 ? ' ' . $secs . ' sec' : '');
} elseif ($overallTotalSeconds > 0) {
    $overallTotalTimeFormatted = $overallTotalSeconds . ' sec';
} else {
    $overallTotalTimeFormatted = '0 min';
}

$overallMaxScore = !empty($overallScores) ? max($overallScores) . '%' : '-';
$overallMinScore = !empty($overallScores) ? min($overallScores) . '%' : '-';

$courseReportsHtml = '
<div class="col-12 p-2">
    <div class="row">
        <!-- Card 1: Total Learning Time -->
        <div class="col-12 col-md-4 my-2">
            <div class="reports-card reports-card1">
                <div class="d-flex align-items-center justify-content-start">
                    <div class="reports-icon reports-icon1"><i class="fa-solid fa-clock"></i></div>
                    <div class="ms-3">
                        <h6>Total Learning Time</h6>
                        <h6 class="text-center mb-0">' . $overallTotalTimeFormatted . '</h6>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card 2: Total No. of Attempts -->
        <div class="col-12 col-md-4 my-2">
            <div class="reports-card reports-card2">
                <div class="d-flex align-items-center justify-content-start">
                    <div class="reports-icon reports-icon2"><i class="fa-solid fa-file-pen"></i></div>
                    <div class="ms-3">
                        <h6>Total No. of Attempts</h6>
                        <h6 class="text-center mb-0">' . $overallAttemptCount . '</h6>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card 3: Completed Courses -->
        <div class="col-12 col-md-4 my-2">
            <div class="reports-card reports-card3">
                <div class="d-flex align-items-center justify-content-start">
                    <div class="reports-icon reports-icon3"><i class="fa-solid fa-user-check"></i></div>
                    <div class="ms-3">
                        <h6>Completed Courses</h6>
                        <h6 class="text-center mb-0">' . $completed_course . '</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 mb-3">
        <label class="my-2 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-chart-pie headings-icon py-1"></i> Course-wise Detailed Reports</label>
    </div>' . (empty($coursesReportsCardsHtml) ? '
    <div class="bg-white p-4 text-center rounded-3 border">
        <img src="' . url('public/images/no-cer-found-image.jpg') . '" class="img-fluid mx-auto d-block" style="max-height: 120px;" alt="">
        <div class="text-muted mt-2">No assigned courses or reports found for this user.</div>
    </div>' : '<div class="accordion course-reports-accordion" id="courseReportsAccordion">' . $coursesReportsCardsHtml . '</div>') . '
</div>';

$userData['course_reports_html'] = $courseReportsHtml;

return response()->json($userData);

}



public function revokeCourse(Request $request)
{
    $id=$request->assigned_user_id;

    //dd($id);
    AsignedUser::where('id', $id)
               ->delete();
     return redirect('users?tab=2')->with('success', 'Course revoked successfully.');
}



    // public function coursecatalog(Request $request)
    // {
    //     $category_list=Category::get();
    //     $sub_category_list=Subcategory::get();
    //     $courses_lists=Courses::with('category_details')->get();
    //     $users_lists=User::with('assigned_users')->where('user_type','!=',1)->get();
    //     $lastCourse = Courses::latest()->first();
    //     // /dd($lastCourse);

    //     return view('admin.coursecatalog.course_catalog',compact('category_list','sub_category_list','courses_lists','users_lists','lastCourse'));
    // }


public function assignCourseToUser(Request $request) {

    //dd($request->all());
    $responseData = [];
    $user_id = User::latest()->first();
    $courseid=$request->courseid;
    $categoryid=$request->categoryid;
    $subcategoryid=$request->subcategoryid;
    $course_details=Courses::where('id',$courseid)->first();
   

        if ($request->status==0 ) {
           
            AsignedUser::where('user_id', $user_id->id)
                                         ->where('course_id', $courseid)->delete();

    
                $responseData['status'] = 0;                            
        } else {
            AsignedUser::create([
                'user_id' => $user_id->id,
                'course_id' => $courseid,
                'category_id' => $categoryid,
                'subcategory_id' =>$subcategoryid,
            ]);

         
             $responseData['status'] = 1;
               } 
            
    if ($responseData['status'] == 0) {
        $responseData['message'] = 'Course Removed to user Successfully.';
    } else {
        $responseData['message'] = 'Course Add to user Successfully.';
    }

   
      
         return response()->json($responseData);
}


public function fetch_assigned_groups(Request $request)
{

    //dd($request->all());
    $groupId = $request->groupId;
    $users = User::where('user_type','!=',1)->get();
    
    $responseData = [];

    foreach ($users as $user) {
        $assignedUser = Assigned_Group::where('user_id',$user->id)->where('group_id', $groupId)->first(); 

       
            $userData = [
                'assigned_user_id' => $assignedUser->id??0,
                'userid' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'emp_id' => $user->emp_id??'',
                'last_login' => $user->last_login? Carbon::parse($user->last_login)->format('d-m-Y') : null,
                'created_at' => $user->created_at? Carbon::parse($user->created_at)->format('d-m-Y') : null,
                'groupId' => $groupId,
            ];
    
            $responseData[] = $userData;


    }            //dd($responseData);


    return response()->json($responseData);
}

public function add_group_to_user(Request $request)
{

    //dd($request->all());
    $responseData = [];
    $groupIds = $request->groupId;
    $groups=Group::where('id',$groupIds)->first();
    $assignedUserId = $request->id;
    $user_id=$request->userid;

   

        if ($request->status==0 ) {
            //dd('hello');
           
            Assigned_Group::where('user_id', $user_id)
                                         ->where('group_id', $groupIds)->delete();
                                              
        } else {
            //dd('hi');
            Assigned_Group::create([
                'user_id' => $user_id,
                'group_id' => $groupIds,
            ]);

            $responseData[] = 'New user created for Group ' . $groups->name;
        }

    return response()->json($responseData);
}

 public function fetchCategoryData(Request $request)
{
    // Retrieve the Category based on the provided CategoryId
    $category = Category::find($request->CategoryId);

    if (!$category) {
        return response()->json(['error' => 'Category not found'], 404);
    }

    if (!empty($category->image)) {
            $category_image = url("storage/app/public/" . $category->image);
        } else {
            $category_image = url("public/images/course.jpg"); // Default image URL
        }

    // Fetch all courses associated with the retrieved Category
    $courses = Courses::where('category_id', $category->id)->get();
    //dd($courses);

    // Prepare the response data
    $assignedCoursesData = [];
    foreach ($courses as $course) {
        // Check if the course is assigned to the category
        $assign = Asigneduser::where('category_id', $category->id)
                              ->where('course_id', $course->id)
                              ->first();


                              if($course->course_type == 2){
                                $coursetype="InstructorLed Course";
                              }else{
                                $coursetype="Online Course";
                              }

          $course_image = null;
        if (!empty($course->course_image)) {
            $course_image = url("storage/app/public/" . $course->course_image);
        } else {
            $course_image = url("public/images/course.jpg"); // Default image URL
        }



        $assignedCoursesData[] = [
            'course_id' => $course->id,
            'course_name' => $course->course_name,
            'course_type_name' => $coursetype,
            'category_name' => $course->category_details->category_name, // Assuming you have a relationship defined
            'category_id' => $course->category_id,
            'subcategory_id' => $course->subcategory_id,
            'course_created_at' => $course->created_at->format('d-m-Y'),
            'assign_id' => $assign ? $assign->id : 0, // Check if assignment exists
            'updated_at' => $assign ? $assign->updated_at : null, // Check if assignment exists
            'course_image'=>$course_image,
            'category_image'=>$category_image,
            'category_name_new'=>$category->category_name??'',
            'course_type'=>$course->course_type??'',
            'users_enrolled' => $course->Assigned_usersdetails->count() ?? 0,
        ];
    }

    $userData['courses'] = $assignedCoursesData;
    //dd($userData);

    // Return the JSON response with the data
    return response()->json($userData);
}

public function get_courses_based_on_filters(Request $request)
{
   //dd($request->all());

    $query = Courses::query();

    $query->with('Assigned_usersdetails')
          ->where(function($q) use ($request) {
              if (!empty($request->catg_id)) {
                  $q->whereIn('category_id', $request->catg_id);
              }
              if (!empty($request->status)) {
                  $q->where('active', $request->status);
              }
          });

    if ($request->assigned_status == 0 && $request->assigned_status != "") {
        $query->whereDoesntHave('Assigned_usersdetails', function($q) use ($request) {
            $q->where('user_id', $request->user_id);
        });
    } elseif ($request->assigned_status == 1) {
        $query->whereHas('Assigned_usersdetails', function($q) use ($request) {
            $q->where('user_id', $request->user_id);
        });
    }

    if (!empty($request->search_query)) {
        $query->where(function ($q) use ($request) {
            $q->where('course_name', 'like', '%' . $request->search_query . '%')
              ->orWhereHas('category_details', function ($query) use ($request) {
                  $query->where('category_name', 'like', '%' . $request->search_query . '%');
              });
        });
    }

    $list = $query->get();
    // /dd($list);
    $html='';
    foreach ($list as $key => $course) {
         $assign = Asigneduser::where(['course_id'=>$course->id,'user_id'=>$request->user_id])->first();
         $assign_id = $assign->id??0;
         $reassign_button = $assign
             ? '<button type="button" class="btn btn-sm btn-outline-primary ms-2 reassign-course" data-course-id="'.$course->id.'" data-user-id="'.$request->user_id.'">Reassign</button>'
             : '';

        $checked='';$course_image = null;
        if(!empty($assign)) {$checked='Checked';}
         
        if (!empty($course->course_image)) {
            $course_image = url("storage/app/public/" . $course->course_image);
        } else {
            $course_image = url("public/images/face12.jpg"); // Default image URL
        }
        $category_name=$course->category_details->category_name??"";
         $last_updated = $course->updated_at ? \Carbon\Carbon::parse($course->updated_at)->format("d-m-Y"):"";
        $html.='<tr>
                            
                            <td style="width: 560px;">
                                <div class="d-flex align-items-center">
                                    <div class="course-image-sm">
                                        <img src="'. $course_image .'" class="img-fluid" alt="">
                                    </div>
                                    <div class="ms-2">
                                        <div class="course-name font-weight-bold">'.$course->course_name.'</div>
                                    </div>
                                </div>
                            </td>
                            <td>'.$category_name.'</td>
                             <td>
                              <div class="d-flex align-items-center"><div class="custom-control custom-switch">
                                        <input type="checkbox" class="user_checked mr-3 custom-control-input toggle-class" data-onstyle="1"  data-offstyle="0"  id="aztoggle-'.$course->id.'" data-courseid="'.$course->id.'"  data-assigned_user_id= "'.$assign_id.'" 
                                        data-user_id="'.$request->user_id.'" '.$checked.'>

                                         <label class="custom-control-label" for="aztoggle-'.$course->id.'"></label>

                                    </div>'.$reassign_button.'</div>

                            </td>
                        </tr>';
        }
    return $html;
}


public function showChangePasswordForm()
    {
        return view('admin.changepassword');
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

        return redirect()->route('admin.password.change')->with('success', 'Password changed successfully');

    }


     public function admin_profile()
    {

        $user = Auth::user();
        //dd($user);
        return view('admin.my_profile',compact('user'));
    }

    public function admin_update_profile_image(Request $request)
    {

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

        return redirect()->route('admin-profile.view')->with('success', 'Profile picture changed successfully');
    }


      return redirect()->route('admin-profile.view')->with('error', 'Error uploading image');

    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function upload_all_users_from_skilmatrix(Request $request)
    {
         $users = [];
        $client = new \GuzzleHttp\Client();
        $res = $client->get('https://tasengg.com/tasskillmax/api/getAllUserData');
        $response = json_decode($res->getBody(),true);
        $users =$response['user_data']??[];
        foreach ($users as $key => $value) {
           // 
            $check= User::where('email',$value['email'])->first();

            if(empty($check)){
                $dep = Department::where('department_name',$value['add_employee']['emp_dept'])->first();
                $desig = Designation::where('designation_name',$value['add_employee']['emp_desgn'])->first();
                $userData = [
                    
                    'first_name' => $value['name'],
                    'emp_id' => $value['emp_id'],
                    'email' => $value['email'],
                    'password' => Hash::make('India@456$'),
                    'username' => $value['email'],
                    'user_type' => 2,
                    
                    'team_lead' => $value['add_employee']['emp_team_lead'],
                    'reporting_manager1' => $value['add_employee']['emp_reporting_manager_1'],
                    'reporting_manager2' => $value['add_employee']['emp_reporting_manager_2'],
                    'department' => $dep->id??0,
                    'designation' => $desig->id??0,
                    'active' => 1];
                User::updateOrCreate(['email'=>$value['email']],$userData);
            }
           
        }
        return redirect(url('users')."?tab=2")->withSuccess('All Users Added Successfully');

    }


    public function download_certificate(Request $request, $id = null)
    {
        $assignId = $id ?? $request->id ?? $request->assign_id;

        $siteLogo = \DB::table('tbl_logo_application')->latest()->first();

        $data = Asigneduser::with(['course_details.certificate_data.template_data', 'users_data'])->where('id', $assignId)->first();

        if (!$data || !$data->course_details) {
            return redirect()->back()->with('error', 'Assigned course not found.');
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
        $content = str_replace('[Learner_name]', $learnerName, $html);
        $content = str_replace('[Course_name]', $data->course_details->course_name ?? '', $content);
        $content = str_replace('[first_image]', $firstImageSrc, $content);
        $content = str_replace('[second_image]', $secondImageSrc, $content);
        $content = str_replace('[first_link]', asset('public/vendors/css/bootstrap.min.css'), $content);
        $content = str_replace('[second_link]', asset('public/css/horizontal-layout/style.css'), $content);
        $content = str_replace('[third_link]', asset('public/css/horizontal-layout/lms.css'), $content);

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

        $pdf = \Illuminate\Support\Facades\App::make('dompdf.wrapper');
        $options = $pdf->getDomPDF()->getOptions();
        $options->set('isRemoteEnabled', true);
        $options->set('isFontSubsettingEnabled', false);
        $options->set('defaultFont', 'DejaVu Sans');

        $pdf->getDomPDF()->setOptions($options);
        $pdf->setPaper('a4', 'landscape');
        $pdf->loadHTML($content);

        $fileName = ($data->course_details->course_name ?? 'Certificate') . '_' . ($data->users_data->first_name ?? 'User') . '.pdf';

        return $pdf->download($fileName, ["Attachment" => false]);
    }

}
