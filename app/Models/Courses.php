<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Courses extends Model
{
    // use HasFactory;
    Use SoftDeletes;

     protected $table = 'tbl_courses';
    
    protected $fillable = [
        'course_name',
        'category_id',
        'subcategory_id',
        'description',
        'active',
        'hide_from_catalog',
        'course_code',
        'course_image',
        'intro_video_link',
        'intro_video_upload',
        'capacity',
        'content_type_upload',
        'content_type',
        'start_date',
        'expiration_date',
        'retain_access',
        'certificate',
        'level','goal','course_type', 'trainer_name', 'training_date', 'training_time_from', 'training_time_to', 'training_duration', 'training_location','points','is_delete'
    ];

    protected $dates = ['deleted_at'];
    
    public function Assign_userdetails()
    {
        return $this->belongsTo('App\Models\Asigneduser','id','course_id');
    }
    public function certificate_data()
    {
        return $this->belongsTo('App\Models\Certificate','certificate','id');
    }
    
    public function Assigned_usersdetails()
    {
        return $this->hasMany('App\Models\Asigneduser','course_id','id');
    }

        public function category_details()
    {
        return $this->belongsTo('App\Models\Category','category_id','id');
    }

     public function subcategory_details()
    {
        return $this->belongsTo('App\Models\Subcategory','subcategory_id','id');
    }
    public function goal_details()
    {
        return $this->belongsTo('App\Models\Goal','goal','id');
    }
     public function training_details()
    {
        return $this->hasMany('App\Models\Course_Training_data','course_id','id');
    }
     public function documents_details()
    {
        return $this->hasMany('App\Models\Course_documents','course_id','id');
    }
     public function only_attachments()
    {
        return $this->hasMany('App\Models\Course_documents','course_id','id')->where('type',5);
    }
    public function only_scorm()
    {
        return $this->hasMany('App\Models\Course_documents','course_id','id')->where('type',4)->where('is_delete', 0)->where('is_active',1);
    }
     public function assessments()
    {
        return $this->hasMany('App\Models\Course_documents','course_id','id')->where('type',6);
    }
     public function other_videos()
    {
        return $this->hasMany('App\Models\Course_documents','course_id','id')->where('type','!=',4)->where('type','!=',5)->where('type','!=',6)->where('type','!=',7);
    }
         public function assignment_exam()
    {
        return $this->hasMany('App\Models\Course_documents','course_id','id')->where('type',7)->where('is_delete',0);
    }
}
