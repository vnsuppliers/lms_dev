<?php

 
 use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminRegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserprofileController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AdminCoursesController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UsertabsController;
use App\Http\Controllers\TrainerviewController;
use App\Http\Controllers\TrainerManagerController;
use App\Http\Controllers\SeniorTrainerController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\UserExamController;
use App\Http\Controllers\CourseSettingsController;
use App\Http\Controllers\AuthorizedSignatureController;
use App\Http\Controllers\UserActivityLogController;
use App\Http\Controllers\FeedBackRatingsSettingsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ReportBuilderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
  Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
  Route::post('login', [LoginController::class, 'authenticate']);
  Route::get('loginAs/{role}', [LoginController::class, 'loginAs'])->name('login.as');
  Route::get('forget-password', [LoginController::class, 'forgetPassword']);
  Route::post('update_assessment_result', [UserprofileController::class, 'update_assessment_result']);

// Route::get('/', [AdminRegistrationController::class, 'index'])->name('login');
// Route::get('login', [AdminRegistrationController::class, 'index'])->name('login');
// Route::post('login', [AdminRegistrationController::class, 'authenticate']);


// Route::get('/organization_dashboard', [UsertabsController::class, 'index']);

  // Route::get('organization_dashboard', function () {
  //    return view('user.organization_dashboard');
  //  });
  
  //  Route::get('/mycourse_catalog', function () {
  //   return view('user.mycourse_catalog');
  // });
   
 
 
 
  Route::get('/mygroups', function () {
    return view('user.mygroups');
  });
  Route::get('/mybranches', function () {
    return view('user.mybranches');
  });
  Route::get('/myfiles', function () {
    return view('user.myfiles');
  });
  Route::get('/userdiscussions', function () {
    return view('user.discussions');
  });

  

//  Admin

Route::get('/admin', function () {
  return view('layouts.admin.header');
});
Route::get('/messages', function () {
  return view('admin.messages.messages');
});
Route::get('/admindiscussions', function () {
  return view('admin.admindiscussions');
});
Route::get('/myprofile', function () {
  return view('admin.myprofile.myprofile');
});
// Route::get('/settings', function () {
//   return view('admin.settings.settings');
// });
Route::get('/automation', function () {
  return view('admin.Automation.automation');
});
Route::get('/importexport', function () {
  return view('admin.import_export.importexport');
});
Route::get('/usertypes', function () {
  return view('admin.usertypes.usertypes');
});
Route::get('/reports', function () {
  return redirect()->route('admin.reports.index');
});


Route::get('/user/dashboard', function () {
    return view('layouts.user.header');
})->name('user.dashboard');

Route::get('/admin/dashboard', function () {
    return view('layouts.admin.header');
})->name('admin.dashboard');

Route::get('/certificate', function () {
  return view('admin.certificate');
});









