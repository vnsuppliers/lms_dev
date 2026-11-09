<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Courses;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Asigneduser;
use App\Models\Course_documents;
use App\Models\Notifications;
use App\Models\Offline_Documents;
use App\Models\Course_Training_data;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Certificate;
use App\Models\Mail_templates;
use App\Models\Certificate_template;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Mail;
use App\Models\Group;
use App\Models\Roles;
use App\Models\Assessment_results;
use App\Models\ExamAttempt;
use App\Models\AssessmentVideoAccess;

class AdminCoursesController extends Controller
{
	 /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function add_coursecatalog(Request $request)
    {
    

    if($request->save_as_draft==1){
        $validationRules = [
            'course_name' => 'required'
        ];
    }else{
        $validationRules = [
            'course_name' => 'required',
            'category_id' => 'required'
        ];
    }

        if (empty($request->goal)) {
            $request->merge(['goal' => 2]);
        }

        if ($request->active === null || !isset($request->active)) {
            dd('hi');
            $request->merge(['active' => 1]);
        }

    //dd($request->all());
        if ($request->hasFile('intro_video_link')) {
            //dd('file');
            $validationRules['intro_video_link'] = 'nullable|file|mimes:mp4,mov,avi,wmv';
        } else {
            //dd('url');
            $validationRules['intro_video_link'] = 'nullable|url';
        }

        $validation = Validator::make($request->all(), $validationRules);

    //dd($validation->errors());

        if ($validation->fails()) {
            $errorMessage = $validation->errors()->first('category_id');
            return redirect('coursecatalog?tab=1')->with('error',$errorMessage);
        }

        $courseData = $request->except(['_token','documents','save_as_draft','content_type']);

        // Auto-assign certificate from category if certificate is empty or not provided
        if (empty($courseData['certificate']) && !empty($courseData['category_id'])) {
            $categoryHierarchy = [];
            $currCat = Category::find($courseData['category_id']);
            while ($currCat) {
                $categoryHierarchy[] = $currCat->id;
                $currCat = $currCat->parent_id ? Category::find($currCat->parent_id) : null;
            }

            $matchedCertificate = Certificate::whereIn('category_id', $categoryHierarchy)
                ->orWhereIn('parent_id', $categoryHierarchy)
                ->latest('id')
                ->first();

            if ($matchedCertificate) {
                $courseData['certificate'] = $matchedCertificate->id;
            }
        }

        if ($request->hasFile('intro_video_link')) {

            $videoFile = $request->file('intro_video_link');
            $videoFileName = uniqid() . '_' . $videoFile->getClientOriginalName();
            $videoFilePath = $videoFile->storeAs('videos', $videoFileName, 'public');
            $courseData['intro_video_link'] = 'videos/' . $videoFileName;
        }

        if ($request->hasFile('course_image')) {
            $course_imageFile = $request->file('course_image');
            $course_imageFileName = uniqid() . '_' . str_replace(" ", "", $course_imageFile->getClientOriginalName());
            $course_imagesFilePath = $course_imageFile->storeAs('course_images', $course_imageFileName, 'public');
            $courseData['course_image'] = 'course_images/' . $course_imageFileName;
        }
        //dd($request->all());
        $course = Courses::updateOrCreate(['id' => $request->id],$courseData);
        //dd($course);
        $paths=[];$links = $request->documents_link; $documents = $request->documents;

    if($request->save_as_draft==1){
        $request->active=2;
    }
    Courses::where('id',$course->id)->update(['active'=>$request->active]);
    Asigneduser::where('course_id',$course->id)->update(['category_id'=>$request->category_id]);
    if($request->save_as_draft==1){
        //dd('hi');
        return redirect(url('coursecatalog'))->with('success', 'Course ' . ($request->has('id') ? 'Drafted' : 'Drafted') . ' successfully.');
    }
        if (!isset($request->id)) {
            //dd('hello');
            session(['admin_course_id' => $course->id]);
            return redirect(url('coursecatalog?tab=1&menu=1&id='.$course->id))->with('success', 'Course ' . ($request->has('id') ? 'created' : 'updated') . ' successfully.');
        } else {

            //dd('hiii');
            session()->forget('admin_course_id'); 
            return redirect(url('coursecatalog?tab=1&menu=1&id='.$course->id))->with('success', 'Course ' . ($request->has('id') ? 'updated' : 'created') . ' successfully.');
        }

        
    }




public function delete_document(Request $request)
{
   
    $data = Course_documents::where('id', $request->id)->first();
    if (!$data) {
        return redirect(url('coursecatalog?tab=1&menu=1&id=' . $request->course_id))
            ->with('error', 'Document not found');
    }

    if ($data->type == 6 || $data->type == 7) {
        $assignedUsers = $data->course_details->Assigned_usersdetails;

        if ($assignedUsers->count() > 0) {
            return redirect(url('coursecatalog?tab=1&menu=1&id=' . $data->course_id))
                ->with('error', 'Please remove all assigned users before deleting the document.');
        }
    }
    $data->is_delete = 1;
    $data->save();

    return redirect(url('coursecatalog?tab=1&menu=1&id=' . $data->course_id))
        ->with('success', 'Document deleted successfully');
}


public function add_content_type(Request $request)
{
    // dd($request->all());
    try{
    if ($request->content_type == '4') {
        $request->validate([
            'content_type' => 'required',
            'content_type_upload' => 'required|file|mimetypes:application/zip,application/octet-stream'
        ]);

        if ($request->hasFile('content_type_upload')) {
            try{
            $videoFile = $request->file('content_type_upload');
            $videoFileName = uniqid() . '_' . str_replace(" ", "", $videoFile->getClientOriginalName());
            $videoFilePath = $videoFile->storeAs('scrom_videos', $videoFileName, 'public');
           $data = Course_documents::create(['course_id'=>$request->id, 'type'=>4, 'file_name'=>$videoFileName, 'file_path'=>$videoFilePath, 'status'=>1]);
                } catch (\Exception $e) {

                return response()->json(['message' => $e->getMessage()], 400);
            }
           return response()->json(['message' => '<span style="color:green;">File successfully uploaded and content uploaded.</span>','files'=>$data]);
        }         
    }elseif ($request->content_type == '3') {
        $request->validate([
            'content_type' => 'required',
            'content_type_upload' => 'required|file|mimes:mp4,mov,avi,wmv'
        ]);

        if ($request->hasFile('content_type_upload')) {
            $videoFile = $request->file('content_type_upload');
            $videoFileName = uniqid() . '_' . $videoFile->getClientOriginalName();
            $videoFilePath = $videoFile->storeAs('local_uploads', $videoFileName, 'public');
        $data = Course_documents::create(['course_id'=>$request->id, 'type'=>3, 'file_name'=>$videoFileName, 'file_path'=>$videoFilePath, 'status'=>1]);
        return response()->json(['message' => '<span style="color:green;">File successfully uploaded and content uploaded.</span>','files'=>$data]);
         }
    }elseif ($request->content_type == '5') {
        $request->validate([
            'content_type' => 'required',
            'content_type_upload' => 'required|file|mimes:pdf'
        ]);

        if ($request->hasFile('content_type_upload')) {
            $videoFile = $request->file('content_type_upload');
            $videoFileName = uniqid() . '_' . $videoFile->getClientOriginalName();
            $videoFilePath = $videoFile->storeAs('local_uploads', $videoFileName, 'public');

         $data = Course_documents::create(['course_id'=>$request->id, 'type'=>5, 'file_name'=>$request->file_name,'org_file_name'=>$videoFileName, 'file_path'=>$videoFilePath, 'status'=>1]);
         return response()->json(['message' => '<span style="color:green;">File successfully uploaded.</span>','files'=>$data]);
         }
        } elseif ($request->content_type == '1' || $request->content_type == '2'|| $request->content_type == '6' || $request->content_type == '7'){
           $courseData = Courses::where('id', $request->id)->first();
           $data = Course_documents::create([
                'course_id' => $request->id,
                'type' => $request->content_type,
                'file_name' => $request->file_name,
                'file_path' => $request->documents_link,
                'expiration_date' => $courseData->expiration_date,
                'status' => 1
            ]);
            return response()->json(['message' => '<span style="color:green;">Url successfully uploaded.</span>','files'=>$data]);
        }
    } catch (\Exception $e) {

    return response()->json(['message' => '<span style="color:red;">'.$e->getMessage().'</span>'], 400);
}
 return response()->json(['message' => '<span style="color:red;">No file uploaded.</span>'], 400);
}
	public function fetch_assignedCourses_userData(Request $request)
{
    $courseId = $request->userId;

    // Retrieve users where user_type JSON array does not contain 1
    $users = User::whereJsonDoesntContain('user_type', 1)->get();
    
    $responseData = [];

    foreach ($users as $user) {
        $assignedUser = Asigneduser::where('user_id', $user->id)
                                   ->where('course_id', $courseId)
                                   ->first(); 

        $userData = [
            'assigned_user_id' => $assignedUser->id ?? 0,
            'userid' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'last_login' => $user->last_login ? Carbon::parse($user->last_login)->format('d-m-Y') : null,
            'created_at' => $user->created_at ? Carbon::parse($user->created_at)->format('d-m-Y') : null,
            'courseId' => $courseId,
            'user_type' => $user->user_type,
            'user_role' => in_array(1, json_decode($user->user_type, true)) ? 'admin' : 'user', // Check if 1 is in the user_type array
        ];

        $responseData[] = $userData;
    }

    return response()->json($responseData);
}



public function course_add_to_users(Request $request)
{


    $responseData = [];
    $courseIds = $request->courseId;
    $courses=Courses::where('id',$request->courseId)->first();
    $assignedUserId = $request->id;
    $user_id=$request->userid;

        if ($request->status==0 ) {  
            AsignedUser::where('user_id', $user_id)

                                         ->where('course_id', $courseIds)->delete();

           // Notifications::create([ 
           //     'user_id' => $user_id,
           //      'href_url' => 'http://localhost/repo_lms_sourcecode/mycourse_catalog',
           //      'message' =>'Deleted Assignment for Course ' . $courses->course_name,
           //      ]); 
                       
                       $responseData['status'] = 0;                       

        } else {
            AsignedUser::create([
                'user_id' => $user_id,
                'course_id' => $request->courseId,
                'category_id' => $courses->category_id,
                'subcategory_id' =>$courses->subcategory_id??'',
            ]);



            // Notifications::create([
            //     'user_id' => $user_id,
            //      'href_url' => 'http://localhost/repo_lms_sourcecode/mycourse_catalog',
            //     'message' =>'New assignment created for Course ' . $courses->course_name,
            // ]);
           $responseData['status'] = 1;

        }

    if ($responseData['status'] == 0) {
        $responseData['message'] = 'Course Removed Successfully.';
    } else {
        $responseData['message'] = 'Course Added Successfully.';
    }

    return response()->json($responseData);
}


public function fetch_signleCourse_userData(Request $request)
{
    $responseData = [];

    // Check if courseid is provided
        $course = Courses::find($request->courseid);
    

    if (!$course) {
        return response()->json(['error' => 'Course not found'], 404);
    }

    $user_id = $request->userid;
    $status = $request->status;
    $user= User::where('id',$user_id)->first();

    if ($status == 0) {
        // Delete the assignment
        AsignedUser::where('user_id', $user_id)
                   ->where('course_id', $course->id)
                   ->delete();

        $responseData['status'] = 0;
    } else {
        // Create the assignment
        AsignedUser::firstOrCreate([
            'user_id' => $user_id,
            'course_id' => $course->id,
        ], [
            'category_id' => $course->category_id,
            'subcategory_id' => $course->subcategory_id ?? 0,
        ]);

        $responseData['status'] = 1;
    }

    // Prepare the success message
    if ($responseData['status'] == 0) {
        $responseData['message'] = 'Course Removed Successfully.';
    } else {
        $email = Mail_templates::where('title','Assigning Courses')->first();
        //dd($email);
            $content=str_replace('[Course_name]',$course->course_name,$email->template);
                Mail::send([], [], function ($message) use($user,$email,$content) {
              $message->to($user->email)
                ->subject($email->subject)
                ->setBody($content, 'text/html'); 
            });
                Notifications::create([
                'user_id' => $user_id,
                 'href_url' => url('user_courses'),
                'message' =>'You have just been assigned a new course',
            ]);
        $responseData['message'] = 'Course Added Successfully.';
    }

    

    return response()->json($responseData);
}

public function reassignCourseToUser(Request $request)
{
    $validated = $request->validate([
        'user_id' => ['required', 'integer', 'exists:users,id'],
        'course_id' => ['required', 'integer', 'exists:tbl_courses,id'],
    ]);

    $course = Courses::findOrFail($validated['course_id']);

    return DB::transaction(function () use ($validated, $course) {
        $assignments = AsignedUser::where('user_id', $validated['user_id'])
            ->where('course_id', $course->id)
            ->get();

        if ($assignments->isEmpty()) {
            return response()->json([
                'message' => 'This course is not assigned to the selected user.',
            ], 422);
        }

        $assignmentIds = $assignments->pluck('id');
        $assessmentIds = Course_documents::where('course_id', $course->id)
            ->where('type', 6)
            ->pluck('id');

        $resetAssessmentCount = Assessment_results::where('user_id', $validated['user_id'])
            ->whereIn('course_document_id', $assessmentIds)
            ->delete();

        AssessmentVideoAccess::whereIn('assign_id', $assignmentIds)->delete();

        AsignedUser::whereIn('id', $assignmentIds)->delete();

        $newAssignment = AsignedUser::create([
            'user_id' => $validated['user_id'],
            'course_id' => $course->id,
            'category_id' => $course->category_id,
            'subcategory_id' => $course->subcategory_id ?? 0,
            'status' => 0,
        ]);

        return response()->json([
            'message' => 'Course reassigned successfully with fresh assessments.',
            'assignment_id' => $newAssignment->id,
            'reset_assessment_count' => $resetAssessmentCount,
        ]);
    });
}

public function reassignAssessmentToAll(Request $request)
{
    $validated = $request->validate([
        'assessment_id' => ['required', 'integer'],
    ]);

    return DB::transaction(function () use ($validated) {
        $assessment = Course_documents::where('id', $validated['assessment_id'])
            ->where('type', 6)
            ->firstOrFail();

        if (!$assessment->is_active) {
            return response()->json([
                'message' => 'Activate the assessment before reassigning it.',
            ], 422);
        }

        $course = Courses::findOrFail($assessment->course_id);

        // Find users who actually attempted this assessment
        $attemptQuery = Assessment_results::where('course_document_id', $assessment->id);
        $attemptedUserIds = (clone $attemptQuery)->pluck('user_id')->unique()->values();

        if ($attemptedUserIds->isEmpty()) {
            return response()->json([
                'message' => 'No previous assessment attempts found to reassign.',
                'affected_user_count' => 0,
                'reset_attempt_count' => 0,
                'reset_exam_attempt_count' => 0,
                'reopened_assignment_count' => 0,
            ]);
        }

        $assessmentExamIds = (clone $attemptQuery)->pluck('quiz_data')
            ->map(function ($quizData) {
                return optional(json_decode($quizData))->id;
            })
            ->filter()
            ->unique()
            ->values();

        $affectedAssignments = AsignedUser::where('course_id', $assessment->course_id)
            ->whereIn('user_id', $attemptedUserIds)
            ->get();
        $affectedAssignmentIds = $affectedAssignments->pluck('id');

        $resetExamAttemptQuery = ExamAttempt::where('course_id', $assessment->id)
            ->whereIn('user_id', $attemptedUserIds)
            ->whereIn('assigned_id', $affectedAssignmentIds);

        if ($assessmentExamIds->isNotEmpty()) {
            $resetExamAttemptQuery->whereIn('exam_id', $assessmentExamIds);
        }

        $resetExamAttemptCount = $resetExamAttemptQuery->delete();
        $resetAttemptCount = $attemptQuery->delete();

        // Update the assignment status only for the users who attempted it
        $reopenedAssignmentCount = AsignedUser::whereIn('id', $affectedAssignmentIds)
            ->update([
                'status' => 1,
                'completed_on' => null,
            ]);

        return response()->json([
            'message' => 'Assessment reassigned to applicable users successfully.',
            'affected_user_count' => $attemptedUserIds->count(),
            'reset_attempt_count' => $resetAttemptCount,
            'reset_exam_attempt_count' => $resetExamAttemptCount,
            'reopened_assignment_count' => $reopenedAssignmentCount,
        ]);
    });
}

public function delete_admin_courses(Request $request) {
    $course = Courses::findOrFail($request->id);
    $course->is_delete = 1;
    $course->save(); 
    return redirect('coursecatalog?tab=2')->with('success', 'Course deleted successfully.');
}

public function fetch_course_details(Request $request) {

    $course = Courses::findOrFail($request->course_id);

    $course_category_id = $course->category_id;

    $category_department = Category::where('id', $course_category_id)
        ->pluck('department_id')->first();

    // dd($category_department);

    $users_lists = User::with(['departmentdetails', 'designationdetails', 'assigned_users' => function($q) use ($course) {
            $q->where('course_id', $course->id)
            ->with('assigned_exam_datas.exam_details'); 
        }])
        ->where('active', 1)
        ->where(function($query) use ($category_department) {
            if ($category_department > 0) {
                $query->whereHas('departmentdetails', function($q) use ($category_department) {
                    $q->where('department', $category_department);
                });
            }
        })
    ->get();

    //  dd($users_lists);

    $roles = Roles::get();
    foreach ($users_lists as $user) {
        $userTypes = json_decode($user->user_type, true);
        $user->role_names = $roles->whereIn('id', is_array($userTypes) ? $userTypes : [])->pluck('role')->all();
    }

    //dd($users_lists);


    $assignedUser = Asigneduser::with([
        'users_data.departmentdetails',
        'users_data.designationdetails',
        'course_details.assessments',
        'category_details',
    ])->where('course_id', $course->id)->get();
    $attend = $assignedUser->where('status', 1);
    $notattend = $assignedUser->where('status', 2);
    $notresponce = $assignedUser->where('status', 0);
    $departments = Department::get();
    $designations = Designation::get();
    $completed_course = $assignedUser->where('status', 3)->filter(function ($assignment) {
        return $assignment->course_details && $assignment->category_details;
    });
    $assessmentIds = $completed_course->flatMap(function ($assignment) {
        return $assignment->course_details->assessments->pluck('id');
    })->unique();
    $reportAssessmentResults = Assessment_results::select('id', 'course_document_id', 'user_id', 'code', 'result_data')
        ->whereIn('course_document_id', $assessmentIds)
        ->whereIn('user_id', $completed_course->pluck('user_id')->unique())
        ->get()
        ->groupBy(function ($result) {
            return $result->course_document_id . ':' . $result->user_id;
        });
            
            $groups_lists = Group::with(['assignedUsers' => function ($q) use ($request) {
        $q->where('course_id', $request->course_id);
        }])->get();

            //dd($groups_lists);

    //dd($course);
    $html = view('admin.coursecatalog.course_ajax',compact('course','users_lists','assignedUser','notattend','notresponce','attend','departments','designations','request','completed_course','groups_lists','category_department','roles','reportAssessmentResults'))->render();
    return $html;
}
public function add_course_type_details(Request $request)
{

    //dd($request->all());
    $course = Courses::findOrFail($request->course_id);
    $html='';
    $course->course_type=$request->course_type;
    if($request->course_type==2 && !empty($request->trainer_id)){
        $course->trainer_name=$request->trainer_id;
        $course->training_date=$request->training_date;
        $course->training_time_from=$request->training_time_from;
        $course->training_time_to=$request->training_time_to;
        $course->training_duration=$request->training_duration;
        $course->training_location=$request->training_location;
        $train = Course_Training_data::create($request->except(['_token']));
        $html='<tr><td>'.$train->userdetails->first_name.'</td>
                                        <td>'.$train->training_date.'</td>
                                        <td>'.$train->training_time_from.'</td>
                                        <td>'.$train->training_time_to.'</td>
                                        <td>'.$train->training_duration.'</td>
                                        <td>'.$train->training_location.'</td>
                                        <td>
                                            <a href="javascript:;" data-id="'.$train->id.'" class="btn btn-danger btn-sm delete_trainer">Delete</a>
                                        </td>
                                        
                                    </tr>';
    }
    $course->save();
    return $html;
}
public function delete_trainer_details(Request $request)
{
    $list = Course_Training_data::where('id',$request->id)->first();
    Course_Training_data::where('id',$request->id)->delete();
    $data = Course_Training_data::where('course_id',$list->course_id)->get()->toArray();
    if(!empty($data)){
        return json_encode(['status'=>1]);
    }else{
        $course = Courses::findOrFail($list->course_id);
        $course->trainer_name='';
        $course->training_date='';
        $course->training_time_from='';
        $course->training_time_to='';
        $course->training_duration='';
        $course->training_location='';
        $course->save();
        return json_encode(['status'=>0]);
    }
}
public function upload_feedback_document(Request $request)
{
    if ($request->hasFile('document')) {
            try{

            $videoFile = $request->file('document');
            $videoFileName = uniqid() . '_' . str_replace(" ", "", $videoFile->getClientOriginalName());
            $videoFilePath = $videoFile->storeAs('documets', $videoFileName, 'public');
            $data = Offline_Documents::create(['course_id'=>$request->course_id, 'type'=>2, 'document_name'=>$videoFileName, 'document_path'=>$videoFilePath, 'assined_id'=>$request->assined_id]);

            } catch (\Exception $e) {

                return response()->json(['message' => $e->getMessage(),'status'=>0], 400);
            }
           return response()->json(['message' => '<span style="color:green;">File successfully uploaded.</span>','files'=>$data,'status'=>1]);
        }      
}
public function add_assessment_path_to_user(Request $request)
{
    $assignedUser = Asigneduser::where('id',$request->id)->update(['assessment_path'=>$request->path]);
    return true;
}
// public function get_user_based_on_filters(Request $request)
// {

//    //dd($request->all());
//     $query = User::query();

// $query->with('assigned_user')
//       ->where(function($q) use ($request) {
//           if (!empty($request->designation)) {
//               $q->whereIn('designation', $request->designation);
//           }
//           if (!empty($request->department)) {
//               $q->whereIn('department', $request->department);
//           }
//           //  if (!empty($request->user_type_value)) {
//           //     $q->whereIn('user_type', $request->user_type_value);
//           // }
//              if (!empty($request->user_type)) {
//               // If the user_type is a JSON or array-like column, use whereJsonContains
//               $q->where(function($query) use ($request) {
//                   foreach ($request->user_type as $userType) {
//                       $query->orWhereJsonContains('user_type', $userType);
//                   }
//               });
//           }
//       });

// if ($request->assigned_status == 0 && $request->assigned_status != "") {
//     $query->whereDoesntHave('assigned_user', function($q) use ($request) {
//         $q->where('course_id', $request->course_id);
//     });
// } elseif ($request->assigned_status == 1) {
//     $query->whereHas('assigned_user', function($q) use ($request) {
//         $q->where('course_id', $request->course_id);
//     });
// }

// if (!empty($request->search_query)) {
//     $query->where(function ($q) use ($request) {
//         $q->where('first_name', 'like', '%' . $request->search_query . '%')
//           ->orWhere('last_name', 'like', '%' . $request->search_query . '%')
//           ->orWhere('username', 'like', '%' . $request->search_query . '%')
//           ->orWhereHas('designationdetails', function ($query) use ($request) {
//               $query->where('designation_name', 'like', '%' . $request->search_query . '%');
//           })
//           ->orWhereHas('departmentdetails', function ($query) use ($request) {
//               $query->where('department_name', 'like', '%' . $request->search_query . '%');
//           })
//           ->orWhereHas('roles', function ($query) use ($request) {
//               $query->where('role', 'like', '%' . $request->search_query . '%');
//           });
//     });
// }


// $list = $query->get();
// // /dd($list);


//      foreach ($list as $user) {
//         $userTypes = json_decode($user->user_type, true);
//         $roles = Roles::whereIn('id', $userTypes)->pluck('role')->toArray();
//         $user->role_names = $roles; // Store the roles in a new attribute
//     }


//     $html='';
//     foreach ($list as $key => $user) {
//         $assigned_id='';
//         $checked='';$user_image=url("public/images/face12.jpg");
      
//         $assign = Asigneduser::where(['course_id'=>$request->course_id,'user_id'=>$user->id])->first();

//         if(!empty($assign->assigned_exam_data)){

//             $assigned_id=$assign->id;
//         }


//          $assign_id = $assign->id??0;
         
//              if (!empty($assign_id)) {
//         $checked = 'Checked';
//         $assign_created_at = $assign->created_at ? \Carbon\Carbon::parse($assign->created_at)->format("M d, Y") : "";
//     } else {
//         $assign_created_at = "";
//     }
     

//         if(!empty($user->profile_image)){ 
//             $user_image=url("storage/app/public/" . $user->profile_image);
//         }
//         $last_login = $user->last_login ? \Carbon\Carbon::parse($user->last_login)->format("d-m-Y"):"";
//         $department_name=$user->departmentdetails->department_name??"";
//         $designation_name=$user->designationdetails->designation_name??"";
//         $emp_id=$user->emp_id??"";
//           $role_names = implode(', ', $user->role_names);
       

//         $html.='<tr>

//                             <td>
//                                  <div class="d-flex align-items-center">
//                                     <div class="profile-image-div-sm">
//                                         <img src="'. $user_image .'" class="img-fluid" alt="">
//                                     </div>
//                                     <div class="ms-2">
//                                         <div class="py-1 profilee-namee">'.$user->first_name.' '.$user->last_name.'</div>
//                                         <div class="sub-text">'.$user->email.'</div>
//                                     </div>
//                                 </div>
//                             </td>
                            
//                             <td>'.$department_name.'</td>
//                             <td>'.$designation_name.'</td>
//                             <td>'.$role_names.'</td>
//                             <td>
//                               <div class="custom-control custom-switch">
//                                         <input type="checkbox" class="user_single_check_ajax mr-3 custom-control-input toggle-class" data-onstyle="1"  data-offstyle="0"  id="axtoggle-'.$user->id.'" data-user_id="'.$user->id.'"
//                                         data-category_id="'.$user->id.'" data-course_id="'.$request->course_id.'" '.$checked.' >

//                                          <label class="custom-control-label" for="axtoggle-'.$user->id.'"></label>

//                                     </div>
//                                     <div>
//                                     '.$assign_created_at.'
//                                     <div>

//                             </td>
//                            <td>' . ($assigned_id && $assigned_id !== 0 
//                                 ? '<a href="' . url('view_attempted_exam') . '?assigned_id=' . $assign_id . '&course_id=' . $request->course_id . '" class="btn btn-primary">View Attempted Exam</a>' 
//                                 : '') . '</td>
                    
//                         </tr>';
//         }
//     return $html;
// }

 
    public function get_user_based_on_filters(Request $request)
    {
        $query = User::query();

        $query->with('assigned_user')
            ->where(function($q) use ($request) {
                if (!empty($request->designation)) {
                    $q->whereIn('designation', $request->designation);
                }
                if (!empty($request->department)) {
                    $q->whereIn('department', $request->department);
                }
                if (!empty($request->user_type)) {
                    $q->where(function($query) use ($request) {
                        foreach ($request->user_type as $userType) {
                            $query->orWhereJsonContains('user_type', $userType);
                        }
                    });
                }
            });

        if ($request->assigned_status == 0 && $request->assigned_status != "") {
            $query->whereDoesntHave('assigned_user', function($q) use ($request) {
                $q->where('course_id', $request->course_id);
            });
        } elseif ($request->assigned_status == 1) {
            $query->whereHas('assigned_user', function($q) use ($request) {
                $q->where('course_id', $request->course_id);
            });
        }

        if (!empty($request->search_query)) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->search_query . '%')
                ->orWhere('last_name', 'like', '%' . $request->search_query . '%')
                ->orWhere('username', 'like', '%' . $request->search_query . '%')
                ->orWhereHas('designationdetails', function ($query) use ($request) {
                    $query->where('designation_name', 'like', '%' . $request->search_query . '%');
                })
                ->orWhereHas('departmentdetails', function ($query) use ($request) {
                    $query->where('department_name', 'like', '%' . $request->search_query . '%');
                })
                ->orWhereHas('roles', function ($query) use ($request) {
                    $query->where('role', 'like', '%' . $request->search_query . '%');
                });
            });
        }

        $list = $query->get();

        foreach ($list as $user) {
            $userTypes = json_decode($user->user_type, true);
            $roles = Roles::whereIn('id', $userTypes)->pluck('role')->toArray();
            $user->role_names = $roles;
        }

        // course_id used to namespace modal ids so they never collide with
        // modal ids rendered on other tabs / previous AJAX loads
        $courseId = $request->course_id;

        $html = '';

        foreach ($list as $key => $user) {
            $checked = '';
            $user_image = url("public/images/face12.jpg");

            $assign = Asigneduser::with('assigned_exam_datas.exam_details')
                ->where(['course_id' => $courseId, 'user_id' => $user->id])
                ->first();

            $assign_id = $assign->id ?? 0;

            if (!empty($assign_id)) {
                $checked = 'Checked';
                $assign_created_at = $assign->created_at ? \Carbon\Carbon::parse($assign->created_at)->format("M d, Y") : "";
            } else {
                $assign_created_at = "";
            }

            if (!empty($user->profile_image)) {
                $user_image = url("storage/app/public/" . $user->profile_image);
            }

            $department_name = $user->departmentdetails->department_name ?? "";
            $designation_name = $user->designationdetails->designation_name ?? "";
            $role_names = implode(', ', $user->role_names);

            // Unique per course+user so the same modal id can never appear
            // twice in the DOM even if a previous AJAX render wasn't cleaned up
            $modalId = 'examModal' . $courseId . '_' . $user->id;

            $examHtml = '';
            if (!empty($assign) && !empty($assign->assigned_exam_datas) && count($assign->assigned_exam_datas) > 0) {

                // FIX: use Bootstrap 5 data-bs-* attributes (the app is BS5,
                // the old data-toggle/data-target/data-dismiss are BS4 and are
                // silently ignored by BS5's JS, so the button did nothing)
                $examHtml .= '<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#' . $modalId . '">View Exam</button>';

                $examHtml .= '<div class="modal fade" id="' . $modalId . '" tabindex="-1" aria-labelledby="' . $modalId . 'Label" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="' . $modalId . 'Label">Assigned Exams</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr><th>Exam Name</th><th>Exam Result</th><th>Action</th></tr>
                                    </thead>
                                    <tbody>';

                foreach ($assign->assigned_exam_datas as $assignment) {
                    $examName = $assignment->exam_details->name ?? 'N/A';
                    $examResult = $assignment->exam_result ?? 'N/A';

                    if ($examResult != 'Pending') {
                        $examCode = $assignment->exam_details->exam_code ?? '';
                        $action = '<a href="' . route('admin.exams.Resultview') . '?course_id=' . $courseId
                            . '&exam_name=' . urlencode($examCode)
                            . '&ex_c=' . ($assignment->exam_details->id ?? '')
                            . '&user_id=' . $user->id
                            . '&attempt_id=' . ($assignment->id ?? '')
                            . '" target="_blank" class="btn btn-primary">View Result</a>';
                    } else {
                        $action = 'WaitIng for evaluation';
                    }

                    $examHtml .= '<tr><td>' . $examName . '</td><td>' . $examResult . '</td><td>' . $action . '</td></tr>';
                }

                $examHtml .= '</tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>';
            }else{
                $examHtml .= '<span class="btn btn-sm btn-outline-secondary disabled">Not Attempted</span>';
            }

            $html .= '<tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="profile-image-div-sm">
                                    <img src="' . $user_image . '" class="img-fluid" alt="">
                                </div>
                                <div class="ms-2">
                                    <div class="py-1 profilee-namee">' . $user->first_name . ' ' . $user->last_name . '</div>
                                    <div class="sub-text">' . $user->email . '</div>
                                </div>
                            </div>
                        </td>
                        <td>' . $department_name . '</td>
                        <td>' . $designation_name . '</td>
                        <td>' . $role_names . '</td>
                        <td>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="user_single_check_ajax mr-3 custom-control-input toggle-class"
                                    data-onstyle="1" data-offstyle="0" id="axtoggle-' . $user->id . '"
                                    data-user_id="' . $user->id . '" data-category_id="' . $user->id . '"
                                    data-course_id="' . $courseId . '" ' . $checked . '>
                                <label class="custom-control-label" for="axtoggle-' . $user->id . '"></label>
                            </div>
                            <div>' . $assign_created_at . '</div>
                        </td>
                        <td>' . $examHtml . '</td>
                    </tr>';
        }

        return $html;
    }

