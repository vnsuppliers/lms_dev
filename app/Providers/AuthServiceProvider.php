<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Helpers\ActivityLog;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     * 
     */

    public function boot()
{
    $this->app['events']->listen(
        'Illuminate\Auth\Events\Login',
        function ($event) {
            ActivityLog::log($event->user, 'Logged in',1);
        }
    );
}
    // public function boot()
    // {
    //     $this->registerPolicies();

    //     //
    // }
}