//ADMIN::routes();
Route::get('logout', [LoginController::class, 'logout']);

 Route::group(['middleware' => ['auth', 'Admin']], function () {

//  Users  
  
    Route::get('organizationdashboard', [AdminRegistrationController::class, 'dashboard']);
    Route::get('users', [AdminRegistrationController::class, 'admin_users']);
    Route::post('user_registrations_store', [AdminRegistrationController::class, 'user_registrations_store']);
    Route::get('delete_admin_users', [AdminRegistrationController::class, 'delete_admin_users']);
    Route::get('/fetchUserData', [AdminRegistrationController::class, 'fetchUserData']);
    Route::get('/assign-course-to-user',  [AdminRegistrationController::class,'assignCourseToUser'])->name('assign-course-to-user');
    Route::get('/revoke-course',  [AdminRegistrationController::class,'revokeCourse'])->name('revoke-course');


     Route::post('assignCourseToUsernew',  [AdminRegistrationController::class,'assignCourseToUsernew'])->name('assignCourseToUsernew');
     Route::post('upload_feedback_document',  [AdminCoursesController::class,'upload_feedback_document'])->name('upload_feedback_document');
     Route::get('get_courses_based_on_filters', [AdminRegistrationController::class, 'get_courses_based_on_filters']);



//  Course Catalog    
    Route::post('add_course_type_details', [AdminCoursesController::class, 'add_course_type_details']);
    Route::get('coursecatalog', [IndexController::class, 'category_create']);
    Route::post('add_coursecatalog', [AdminCoursesController::class, 'add_coursecatalog']);  
    Route::get('/fetch_assignedCourses_userData', [AdminCoursesController::class, 'fetch_assignedCourses_userData']);
    Route::post('add_content_type', [AdminCoursesController::class, 'add_content_type']);
    Route::get('/course_add_to_users', [AdminCoursesController::class, 'course_add_to_users']);
    Route::get('/fetch_signleCourse_userData', [AdminCoursesController::class, 'fetch_signleCourse_userData']);
    Route::post('/reassign-course-to-user', [AdminCoursesController::class, 'reassignCourseToUser']);
    Route::post('/reassign-assessment-to-all', [AdminCoursesController::class, 'reassignAssessmentToAll']);
    Route::get('delete_admin_courses', [AdminCoursesController::class, 'delete_admin_courses']);
    Route::get('fetch_course_details', [AdminCoursesController::class, 'fetch_course_details']);
    Route::get('delete_document', [AdminCoursesController::class, 'delete_document']);
    Route::get('delete_trainer_details', [AdminCoursesController::class, 'delete_trainer_details']);
    Route::get('add_assessment_path_to_user', [AdminCoursesController::class, 'add_assessment_path_to_user']);
    Route::get('get_user_based_on_filters', [AdminCoursesController::class, 'get_user_based_on_filters']);
    Route::get('/fetchCategoryData', [AdminRegistrationController::class, 'fetchCategoryData']);
    Route::get('/fetchUserDataApi', [AdminRegistrationController::class, 'fetchUserDataApi']);


    Route::get('change_password', [AdminRegistrationController::class, 'showChangePasswordForm'])->name('admin.password.change');
    Route::post('change_password', [AdminRegistrationController::class, 'changePassword'])->name('admin.password.update');
    Route::get('admin-profile', [AdminRegistrationController::class, 'admin_profile'])->name('admin-profile.view');
    Route::post('admin-profile', [AdminRegistrationController::class, 'admin_update_profile_image'])->name('admin-profile.update');
    Route::get('get_category_courses_based_on_filters', [AdminCoursesController::class, 'get_category_courses_based_on_filters']);
    Route::get('upload_all_users_from_skilmatrix', [AdminRegistrationController::class, 'upload_all_users_from_skilmatrix']);

     Route::get('assign_course_to_all_users', [AdminCoursesController::class, 'assign_course_to_all_users']);
        Route::get('/fetch_Course_groupData', [AdminCoursesController::class, 'fetch_Course_groupData']);
    

    Route::get('/courses', function () {
      return view('admin.courses.courses');
    });


//category
    Route::post('storecategory',[IndexController::class, 'category_store']);
    Route::get('category_destroy', [IndexController::class, 'category_destroy']);
    Route::get('getSubcategories', [IndexController::class, 'getSubcategories']);
//Roles
    Route::post('storerole',[IndexController::class, 'role_store']);
    Route::get('roles', [IndexController::class, 'role_create']);
    Route::get('role_destroy', [IndexController::class, 'role_destroy']);
//Permission
    Route::post('permission_store',[IndexController::class, 'permission_store']);
    Route::get('permission_destroy', [IndexController::class, 'permission_destroy']);
//subcategory
    Route::post('subcategory_store', [IndexController::class, 'subcategory_store']);
    Route::get('subcategory_destroy', [IndexController::class, 'subcategory_destroy']);


    Route::get('mail_templates', [IndexController::class, 'mail_templates']);
    Route::post('add_mail_template', [IndexController::class, 'add_mail_template']);
    Route::get('delete_mail_template', [IndexController::class, 'delete_mail_template']);




//groups
    Route::post('storegroup',[IndexController::class, 'group_store']);
    Route::get('group_destroy', [IndexController::class, 'group_destroy']);
    Route::get('fetch_assigned_groups', [AdminRegistrationController::class, 'fetch_assigned_groups']);
    Route::get('add_group_to_user', [AdminRegistrationController::class, 'add_group_to_user']);

    //Goals
    Route::post('storegoal',[IndexController::class, 'goal_store']);
    Route::post('store_certificates',[IndexController::class, 'store_certificates']);
    Route::get('masters', [IndexController::class, 'masters']);
    Route::get('goal_destroy', [IndexController::class, 'goal_destroy']);

//Levels
    Route::post('level_store',[IndexController::class, 'level_store']);
    Route::get('level_destroy', [IndexController::class, 'level_destroy']);

 //exam and question
    Route::get('admin/exams/create', [ExamController::class, 'create'])->name('admin.exams.create');
    Route::post('admin/exams', [ExamController::class, 'store'])->name('admin.exams.store');
     Route::post('admin/edit_store', [ExamController::class, 'edit_store'])->name('admin.exams.edit_store');
    Route::get('admin/exams/view', [ExamController::class, 'view'])->name('admin.exams.view');
     Route::get('fetch_exam_details', [ExamController::class, 'fetch_exam_details']);

     Route::post('/admin/exams/delete_question', [ExamController::class, 'deleteQuestion'])->name('admin.exams.delete_question');
    

    //view_attempted_exam

    
    
     Route::post('toggle_document_status', [AdminCoursesController::class, 'toggleDocumentStatus']);

Route::get('admin/exams/viewResult', [ExamController::class, 'admin_view_result_exam'])->name('admin.exams.Resultview');



//reports in admin
Route::get('fetch_reportcourses_details', [ReportsController::class, 'fetch_reportcourses_details']);
Route::get('get_reportcourses_based_on_filters', [ReportsController::class, 'get_reportcourses_based_on_filters']);

// Dynamic LMS Report Builder Routes
Route::get('admin/reports', [ReportBuilderController::class, 'index'])->name('admin.reports.index');
Route::get('admin/reports/create', [ReportBuilderController::class, 'create'])->name('admin.reports.create');
Route::get('admin/reports/schema', [ReportBuilderController::class, 'getSchema'])->name('admin.reports.schema');
Route::match(['GET', 'POST', 'PUT'], 'admin/reports/preview', [ReportBuilderController::class, 'preview'])->name('admin.reports.preview');
Route::post('admin/reports', [ReportBuilderController::class, 'store'])->name('admin.reports.store');
Route::get('admin/reports/{report}/edit', [ReportBuilderController::class, 'edit'])->name('admin.reports.edit');
Route::put('admin/reports/{report}', [ReportBuilderController::class, 'update'])->name('admin.reports.update');
Route::delete('admin/reports/{report}', [ReportBuilderController::class, 'destroy'])->name('admin.reports.destroy');
Route::get('admin/reports/{report}/run', [ReportBuilderController::class, 'run'])->name('admin.reports.run');
Route::get('admin/reports/{report}/export/{format}', [ReportBuilderController::class, 'export'])->name('admin.reports.export');
Route::match(['GET', 'POST', 'PUT'], 'admin/reports/export-direct/{format}', [ReportBuilderController::class, 'exportDirect'])->name('admin.reports.export_direct');

});


 Route::get('view_attempted_exam', [ExamController::class, 'viewAttemptedExam'])->middleware('auth')->name('view_attempted_exam');
 Route::post('save_results', [ExamController::class, 'saveResults'])->middleware('auth')->name('exam_attempt.save_results');


     Route::group(['middleware' => ['auth']], function () {
     Route::get('/user', function () {
         return view('layouts.user.header');
      });
    

Route::get('organization_dashboard', [UserprofileController::class, 'dashboard'])->name('user.organization_dashboard');
Route::get('mycourse_catalog', [UserprofileController::class, 'mycourse_catalog']);
Route::get('mycourse_videos', [UserprofileController::class, 'mycourse_videos']);
Route::get('saveVideoTime', [UserprofileController::class, 'saveVideoTime']);
Route::get('getVideoPlaybackTime', [UserprofileController::class, 'getVideoPlaybackTime']);
Route::get('user_header', [UserprofileController::class, 'user_header']);
Route::post('markAllNotificationsAsRead', [UserprofileController::class, 'markAllNotificationsAsRead']);
Route::post('update_scorm_progress', [UserprofileController::class, 'update_scorm_progress']);
Route::post('complete_assessment_video', [UserprofileController::class, 'completeAssessmentVideo']);
Route::post('launch_course_assessment', [UserprofileController::class, 'launchCourseAssessment']);
Route::get('user_courses', [UserprofileController::class, 'user_courses']);
Route::get('get_assign_course_data', [UserprofileController::class, 'get_assign_course_data']);
Route::get('category_courses', [UserprofileController::class, 'category_courses']);
Route::get('start_course', [UserprofileController::class, 'start_course'])->name('user.start_course');
Route::get('activity', [UserprofileController::class, 'activity'])->name('user.activity');
Route::get('accept_course', [UserprofileController::class, 'accept_course']);
Route::post('user_upload_feedback_document', [UserprofileController::class, 'user_upload_feedback_document']);
Route::get('myinstructorled_courses', [UserprofileController::class, 'myinstructorled_courses']);
Route::get('/search-categories', [UserprofileController::class, 'searchCategories']);


Route::get('userslist', [UserprofileController::class, 'userslist']);
Route::get('fetch_myteam_userdetails', [UserprofileController::class, 'fetch_myteam_userdetails']);

// Trainer view 
Route::get('trainercourseslist', [TrainerviewController::class, 'trainercourseslist']);
Route::get('fetch_trainer_course_details', [TrainerviewController::class, 'fetch_trainer_course_details']);
 Route::get('trainer_get_user_based_on_filters', [TrainerviewController::class, 'trainer_get_user_based_on_filters']);
 Route::get('fetch_trainer_user_assessments', [TrainerviewController::class, 'fetch_trainer_user_assessments']);
 

 // Trainer Manager
Route::get('trainersalllist', [TrainerManagerController::class, 'trainersalllist']);
Route::get('manager_fetch_trainer_details', [TrainerManagerController::class, 'manager_fetch_trainer_details']);
 Route::get('trainer_manager_get_user_based_on_filters', [TrainerManagerController::class, 'trainer_manager_get_user_based_on_filters']);
  Route::get('fetch_trainer_user_deta', [TrainerManagerController::class, 'fetch_trainer_user_deta']);


  //Senior Trainer view 
Route::get('seniortrainer_trainerslist', [SeniorTrainerController::class, 'seniortrainer_trainerslist']);
Route::get('fetch_trainer_details', [SeniorTrainerController::class, 'fetch_trainer_details']);
 Route::get('senior_trainer_get_user_based_on_filters', [SeniorTrainerController::class, 'senior_trainer_get_user_based_on_filters']);
 Route::get('fetch_trainer_user_de', [SeniorTrainerController::class, 'fetch_trainer_user_de']);
 

Route::get('change-password', [UserprofileController::class, 'showChangePasswordForm'])->name('password.change');
Route::post('change-password', [UserprofileController::class, 'changePassword'])->name('password.newupdate');
Route::get('add_remove_bookmark', [UserprofileController::class, 'add_remove_bookmark']);

Route::get('my_profile', [UserprofileController::class, 'my_profile'])->name('my_profile.view');
Route::post('my_profile', [UserprofileController::class, 'update_profile_image'])->name('my_profile.update');



Route::get('mycompleted_courses', [UserprofileController::class, 'mycompleted_courses']);
Route::get('course_view', [UserprofileController::class, 'course_view']);
Route::get('myfiles', [UserprofileController::class, 'myfiles']);
Route::get('user_course_status_update', [UserprofileController::class, 'user_course_status_update']);
Route::get('get_certificate', [UserprofileController::class, 'get_certificate']);
Route::get('mycertificates', [UserprofileController::class, 'mycertificates']);
Route::get('download_certificates', [UserprofileController::class, 'download_certificates']);
Route::get('update_notification_count', [UserprofileController::class, 'update_notification_count']);
Route::get('get_results', [UserprofileController::class, 'get_results']);

// Assign exam submit answers
Route::get('exams/take', [UserExamController::class, 'showExamForm'])->name('exams.take');
Route::post('exams/{exam}/submit', [UserExamController::class, 'submitAnswers'])->name('exams.submit');
Route::get('exams/viewResult', [UserExamController::class, 'view_result_exam'])->name('exams.Resultview');





 
    });


