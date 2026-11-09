<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeedbackRatingsSetting extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'tbl_feedback_ratings_settings';

    protected $fillable = [
        'name',
        'rating_enabled',
        'feedback_enabled',
        'is_active',
        'type',
        'category_id',
        'course_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id')->withTrashed();
    }

    public function employeeRatings()
    {
        return $this->hasMany(
            EmployeeFeedbackRating::class,
            'feedback_rating_setting_id'
        );
    }

}
