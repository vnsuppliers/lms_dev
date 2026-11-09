<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

     protected $table = 'tbl_bookmark_courses';
    
    protected $fillable = [
        'assign_id', 'user_id', 'status'
    ];

    public function assign_details()
    {
        return $this->belongsTo('App\Models\Asigneduser','assign_id','id');
    }
}