Route::get('exams/Results', [UserExamController::class, 'view_result_exam_by_leads'])->name('exams.LeadResultview');



Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/settings', [SiteController::class, 'index']);
Route::post('/settings/store', [SiteController::class, 'store']);
Route::get('delete_header_logo', [SiteController::class, 'delete_header_logo']);
Route::get('delete_favicon', [SiteController::class, 'delete_favicon']);
Route::post('/update_hide_sitename', [SiteController::class, 'updateHideSiteName']);


Route::post('settings', [SiteController::class, 'store_announcement']);
Route::get('delete_settings', [SiteController::class, 'delete_announcement']);

Route::get('user_announcement', [SiteController::class, 'get_userannouncement']);

Route::post('delete_course', [AdminCoursesController::class, 'delete_course']);




// Course settings
Route::get('course_settings', [CourseSettingsController::class, 'course_settings']);
Route::post('update_due_date', [CourseSettingsController::class, 'update_due_date']);

// Signature routes
Route::post('store_authorized_signature', [AuthorizedSignatureController::class, 'store_authorized_signature']);
Route::post('remove_authorized_signature', [AuthorizedSignatureController::class, 'remove_authorized_signature']);
Route::get('get_authorized_signature', [AuthorizedSignatureController::class, 'get_authorized_signature']);
Route::get('/api/authorized-signature', [AuthorizedSignatureController::class, 'apiAuthorizedSignature']);
Route::get('fetch_user_activity_filter', [UserActivityLogController::class, 'fetch_user_activity_filter']);
// Route::get('fetch_own_activity_filter', [UserActivityLogController::class, 'fetch_own_activity_filter']);

