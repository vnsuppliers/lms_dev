<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_Training_data extends Model
{
    use HasFactory;

     protected $table = 'tbl_training_data';
    
    protected $fillable = [
         'course_id', 'trainer_id', 'training_date', 'training_time_from', 'training_time_to', 'training_duration', 'training_location'
    ];

   public function userdetails()
    {
        return $this->belongsTo('App\Models\User','trainer_id','id');
    }
     public function course_details()
    {
        return $this->belongsTo('App\Models\Courses','course_id','id');
    }
    public function assigned_user()
    {
        return $this->hasMany('App\Models\User', 'course', 'id');
    }
}
