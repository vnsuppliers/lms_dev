<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTypes extends Model
{
    protected $fillable = [
        'course_code',
        'user_type',
        'permission_type',
    ];
}
