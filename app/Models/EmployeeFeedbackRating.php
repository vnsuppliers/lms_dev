<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeFeedbackRating extends Model
{
    use HasFactory;

    protected $table = 'tbl_employee_feedback_ratings';

    protected $fillable = [
        'employee_id',
        'feedback_rating_setting_id',
        'course_id',
        'category_id',
        'type',
        'rating',
        'feedback',
        'suggestions',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
    
}
