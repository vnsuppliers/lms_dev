<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scorm_data extends Model
{
    use HasFactory;

     protected $table = 'tbl_scorm_progress';
    
    protected $fillable = [
         'user_id', 'video_id', 'course_id', 'suspend_data', 'lesson_location', 'total_time', 'lesson_status', 'datafromlms', 'score', 'entry', 'scorm_exit', 'credit', 'status'
    ];

    public function assign_details()
    {
        return $this->belongsTo('App\Models\Asigneduser','course_id','id');
    }
}
