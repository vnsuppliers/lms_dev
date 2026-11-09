<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    

    protected $fillable = [
             'first_name',
        'last_name',
        'email',
        'username',
        'password',
        'profile_image',
        'description',
        'user_name',
        'pass_word',
        'user_type',
        'time_zone',
        'language',
        'active',
        'last_login',
        'deactivation_date',
        'deactivation_reason',
        'exclude_from_emails',
        'role_id',
        'team_lead',
        'reporting_manager1',
        'reporting_manager2',
        'designation',
        'department',
        'emp_id',
        'training_manager',
        'senior_training_manager'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function sendPasswordResetNotification($token) {
    $this->notify(new ResetPassword($token));
}


        public function assigned_users()
    {
        return $this->belongsTo('App\Models\Asigneduser','id','user_id');
    }

        public function assigned_user()
    {
        return $this->hasMany('App\Models\Asigneduser', 'user_id', 'id');
    }
        public function roles()
    {
        return $this->hasMany('App\Models\Roles', 'id', 'user_type');
    }

    public function team_lead_details()
    {
        return $this->belongsTo('App\Models\User','team_lead', 'id');
    }

    public function manager1_details()
    {
        return $this->belongsTo('App\Models\User','reporting_manager1', 'id');
    }

    public function manager2_details()
    {
        return $this->belongsTo('App\Models\User','reporting_manager2', 'id');
    }

        public function designationdetails()
    {
        
        return $this->belongsTo('App\Models\Designation', 'designation', 'id');
    }

    public function departmentdetails()
    {
        return $this->belongsTo('App\Models\Department', 'department', 'id');
    }
    
}