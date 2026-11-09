<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseVideoProgress extends Model
{
    use HasFactory;

     protected $table = 'tbl_course_progress';
    
    protected $fillable = [
        'user_id',
        'course_id',
        'video_time_played'
    ];

    
    public function Assign_userdetails()
    {
        return $this->belongsTo('App\Models\Courses','course_id','id');
    }

}
