<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Course_documents extends Model
{
    use HasFactory;

     protected $table = 'tbl_course_documents_list';
    
    protected $fillable = [
        'course_id', 'type', 'file_name', 'file_path', 'status','org_file_name','is_delete','is_active','forge_urn', 'expiration_date'
    ];

     public function course_details()
    {
        return $this->belongsTo('App\Models\Courses','course_id','id');
    }
    public function assessment_result()
    {
        return $this->belongsTo('App\Models\Assessment_results','id','course_document_id')->where('user_id',Auth::id())->orderBy('id', 'DESC');
    }
    public function assessment_all_results()
    {
        return $this->hasMany('App\Models\Assessment_results','course_document_id','id')->where('user_id',Auth::id());
    }
     public function admin_assessment_result()
    {
        return $this->belongsTo('App\Models\Assessment_results','id','course_document_id');
    }

    public function assignment_all_results()
    {
        return $this->belongsTo('App\Models\Assessment_results','id','course_document_id');
    }

    public function assignment_exam_name()
    {
        return $this->belongsTo('App\Models\Exam','file_path','exam_code');
    }
}
