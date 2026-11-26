<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asigneduser extends Model
{
    use HasFactory, SoftDeletes;

     protected $table = 'tbl_assignedusers';
    
    protected $fillable = [
        'user_id',
        'course_id',
        'category_id',
        'subcategory_id',
        'status',
        'completed_on',
        'group_id',
    ];


        public function users_data()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function bookmark_data()
    {
        return $this->belongsTo('App\Models\Bookmark','id','assign_id');
    }

     public function category_details()
    {
        return $this->belongsTo('App\Models\Category','category_id','id');
    }
    public function scorm_details()
    {
        return $this->belongsTo('App\Models\Scorm_data','id','course_id');
    }
     public function course_details()
    {
        return $this->belongsTo('App\Models\Courses','course_id','id');
    }
    public function active_course_details()
    {
        return $this->belongsTo('App\Models\Courses','course_id','id')->where('active',1);
    }
    public function course_data(){
        return $this->belongsTo('App\Models\Courses','course_id','id');
    }
    public function admin_offline_documents($value='')
    {
         return $this->hasMany('App\Models\Offline_Documents','assined_id','id')->where('type',2);
    }
    public function user_offline_documents($value='')
    {
         return $this->hasMany('App\Models\Offline_Documents','assined_id','id')->where('type',1);
    }
       public function training_data()
    {
        return $this->belongsTo('App\Models\Course_Training_data','course_id','course_id');
    }

     public function assigned_exam_data()
    {
        return $this->belongsTo('App\Models\ExamAttempt','id','assigned_id');
    }

        public function assigned_exam_datas() {
        return $this->hasMany(ExamAttempt::class, 'assigned_id', 'id'); 
    }

    /**
     * Checks if all course requirements (assessments and assignments) are completed and passed:
     * 1. Courses with assessments & assignments: all active assessments AND all active assignments must be passed.
     * 2. Courses with only assignments: all active assignments must be passed.
     * 3. Courses with only assessments: all active assessments must be passed.
     * If any assessment is reassigned (attempt reset), returns false until passed again.
     */
    public function isCompletedAndPassed($preloadedResults = null, $preloadedExamAttempts = null): bool
    {
        $courseId = $this->course_id;
        if (!$courseId) {
            return false;
        }

        $courseIds = [$courseId];
        $subCourseIds = Courses::where('parent_id', $courseId)->where('active', 1)->where('is_delete', 0)->pluck('id')->toArray();
        if (!empty($subCourseIds)) {
            $courseIds = array_merge($courseIds, $subCourseIds);
        }

        // 1. Active Assessments (type 6)
        $activeAssessments = Course_documents::whereIn('course_id', $courseIds)
            ->where('type', 6)
            ->where('is_delete', 0)
            ->where('is_active', 1)
            ->get();

        // 2. Active Assignments (type 7)
        $activeAssignments = Course_documents::whereIn('course_id', $courseIds)
            ->where('type', 7)
            ->where('is_delete', 0)
            ->where(function ($q) {
                $q->where('is_active', 1)->orWhereNull('is_active');
            })
            ->get();

        $hasAssessments = $activeAssessments->isNotEmpty();
        $hasAssignments = $activeAssignments->isNotEmpty();

        // A course must have at least one active assessment or assignment (exam) to be completed and passed
        if (!$hasAssessments && !$hasAssignments) {
            return false;
        }

        // If course has assessments, every active assessment must have at least one passing attempt
        if ($hasAssessments) {
            foreach ($activeAssessments as $assessment) {
                // 1. Direct check by current document ID
                if ($preloadedResults !== null) {
                    $passed = $preloadedResults->where('course_document_id', $assessment->id)
                        ->filter(fn ($res) => ((int)$res->assign_id === (int)$this->id) || ((int)$res->user_id === (int)$this->user_id))
                        ->contains(fn ($res) => $res->hasPassed());
                } else {
                    $passed = Assessment_results::where('course_document_id', $assessment->id)
                        ->where(function ($q) {
                            $q->where('assign_id', $this->id)->orWhere('user_id', $this->user_id);
                        })
                        ->whereNull('deleted_at')
                        ->get()
                        ->contains(fn ($res) => $res->hasPassed());
                }

                // 2. Fallback: If assessment document was revised/re-uploaded, check previous documents of same course/name
                if (!$passed) {
                    $matchingDocIds = Course_documents::whereIn('course_id', $courseIds)
                        ->where('type', 6)
                        ->where('is_delete', 0)
                        ->where(function ($q) use ($assessment) {
                            $q->where('id', $assessment->id)
                              ->orWhere('file_name', $assessment->file_name);
                        })
                        ->pluck('id')
                        ->toArray();

                    if ($preloadedResults !== null) {
                        $passed = $preloadedResults->whereIn('course_document_id', $matchingDocIds)
                            ->filter(fn ($res) => ((int)$res->assign_id === (int)$this->id) || ((int)$res->user_id === (int)$this->user_id))
                            ->contains(fn ($res) => $res->hasPassed());
                    } else {
                        $passed = Assessment_results::whereIn('course_document_id', $matchingDocIds)
                            ->where(function ($q) {
                                $q->where('assign_id', $this->id)->orWhere('user_id', $this->user_id);
                            })
                            ->whereNull('deleted_at')
                            ->get()
                            ->contains(fn ($res) => $res->hasPassed());
                    }
                }

                if (!$passed) {
                    return false;
                }
            }
        }

        // If course has assignments, every active assignment must have a passing attempt
        if ($hasAssignments) {
            $uniqueExamCodes = $activeAssignments->pluck('file_path')->filter()->unique();
            if ($uniqueExamCodes->isEmpty()) {
                return false;
            }

            foreach ($uniqueExamCodes as $examCode) {
                $exam = Exam::where('exam_code', $examCode)->first();
                if (!$exam) {
                    return false;
                }

                if ($preloadedExamAttempts !== null) {
                    $passed = $preloadedExamAttempts->where('exam_id', $exam->id)
                        ->filter(fn ($att) => ((int)$att->assigned_id === (int)$this->id) || (((int)$att->user_id === (int)$this->user_id) && in_array($att->course_id, $courseIds)))
                        ->contains(fn ($att) => strtolower(trim($att->exam_result ?? '')) === 'passed');
                } else {
                    $passed = ExamAttempt::where('exam_id', $exam->id)
                        ->where(function ($q) use ($courseIds) {
                            $q->where('assigned_id', $this->id)
                              ->orWhere(function ($sub) use ($courseIds) {
                                  $sub->where('user_id', $this->user_id)
                                      ->whereIn('course_id', $courseIds);
                              });
                        })
                        ->whereRaw('LOWER(exam_result) = ?', ['passed'])
                        ->exists();
                }

                if (!$passed) {
                    return false;
                }
            }
        }

        return true;
    }
}
