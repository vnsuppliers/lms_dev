<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentVideoAccess extends Model
{
    use HasFactory;

    protected $table = 'tbl_assessment_video_access';

    protected $fillable = [
        'user_id',
        'assign_id',
        'course_id',
        'completed_video_ids',
        'granted_at',
        'consumed_at',
        'assessment_id',
        'result_recorded_at',
    ];

    protected $casts = [
        'completed_video_ids' => 'array',
        'granted_at' => 'datetime',
        'consumed_at' => 'datetime',
        'result_recorded_at' => 'datetime',
    ];
}
