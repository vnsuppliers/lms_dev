<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
     protected $table = 'tbl_assignment_questions';

    protected $fillable = ['exam_id', 'question_name', 'question_file','question_mark'];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}