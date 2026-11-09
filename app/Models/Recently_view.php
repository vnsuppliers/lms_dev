<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recently_view extends Model
{
    use HasFactory;

     protected $table = 'tbl_recently_view_courses';
    
    protected $fillable = [
        'assign_id', 'user_id', 'view_time', 'status'
    ];

    public function assign_details()
    {
        return $this->belongsTo('App\Models\Asigneduser','assign_id','id');
    }
}
