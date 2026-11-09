<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Asigneduser;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;

class UserprofileServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                // Reuse notifications across partials only within this request.
                $cacheKey = 'lms.notification_view_data.' . $user->id;
                $request = request();
                if ($request->attributes->has($cacheKey)) {
                    $view->with($request->attributes->get($cacheKey));
                    return;
                }
                $assigned_course_count = Notifications::where('user_id', $user->id)->where('status',0)->count();
                if($assigned_course_count > 10){
                    $count= $assigned_course_count;
                }else{
                   $count=10; 
                }
                $assigned_course_message = Notifications::where('user_id', $user->id)->orderBy('id','desc')->limit($count)->get();
                // $courses_time=Asigneduser::with('course_details')->where('user_id',Auth::user()->id)->get();
                $notificationData = [
                'assigned_course_count' => $assigned_course_count,
                'assigned_course_message' => $assigned_course_message
                ];
                $request->attributes->set($cacheKey, $notificationData);
                $view->with($notificationData);
            }
        });
    }

    public function register()
    {
        //
    }
}
