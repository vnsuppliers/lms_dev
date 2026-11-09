<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assessment_results extends Model
{
    use HasFactory, SoftDeletes;

     protected $table = 'tbl_course_assessment_result';
    
    protected $fillable = [
        'course_document_id', 'assign_id', 'user_id', 'result_data', 'code', 'total_time_taken', 'results', 'completed_at', 'status','quiz_data'
    ];

    public function assign_details()
    {
        return $this->belongsTo('App\Models\Asigneduser','assign_id','id');
    }

    public function hasPassed(): bool
    {
        $payload = json_decode($this->result_data ?? '', true);
        $details = $payload['results'] ?? json_decode($this->results ?? '', true);
        if (!is_array($details)) {
            return false;
        }

        $status = strtolower(trim((string) ($details['pass_or_fail'] ?? '')));
        if ($status !== '') {
            return $status === 'passed';
        }

        return isset($details['percentage'], $details['cutoff'])
            && is_numeric($details['percentage'])
            && is_numeric($details['cutoff'])
            && (float) $details['percentage'] >= (float) $details['cutoff'];
    }

    public function course_document()
    {
        return $this->belongsTo('App\Models\Course_documents','course_document_id','id');
    }
}
