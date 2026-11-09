<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamAttempt extends Model
{
    use HasFactory, SoftDeletes;

    protected $table="tbl_exam_attempts";

    protected $fillable = ['exam_id', 'assigned_id', 'user_id','course_id', 'exam_attend_date', 'exam_result','evaluation_completed_date'];

    public function answers()
    {
        return $this->hasMany(Answer::class, 'exam_attendance_id');
    }
     public function exam_details()
    {
        return $this->belongsTo('App\Models\Exam','exam_id','id');
    }
     public function user_details()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
