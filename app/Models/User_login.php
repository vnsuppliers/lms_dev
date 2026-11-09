<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_login extends Model
{
    use HasFactory;

     protected $table = 'tbl_user_login_history';
    
    protected $fillable = [
        'user_id', 'login_time'
    ];

}
