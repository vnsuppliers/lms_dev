<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'tbl_categories';

    protected $fillable = [
        'category_name',
        'parent_id',
        'status','description','image','department_id'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function assigned_user()
    {
        return $this->belongsTo('App\Models\Asigneduser', 'id', 'category_id');
    }
     public function category_assigned_cousers()
    {
        return $this->hasMany('App\Models\Asigneduser', 'category_id', 'id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function courses_of_category()
    {
        return $this->belongsTo('App\Models\Courses', 'id', 'category_id');
    }
}
