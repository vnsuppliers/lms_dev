<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table='departments';
    use HasFactory;
    protected $fillable = [
        'id',
        'department_name',
        'status'
    ];
     public function depart_Skill(){
         return $this->belongsTo('App\Models\skill_type', 'dept_id','id');
    }

      public function categories()
    {
        return $this->hasMany(Category::class, 'department_id');
    }
}