public function get_category_courses_based_on_filters(Request $request)
{
    $list = Courses::where(function($q)use($request){
            // if(!empty($request->category_filter_in_view)){
            //     $q->where('category_id',$request->category_filter_in_view);
            // }
            if(!empty($request->status_category)){
                $q->where('active',$request->status_category);
            }
            if(!empty($request->search_name_course)){
                 $q->where('course_name', 'like', '%' . $request->search_name_course . '%');
            }
        })->where('category_id',$request->hiddencategory_id)->get();
    $html='';
    foreach ($list as $key => $course) {

        $checked='';$course_image = null;
         
        if (!empty($course->course_image)) {
            $course_image = url("storage/app/public/" . $course->course_image);
        } else {
            $course_image = url("public/images/face12.jpg"); // Default image URL
        }
        $category_name=$course->category_details->category_name??"";
         $last_updated = $course->updated_at ? \Carbon\Carbon::parse($course->updated_at)->format("d-m-Y"):"";
        $html.='<tr>
                            
                            <td scope="row ">
                                <div class="d-flex align-items-center">
                                    <div class="course-image-sm">
                                        <img src="'. $course_image .'" class="img-fluid" alt="">
                                    </div>
                                    <div class="ps-3">
                                        <div class="py-1 course-name font-weight-bold">'.$course->course_name.'</div>
                                    </div>
                                </div>
                            </td>
                            <td>'.$category_name.'</td>
                            <td>'.$last_updated.'</td>
                        </tr>';
        }
    return $html;
}


