<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Subcategory extends Model
{
    use HasFactory;

     protected $table = 'tbl_subcategories';

    protected $fillable = [
        'category_id',
        'subcategory_name',
        'status',
    ];

    public function cat()
    {
    	return $this->belongsto(Category::class,'category_id','id');
    }
        public function assignedCourses()
    {
        return $this->hasMany(Asigneduser::class, 'subcategory_id');
    }

}
