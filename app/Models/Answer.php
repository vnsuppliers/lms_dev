<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

     protected $table = 'tbl_assigned_answers';


    protected $fillable = ['exam_attendance_id', 'answer_result', 'question_id', 'answer_text', 'answer_file','correct_answer_file','correct_answer_text','answer_marks'];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
