<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail_templates extends Model
{
    use HasFactory;

     protected $table = 'tbl_mail_templates';
    
    protected $fillable = [
        'title', 'subject', 'mail_to', 'mail_from', 'mail_cc', 'template', 'status'
    ];

     public function course_details()
    {
        return $this->belongsTo('App\Models\Courses','course_id','id');
    }
}
