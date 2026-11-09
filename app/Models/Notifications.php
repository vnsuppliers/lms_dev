<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

     protected $table = 'tbl_notifications';
    
    protected $fillable = [
        'user_id',
        'href_url',
        'message'
        
    ];


        public function users_data()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

     public function category_details()
    {
        return $this->belongsTo('App\Models\Category','category_id','id');
    }
     public function course_details()
    {
        return $this->belongsTo('App\Models\Courses','course_id','id');
    }
}