public function assign_course_to_all_users(Request $request)
    {

        //dd($request->all());
        
        $request->validate([
            'courseid' => 'required|exists:tbl_courses,id',
        ]);

        $course = Courses::find($request->courseid);

        if (!$course) {
            return response()->json(['error' => 'Course not found'], 404);
        }

        $users = User::whereJsonDoesntContain('user_type',"!=",1)->get();

        if ($users->isEmpty()) {
            return response()->json(['error' => 'No users found'], 404);
        }

        $responseData = [];

        foreach ($users as $user) {
            //dd('hi');
            $existingAssignment = AssignedUser::where('user_id', $user->id)
                                              ->where('course_id', $course->id)
                                              ->exists();

            if (!$existingAssignment) {
                // Create the assignment
                AssignedUser::create([
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                    'category_id' => $course->category_id,
                    'subcategory_id' => $course->subcategory_id ?? 0,
                ]);
            }
        }

        // Prepare the success message
        $responseData['status'] = 1;
        $responseData['message'] = 'Course Added Successfully.';
        foreach ($users as $user) {
            $emailTemplate = Mail_templates::where('title', 'Assign User')->first();

            if ($emailTemplate) {
                $content = str_replace('[Course_name]', $course->course_name, $emailTemplate->template);

                Mail::send([], [], function ($message) use ($user, $emailTemplate, $content) {
                    $message->to($user->email)
                            ->subject($emailTemplate->subject)
                            ->setBody($content, 'text/html');
                });
            }

            Notifications::create([
                'user_id' => $user->id,
                'href_url' => url('user_courses'),
                'message' => 'You have just been assigned a new course',
            ]);
        }

        return response()->json($responseData);
    }

  

 public function fetch_Course_groupData(Request $request)
{
    $course = Courses::find($request->courseid);
    $group = Group::find($request->groupid);

    if (!$course || !$group) {
        return response()->json(['error' => 'Course or Group not found'], 404);
    }

    $users_in_group = $group->users()->pluck('users.id')->toArray();

    if ($request->status == 0) {
        
        Asigneduser::whereIn('user_id', $users_in_group)
                   ->where('course_id', $course->id)
                   ->where('group_id', $group->id)
                   ->delete();

        $responseData = [
            'status' => 0,
            'message' => 'Course Removed Successfully for all users.',
        ];
    } else {
        foreach ($users_in_group as $user_id) {

            $existingAssignment = Asigneduser::where([
                'user_id' => $user_id,
                'course_id' => $course->id,
            ])->first();

            if ($existingAssignment) {
               
                $existingAssignment->update([
                    'group_id' => $group->id,
                    'subcategory_id' => $course->subcategory_id ?? 0,

                ]);
            } else {
                
                Asigneduser::create([
                    'user_id' => $user_id,
                    'course_id' => $course->id,
                    'category_id' => $course->category_id,
                    'subcategory_id' => $course->subcategory_id ?? 0,
                    'group_id' => $group->id,
                    'status' => 0,
                ]);
            }
        }

        $email_template = Mail_templates::where('title', 'Assigning Courses')->first();

        if ($email_template) {
            $content = str_replace('[Course_name]', $course->course_name, $email_template->template);

            foreach ($users_in_group as $user_id) {
                $user = User::find($user_id);

                if ($user) {
                    Mail::send([], [], function ($message) use ($user, $email_template, $content) {
                        $message->to($user->email)
                                ->subject($email_template->subject)
                                ->setBody($content, 'text/html');
                    });

                    Notifications::create([
                        'user_id' => $user_id,
                        'href_url' => url('user_courses'),
                        'message' => 'You have just been assigned a new course',
                    ]);
                }
            }
        }

        $responseData = [
            'status' => 1,
            'message' => 'Course Added Successfully for all users.',
        ];
    }

    return response()->json($responseData);
}

public function toggleDocumentStatus(Request $request)
{
    $request->validate([
        'id' => 'required|integer|exists:tbl_course_documents_list,id',
        'action' => 'required|string|in:Active,Inactive',
    ]);

    $document = Course_documents::find($request->id);

    // Update is_active status based on action
    $document->is_active = $request->action === 'Active' ? 1 : 0;
    $document->save();

    return response()->json(['success' => true]);
}



    public function delete_course(Request $request) {

        // dd($request->all());

        $request->validate([
            'id' => 'required|integer'
        ]);

        $course_id = Courses::where('id', $request->id)->first();
        
        if(!$course_id) {
            return back()->with('error', 'No course exist');
        }

        $course_id->delete();

        return back()->with('success', 'Course deleted successfully');

    }


}
