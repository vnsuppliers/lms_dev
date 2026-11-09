<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tbl_assignment_exams';
    

    protected $fillable = ['name','exam_code' ,'due_date','pass_percentage'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}