<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Users as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Users extends Authenticatable
{
    protected $table = 'tbl_users';

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
        'deactivation_date',
        'exclude_from_emails',
        'role_id',
    ];

    

}