Route::post('/browser-closed', [LoginController::class, 'browserClosed'])->middleware('auth');
Route::post('/session-resume', [LoginController::class, 'sessionResume'])->middleware('auth');

// Feedback and Ratings routes
Route::post('update-create-ratings-feedback', [FeedBackRatingsSettingsController::class, 'updateOrCreateRatingsFeedback'])->middleware(['auth', 'Admin'])->name('update.create.ratings.feedback');
Route::get('view-ratings-feedback', [FeedBackRatingsSettingsController::class, 'viewRatingsFeedback'])->middleware(['auth', 'Admin'])->name('view.ratings.feedback');
Route::delete('delete-ratings-feedback/{id}', [FeedBackRatingsSettingsController::class, 'deleteRatingsFeedback'])->middleware(['auth', 'Admin'])->name('delete.ratings.feedback');

Route::get('feedback-ratings', [FeedBackRatingsSettingsController::class, 'feedbackRatingsIndex'])->middleware('auth');
Route::post('submit-feedback', [FeedBackRatingsSettingsController::class, 'submitFeedback'])->middleware('auth')->name('submit.feedback');

Route::get('masters/feedback_overview/{id}', [FeedBackRatingsSettingsController::class, 'feedback_overview']);

Route::match(['get', 'post'], '/certificate-signature', [SiteController::class, 'getCertificateSignature']);
Route::match(['get', 'post'], '/api/certificate-signature', [SiteController::class, 'getCertificateSignature']);

Route::match(['get', 'post'], '/site-logo', [SiteController::class, 'getSiteLogo']);
Route::match(['get', 'post'], '/api/site-logo', [SiteController::class, 'getSiteLogo']);

// Certificate.
Route::get('masters/edit-certificate/{id}', [IndexController::class, 'edit_certificate'])->name('masters.edit_certificate');
Route::post('masters/update-certificate/{id}', [IndexController::class, 'update_certificate'])->name('masters.update_certificate');
Route::post('masters/delete-certificate', [IndexController::class, 'delete_certificate']);
Route::get('masters/download-certificate/{id}', [IndexController::class, 'download_certificate'])->name('masters.download_certificate');


Route::get('admin/download_certificate/{id}', [AdminRegistrationController::class, 'download_certificate']);


Route::get('storage/app/public/{path}', function ($path) {
    $filePath = storage_path('app/public/' . $path);
    if (!file_exists($filePath)) {
        abort(404);
    }
    return response()->file($filePath);
})->where('path', '.*');

Route::get('public/{path}', function ($path) {
    $filePath = public_path($path);
    if (!file_exists($filePath)) {
        abort(404);
    }
    return response()->file($filePath);
})->where('path', '.*');





