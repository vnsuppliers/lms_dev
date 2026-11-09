<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportService
{
    /**
     * Get all safe available data sources.
     */
    public function getDataSources()
    {
        return config('reports.sources', []);
    }

    /**
     * Check if a field represents an internal database primary/foreign key ID
     * that should not be exposed to the UI or selectable columns.
     */
    public function isTechnicalIdField(string $key, array $def = []): bool
    {
        // Business identifier like Employee ID is user-facing and valid
        if ($key === 'users.emp_id' || (isset($def['label']) && strtolower(trim($def['label'])) === 'employee id')) {
            return false;
        }

        // Exclude raw table primary keys or foreign keys
        if (str_ends_with($key, '.id') || str_ends_with($key, '_id')) {
            return true;
        }

        $label = strtolower(trim($def['label'] ?? ''));
        $technicalLabels = [
            'id',
            'user id',
            'course id',
            'assignment id',
            'enrollment id',
            'result id',
            'attempt id',
            'content id',
            'certificate id',
            'feedback id',
            'department id',
        ];

        return in_array($label, $technicalLabels);
    }

    /**
     * Get simple, basic English description for a report column so any user can understand.
     */
    public function getFieldDescription(string $key, string $label = ''): string
    {
        $descMap = [
            // Users & Learner Profile
            'users.first_name' => 'Full name of the registered learner',
            'users.last_name' => 'Surname or family name of the learner',
            'users.email' => 'Official email address used for LMS login',
            'users.emp_id' => 'Unique employee code or staff ID',
            'departments.department_name' => 'Company department or division the user belongs to',
            'designations.designation_name' => 'Current job title or role designation of the user',
            'users.active' => 'Account status: Active, Inactive, or Deactivated',
            'users.deactivation_reason' => 'Description or reason explaining why the user was deactivated by administrator',
            'users.deactivation_date' => 'Date and time when the user account was deactivated',
            'users.last_login' => 'Date and time user last logged into LMS',
            'users.created_at' => 'Date when the user account was created in LMS',

            // Learner Metrics
            'users.assigned_courses_count' => 'Total number of courses allocated to this learner',
            'users.completed_courses_count' => 'Number of assigned courses fully completed',
            'users.inprogress_courses_count' => 'Number of assigned courses currently in progress',
            'users.notstarted_courses_count' => 'Number of assigned courses not yet started',
            'users.expired_courses_count' => 'Number of assigned courses that passed their due date without completion',
            'users.course_completion_rate' => 'Percentage of assigned courses completed',
            'users.assigned_assessments_count' => 'Total quizzes and assessments assigned in courses',
            'users.completed_assessments_count' => 'Number of assessments attempted by this learner',
            'users.avg_assessment_score' => 'Average score percentage across all attempted assessments',
            'users.exams_attempted_count' => 'Number of assignment exams submitted',
            'users.exams_passed_count' => 'Number of assignment exams successfully passed',
            'users.videos_watched_count' => 'Total learning videos and interactive modules watched',
            'users.certificates_count' => 'Total course completion certificates earned',

            // Courses & Catalog
            'tbl_courses.course_name' => 'Official title of the course',
            'tbl_courses.course_code' => 'Unique reference code or catalog number of the course',
            'tbl_categories.category_name' => 'Subject category or domain of the course',
            'tbl_courses.active' => 'Course availability status: Active or Inactive',
            'tbl_courses.enrolled_learners_count' => 'Total learners enrolled in this course',
            'tbl_courses.completed_learners_count' => 'Total learners who successfully finished this course',
            'tbl_courses.inprogress_learners_count' => 'Total learners currently learning and in progress',
            'tbl_courses.notstarted_learners_count' => 'Total enrolled learners who have not yet started',
            'tbl_courses.expired_learners_count' => 'Total enrolled learners whose due date has passed without completion',
            'tbl_courses.completion_rate' => 'Overall percentage of learners who completed the course',
            'tbl_courses.total_assessments_count' => 'Total quizzes and tests included in this course',
            'tbl_courses.total_videos_count' => 'Total videos and documents uploaded to this course',
            'tbl_courses.avg_assessment_score' => 'Average score percentage achieved by learners in this course',
            'tbl_courses.capacity' => 'Maximum number of learners allowed in this course',
            'tbl_courses.points' => 'Reward points earned upon completing this course',
            'tbl_courses.expiration_date' => 'Due date or deadline to finish the course',
            'tbl_courses.created_at' => 'Date when this course was created',

            // Enrollments
            'tbl_assignedusers.team_name' => 'Team name, group, or course category',
            'tbl_assignedusers.created_at' => 'Date when the course was assigned to the learner',
            'tbl_assignedusers.expires_in_days' => 'Number of days remaining before course expires',
            'tbl_assignedusers.start_date' => 'Date the learner first accessed the course',
            'tbl_assignedusers.completed_on' => 'Date when the learner completed the course',
            'tbl_assignedusers.progress_status' => 'Learning stage: Not Started, In Progress, Completed, or Expired',
            'tbl_courses.course_status' => 'Course progress stage: Not Started, In Progress, Completed, or Expired',
            'tbl_assignedusers.status' => 'Course completion status code',
            'tbl_assignedusers.result' => 'Overall evaluation result: Pass, Fail, or Not Attempted',
            'tbl_assignedusers.comments' => 'Assignment type: Newly Assigned or Reassigned',

            // Assessments & Quizzes
            'tbl_course_documents_list.file_name' => 'Title or file name of the quiz or assessment',
            'tbl_course_assessment_result.score' => 'Actual marks or points scored in the quiz',
            'tbl_course_assessment_result.percentage' => 'Score percentage achieved in the quiz',
            'tbl_course_assessment_result.time_spent' => 'Total time taken to complete the quiz',
            'tbl_course_assessment_result.status' => 'Assessment status: Completed, In Progress, or Not Started',
            'tbl_course_assessment_result.pass_fail' => 'Overall quiz result: Passed, Failed, Pending, or Not Attempted',
            'tbl_course_assessment_result.created_at' => 'Date and time when the quiz was taken',
            'tbl_course_assessment_result.completed_at' => 'Date and time when the quiz was submitted',
            'tbl_course_assessment_result.comments' => 'Whether test is initially assigned or reassigned',

            // Assignment Exams
            'tbl_assignment_exams.name' => 'Title of the assignment examination',
            'tbl_assignment_exams.exam_name' => 'Title of the assignment examination',
            'tbl_exam_attempts.exam_result' => 'Pass or Fail evaluation outcome of the exam',
            'tbl_exam_attempts.exam_marks' => 'Marks awarded for the assignment exam',
            'tbl_exam_attempts.exam_percentage' => 'Score percentage achieved in the assignment exam',
            'tbl_exam_attempts.exam_attend_date' => 'Date and time when the learner started the exam',
            'tbl_exam_attempts.evaluation_completed_date' => 'Date and time when evaluation was completed',

            // Videos & Learning Materials
            'tbl_course_documents_list.content_title' => 'Title of the video, file, or interactive module',
            'tbl_course_documents_list.org_file_name' => 'Original uploaded file name and extension',
            'tbl_course_documents_list.type' => 'Format: Amazon Video, YouTube, Local Video, SCORM, File',
            'tbl_assessment_video_access.watch_status' => 'Whether learner has watched or not watched this item',

            // Certificates
            'tbl_certificates.certificate_name' => 'Name or title of the certificate template',
            'tbl_certificates.code' => 'Unique certificate verification number or code',
            'tbl_certificates.status' => 'Certificate validity: Active or Inactive',
            'tbl_certificates.signature_status' => 'Whether authorized instructor signature is present',
            'tbl_certificates.created_at' => 'Date when the certificate was issued',

            // Feedback & Ratings
            'tbl_feedback_ratings_settings.name' => 'Feedback form title or question category',
            'tbl_employee_feedback_ratings.type' => 'Feedback scope: Overall LMS or Category-specific',
            'tbl_employee_feedback_ratings.rating' => 'Star rating given by the learner (1 to 5 stars)',
            'tbl_employee_feedback_ratings.feedback' => 'Written comments or reviews submitted by learner',
            'tbl_employee_feedback_ratings.suggestions' => 'Suggestions for course improvement',
            'tbl_employee_feedback_ratings.created_at' => 'Date and time when feedback was submitted',

            // Training Matrix & Department Analytics
            'departments.total_users_count' => 'Count of active learners in this department',
            'departments.total_courses_assigned' => 'Total course assignments across this department',
            'departments.total_courses_completed' => 'Total courses completed by department staff',
            'departments.completion_rate' => 'Department overall training completion rate (%)',
            'departments.total_assessments_assigned' => 'Total quiz assignments for department staff',
            'departments.total_assessments_passed' => 'Total passed quizzes among department staff',
            'departments.avg_assessment_score' => 'Average assessment score percentage for this department',
        ];

        if (isset($descMap[$key])) {
            return $descMap[$key];
        }

        $l = strtolower($label);
        if (str_contains($l, 'email')) return 'Email address of the learner';
        if (str_contains($l, 'name') && str_contains($l, 'course')) return 'Title of the course';
        if (str_contains($l, 'name') && (str_contains($l, 'learner') || str_contains($l, 'user') || str_contains($l, 'employee'))) return 'Full name of the learner';
        if (str_contains($l, 'department')) return 'Department or division name';
        if (str_contains($l, 'designation')) return 'Job title or role designation';
        if (str_contains($l, 'status')) return 'Current status or progress state';
        if (str_contains($l, 'date') && str_contains($l, 'due')) return 'Deadline or due date';
        if (str_contains($l, 'date') && str_contains($l, 'assign')) return 'Date when assigned';
        if (str_contains($l, 'date')) return 'Recorded date and time';
        if (str_contains($l, 'score') || str_contains($l, 'marks')) return 'Score or marks achieved';
        if (str_contains($l, 'percentage') || str_contains($l, 'rate')) return 'Percentage calculation value';
        if (str_contains($l, 'count') || str_contains($l, 'total')) return 'Total calculated count';
        if (str_contains($l, 'result') || str_contains($l, 'pass')) return 'Pass, Fail, or completion outcome';
        if (str_contains($l, 'time') || str_contains($l, 'spent')) return 'Duration of time taken';
        if (str_contains($l, 'code')) return 'Unique identifier code';

        return 'Report column for ' . ($label ?: $key);
    }

    /**
     * Get schema and options for a specific data source or multiple combined data sources.
     */
    public function getSourceSchema($sourceKey)
    {
        $sources = $this->getDataSources();
        if (is_string($sourceKey) && str_contains($sourceKey, ',')) {
            $sourceKeys = array_filter(array_map('trim', explode(',', $sourceKey)));
        } elseif (is_array($sourceKey)) {
            $sourceKeys = array_filter(array_map('trim', $sourceKey));
        } else {
            $sourceKeys = !empty($sourceKey) ? [$sourceKey] : [];
        }

        $validKeys = [];
        foreach ($sourceKeys as $k) {
            if (isset($sources[$k])) {
                $validKeys[] = $k;
            }
        }

        if (empty($validKeys)) {
            return null;
        }

        $courses = DB::table('tbl_courses')
            ->whereNull('deleted_at')
            ->where(function ($q) {
                $q->whereNull('is_delete')->orWhere('is_delete', 0);
            })
            ->orderBy('course_name')
            ->select('id', 'course_name', 'course_code')
            ->get();

        $learners = DB::table('users')
            ->orderBy('first_name')
            ->select('id', 'first_name', 'last_name', 'email', 'emp_id')
            ->get();

        $departments = DB::table('departments')
            ->orderBy('department_name')
            ->select('id', 'department_name')
            ->get();

        $designations = DB::table('designations')
            ->orderBy('designation_name')
            ->select('id', 'designation_name')
            ->get();

        // Single source: return standard structure with enriched section info (excluding any technical IDs)
        if (count($validKeys) === 1) {
            $singleKey = $validKeys[0];
            $source = $sources[$singleKey];
            $cleanSingleFields = [];
            foreach ($source['fields'] as $fKey => $fDef) {
                if (!$this->isTechnicalIdField($fKey, $fDef)) {
                    if (empty($fDef['description'])) {
                        $fDef['description'] = $this->getFieldDescription($fKey, $fDef['label'] ?? '');
                    }
                    $cleanSingleFields[$fKey] = $fDef;
                }
            }

            return [
                'key' => $singleKey,
                'is_multi' => false,
                'label' => $source['label'],
                'description' => $source['description'],
                'fields' => $cleanSingleFields,
                'fields_by_source' => [
                    $singleKey => [
                        'key' => $singleKey,
                        'label' => $source['label'],
                        'icon' => $source['icon'] ?? 'fa-solid fa-database',
                        'fields' => $cleanSingleFields,
                    ]
                ],
                'group_by' => $source['group_by'] ?? [],
                'summary_options' => $source['summary_options'] ?? ['COUNT' => 'Total Records'],
                'metric_field' => 'users.emp_id',
                'operators' => config('reports.operators', []),
                'courses' => $courses,
                'learners' => $learners,
                'departments' => $departments,
                'designations' => $designations,
            ];
        }

        // Multi-Source Schema Builder: merge all fields cleanly without duplicate fields or ID columns
        $nativeTableMap = [
            'users.' => 'learners',
            'departments.department_name' => 'learners',
            'designations.designation_name' => 'learners',
            'tbl_courses.' => 'courses',
            'tbl_categories.' => 'courses',
            'tbl_assignedusers.' => 'enrollments',
            'tbl_course_assessment_result.' => 'assessments',
            'tbl_assignment_exams.' => 'exams',
            'tbl_exam_attempts.' => 'exams',
            'tbl_course_documents_list.type' => 'videos',
            'tbl_course_documents_list.content_title' => 'videos',
            'tbl_course_documents_list.org_file_name' => 'videos',
            'tbl_certificates.' => 'certificates',
            'tbl_employee_feedback_ratings.' => 'feedback',
            'tbl_feedback_ratings_settings.' => 'feedback',
            'departments.total_' => 'training_matrix',
        ];

        $seenFieldKeys = [];
        $mergedFields = [];
        $fieldsBySource = [];
        $mergedGroupBy = [
            'none_individual' => 'Individual Records (Show all checked columns)',
            'users.first_name' => 'Group by Learner Name',
            'tbl_courses.course_name' => 'Group by Course Title',
            'departments.department_name' => 'Group by Department',
            'tbl_categories.category_name' => 'Group by Course Category',
            'tbl_assignedusers.progress_status' => 'Group by Course Status',
        ];
        $mergedSummaryOptions = [
            'COUNT' => 'Total Records Count',
            'SUM_COURSES' => 'Total Assigned Courses (Sum)',
            'SUM_COMPLETED' => 'Total Completed Courses (Sum)',
            'COUNT_PASSED' => 'Total Passed / Completed',
            'COUNT_FAILED' => 'Total Failed',
            'AVG_PERCENTAGE' => 'Average Assessment Score (%)',
            'SUM_ENROLLMENTS' => 'Total Learner Enrollments',
        ];

        // Sort selected sources into logical canonical order
        $preferredOrder = ['learners', 'courses', 'enrollments', 'assessments', 'exams', 'videos', 'certificates', 'feedback', 'training_matrix'];
        usort($validKeys, function ($a, $b) use ($preferredOrder) {
            $posA = array_search($a, $preferredOrder);
            $posB = array_search($b, $preferredOrder);
            return ($posA === false ? 99 : $posA) <=> ($posB === false ? 99 : $posB);
        });

        foreach ($validKeys as $k) {
            $src = $sources[$k];
            $cleanSourceFields = [];

            foreach ($src['fields'] as $fKey => $fMeta) {
                // 1. Exclude all technical database IDs (primary keys, foreign keys)
                if ($this->isTechnicalIdField($fKey, $fMeta)) {
                    continue;
                }

                // 2. Prevent duplicate fields: If a native source for this column is also selected, let the native source display it
                if (count($validKeys) > 1) {
                    foreach ($nativeTableMap as $prefix => $nativeSrcKey) {
                        if (str_starts_with($fKey, $prefix)) {
                            if ($nativeSrcKey !== $k && in_array($nativeSrcKey, $validKeys)) {
                                continue 2;
                            }
                        }
                    }
                }

                // 3. Ensure no field key is ever repeated across sources
                if (isset($seenFieldKeys[$fKey])) {
                    continue;
                }

                $seenFieldKeys[$fKey] = true;
                $fMeta['source_key'] = $k;
                $fMeta['source_label'] = $src['label'];
                if (empty($fMeta['description'])) {
                    $fMeta['description'] = $this->getFieldDescription($fKey, $fMeta['label'] ?? '');
                }
                $cleanSourceFields[$fKey] = $fMeta;
                $mergedFields[$fKey] = $fMeta;
            }

            if (!empty($cleanSourceFields)) {
                $fieldsBySource[$k] = [
                    'key' => $k,
                    'label' => $src['label'],
                    'icon' => $src['icon'] ?? 'fa-solid fa-database',
                    'description' => $src['description'] ?? '',
                    'fields' => $cleanSourceFields,
                ];
            }

            if (!empty($src['group_by'])) {
                foreach ($src['group_by'] as $gbKey => $gbLabel) {
                    if (!isset($mergedGroupBy[$gbKey])) {
                        $mergedGroupBy[$gbKey] = $gbLabel;
                    }
                }
            }

            if (!empty($src['summary_options'])) {
                foreach ($src['summary_options'] as $soKey => $soLabel) {
                    if (!isset($mergedSummaryOptions[$soKey])) {
                        $mergedSummaryOptions[$soKey] = $soLabel;
                    }
                }
            }
        }

        return [
            'key' => implode(',', $validKeys),
            'is_multi' => true,
            'selected_sources' => $validKeys,
            'label' => 'Multi-Source Composite Report (' . count($validKeys) . ' Sources Selected)',
            'description' => 'Cross-functional report combining: ' . implode(', ', array_map(function($k) use ($sources) { return $sources[$k]['label'] ?? $k; }, $validKeys)),
            'fields' => $mergedFields,
            'fields_by_source' => $fieldsBySource,
            'group_by' => $mergedGroupBy,
            'summary_options' => $mergedSummaryOptions,
            'metric_field' => 'users.emp_id',
            'operators' => config('reports.operators', []),
            'courses' => $courses,
            'learners' => $learners,
            'departments' => $departments,
            'designations' => $designations,
        ];
    }

    /**
     * Build unified relational query across multiple data sources.
     */
    public function buildMultiSourceQuery(array $sourceKeys, array $config)
    {
        $sources = $this->getDataSources();
        $validKeys = array_values(array_intersect($sourceKeys, array_keys($sources)));

        if (count($validKeys) === 1) {
            return $this->buildQuery($validKeys[0], $config);
        }
        if (empty($validKeys)) {
            return $this->buildQuery('learners', $config);
        }

        // Merge fields from all selected sources without technical ID columns
        $allowedFields = [];
        foreach ($validKeys as $k) {
            $src = $sources[$k];
            foreach ($src['fields'] as $fKey => $fDef) {
                if ($this->isTechnicalIdField($fKey, $fDef)) {
                    continue;
                }
                if (!isset($allowedFields[$fKey])) {
                    $fDef['source_key'] = $k;
                    $fDef['source_label'] = $src['label'];
                    $allowedFields[$fKey] = $fDef;
                }
            }
        }

        // Comprehensive Correlated Multi-Source Expressions
        // Ensures any secondary or 1-to-many source fields evaluate safely without unjoined column errors or cartesian duplication
        $multiSourceExpressions = [
            // Assessments (type = 6 in tbl_course_documents_list)
            'tbl_course_documents_list.file_name' => [
                'raw_select' => (in_array('assessments', $validKeys) || in_array('learners', $validKeys))
                    ? "(SELECT GROUP_CONCAT(COALESCE(NULLIF(JSON_UNQUOTE(JSON_EXTRACT((SELECT car.quiz_data FROM tbl_course_assessment_result as car WHERE car.user_id = tbl_assignedusers.user_id AND car.course_document_id = cdl.id AND car.deleted_at IS NULL ORDER BY car.id DESC LIMIT 1), '$.title')), ''), NULLIF(cdl.file_name, '-'), 'Assessment') ORDER BY cdl.id SEPARATOR '<br>') FROM tbl_course_documents_list as cdl WHERE cdl.course_id = tbl_assignedusers.course_id AND cdl.type = 6 AND cdl.is_delete = 0)"
                    : "(SELECT GROUP_CONCAT(COALESCE(NULLIF(cdl.file_name, ''), NULLIF(cdl.org_file_name, ''), NULLIF(cdl.file_path, ''), 'Video / Content') ORDER BY cdl.id SEPARATOR '<br>') FROM tbl_course_documents_list as cdl WHERE cdl.course_id = tbl_assignedusers.course_id AND cdl.type IN (1, 2, 3, 4, 5) AND cdl.is_delete = 0)",
                'filter_sql' => "(SELECT GROUP_CONCAT(cdl.file_name SEPARATOR ' ') FROM tbl_course_documents_list as cdl WHERE cdl.course_id = tbl_assignedusers.course_id AND cdl.is_delete = 0)",
            ],
            'tbl_course_assessment_result.score' => [
                'raw_select' => "(SELECT GROUP_CONCAT(COALESCE((SELECT ROUND(CAST(JSON_UNQUOTE(JSON_EXTRACT(car.results, '$.score')) AS DECIMAL(10,2)), 2) FROM tbl_course_assessment_result as car WHERE car.user_id = tbl_assignedusers.user_id AND car.course_document_id = cdl.id AND car.deleted_at IS NULL ORDER BY car.id DESC LIMIT 1), '-') ORDER BY cdl.id SEPARATOR '<br>') FROM tbl_course_documents_list as cdl WHERE cdl.course_id = tbl_assignedusers.course_id AND cdl.type = 6 AND cdl.is_delete = 0)",
                'filter_sql' => "(SELECT AVG(CAST(JSON_UNQUOTE(JSON_EXTRACT(car.results, '$.score')) AS DECIMAL(10,2))) FROM tbl_course_assessment_result as car WHERE car.user_id = tbl_assignedusers.user_id AND car.course_id = tbl_assignedusers.course_id AND car.deleted_at IS NULL)",
            ],
            'tbl_course_assessment_result.percentage' => [
                'raw_select' => "(SELECT GROUP_CONCAT(COALESCE((SELECT CONCAT(ROUND(CAST(JSON_UNQUOTE(JSON_EXTRACT(car.results, '$.percentage')) AS DECIMAL(10,2)), 2), '%') FROM tbl_course_assessment_result as car WHERE car.user_id = tbl_assignedusers.user_id AND car.course_document_id = cdl.id AND car.deleted_at IS NULL ORDER BY car.id DESC LIMIT 1), '-') ORDER BY cdl.id SEPARATOR '<br>') FROM tbl_course_documents_list as cdl WHERE cdl.course_id = tbl_assignedusers.course_id AND cdl.type = 6 AND cdl.is_delete = 0)",
                'filter_sql' => "(SELECT AVG(CAST(JSON_UNQUOTE(JSON_EXTRACT(car.results, '$.percentage')) AS DECIMAL(10,2))) FROM tbl_course_assessment_result as car WHERE car.user_id = tbl_assignedusers.user_id AND car.course_id = tbl_assignedusers.course_id AND car.deleted_at IS NULL)",
            ],
            'tbl_course_assessment_result.pass_fail' => [
                'raw_select' => "(SELECT GROUP_CONCAT(COALESCE((SELECT JSON_UNQUOTE(JSON_EXTRACT(car.results, '$.pass_or_fail')) FROM tbl_course_assessment_result as car WHERE car.user_id = tbl_assignedusers.user_id AND car.course_document_id = cdl.id AND car.deleted_at IS NULL ORDER BY car.id DESC LIMIT 1), 'Not Attempted') ORDER BY cdl.id SEPARATOR '<br>') FROM tbl_course_documents_list as cdl WHERE cdl.course_id = tbl_assignedusers.course_id AND cdl.type = 6 AND cdl.is_delete = 0)",
                'filter_sql' => "(SELECT GROUP_CONCAT(COALESCE((SELECT JSON_UNQUOTE(JSON_EXTRACT(car.results, '$.pass_or_fail')) FROM tbl_course_assessment_result as car WHERE car.user_id = tbl_assignedusers.user_id AND car.course_document_id = cdl.id AND car.deleted_at IS NULL ORDER BY car.id DESC LIMIT 1), 'Not Attempted') SEPARATOR ' ') FROM tbl_course_documents_list as cdl WHERE cdl.course_id = tbl_assignedusers.course_id AND cdl.type = 6 AND cdl.is_delete = 0)",
            ],
            'tbl_course_assessment_result.time_spent' => [
                'raw_select' => "(SELECT GROUP_CONCAT(COALESCE((SELECT CASE WHEN car.total_time_taken >= 60 THEN CONCAT(FLOOR(car.total_time_taken / 60), ' Min ', MOD(car.total_time_taken, 60), ' Sec') ELSE CONCAT(COALESCE(car.total_time_taken, 0), ' Sec') END FROM tbl_course_assessment_result as car WHERE car.user_id = tbl_assignedusers.user_id AND car.course_document_id = cdl.id AND car.deleted_at IS NULL ORDER BY car.id DESC LIMIT 1), '-') ORDER BY cdl.id SEPARATOR '<br>') FROM tbl_course_documents_list as cdl WHERE cdl.course_id = tbl_assignedusers.course_id AND cdl.type = 6 AND cdl.is_delete = 0)",
            ],
            'tbl_course_assessment_result.status' => [
                'raw_select' => "(SELECT GROUP_CONCAT(COALESCE((SELECT CASE WHEN car.completed_at IS NOT NULL OR JSON_UNQUOTE(JSON_EXTRACT(car.results, '$.pass_or_fail')) IN ('Passed', 'Failed') THEN 'Completed' ELSE 'In Progress' END FROM tbl_course_assessment_result as car WHERE car.user_id = tbl_assignedusers.user_id AND car.course_document_id = cdl.id AND car.deleted_at IS NULL ORDER BY car.id DESC LIMIT 1), 'Not Started') ORDER BY cdl.id SEPARATOR '<br>') FROM tbl_course_documents_list as cdl WHERE cdl.course_id = tbl_assignedusers.course_id AND cdl.type = 6 AND cdl.is_delete = 0)",
                'filter_sql' => "(SELECT GROUP_CONCAT(COALESCE((SELECT CASE WHEN car.completed_at IS NOT NULL OR JSON_UNQUOTE(JSON_EXTRACT(car.results, '$.pass_or_fail')) IN ('Passed', 'Failed') THEN 'Completed' ELSE 'In Progress' END FROM tbl_course_assessment_result as car WHERE car.user_id = tbl_assignedusers.user_id AND car.course_document_id = cdl.id AND car.deleted_at IS NULL ORDER BY car.id DESC LIMIT 1), 'Not Started') SEPARATOR ' ') FROM tbl_course_documents_list as cdl WHERE cdl.course_id = tbl_assignedusers.course_id AND cdl.type = 6 AND cdl.is_delete = 0)",
            ],
            'tbl_course_assessment_result.created_at' => [
                'raw_select' => "(SELECT GROUP_CONCAT(COALESCE((SELECT DATE_FORMAT(car.created_at, '%d-%b-%Y %h:%i %p') FROM tbl_course_assessment_result as car WHERE car.user_id = tbl_assignedusers.user_id AND car.course_document_id = cdl.id AND car.deleted_at IS NULL ORDER BY car.id DESC LIMIT 1), '-') ORDER BY cdl.id SEPARATOR '<br>') FROM tbl_course_documents_list as cdl WHERE cdl.course_id = tbl_assignedusers.course_id AND cdl.type = 6 AND cdl.is_delete = 0)",
            ],
            'tbl_course_assessment_result.completed_at' => [
                'raw_select' => "(SELECT GROUP_CONCAT(COALESCE((SELECT DATE_FORMAT(car.completed_at, '%d-%b-%Y %h:%i %p') FROM tbl_course_assessment_result as car WHERE car.user_id = tbl_assignedusers.user_id AND car.course_document_id = cdl.id AND car.deleted_at IS NULL ORDER BY car.id DESC LIMIT 1), '-') ORDER BY cdl.id SEPARATOR '<br>') FROM tbl_course_documents_list as cdl WHERE cdl.course_id = tbl_assignedusers.course_id AND cdl.type = 6 AND cdl.is_delete = 0)",
            ],
            'tbl_course_assessment_result.comments' => [
                'raw_select' => "(SELECT GROUP_CONCAT(COALESCE((SELECT CASE WHEN car.deleted_at IS NOT NULL THEN 'Reassigned' ELSE 'Assigned' END FROM tbl_course_assessment_result as car WHERE car.user_id = tbl_assignedusers.user_id AND car.course_document_id = cdl.id ORDER BY car.id DESC LIMIT 1), 'Assigned') ORDER BY cdl.id SEPARATOR '<br>') FROM tbl_course_documents_list as cdl WHERE cdl.course_id = tbl_assignedusers.course_id AND cdl.type = 6 AND cdl.is_delete = 0)",
                'filter_sql' => "(SELECT GROUP_CONCAT(COALESCE((SELECT CASE WHEN car.deleted_at IS NOT NULL THEN 'Reassigned' ELSE 'Assigned' END FROM tbl_course_assessment_result as car WHERE car.user_id = tbl_assignedusers.user_id AND car.course_document_id = cdl.id ORDER BY car.id DESC LIMIT 1), 'Assigned') SEPARATOR ' ') FROM tbl_course_documents_list as cdl WHERE cdl.course_id = tbl_assignedusers.course_id AND cdl.type = 6 AND cdl.is_delete = 0)",
            ],

            // Assignment Exams (type = 7 in tbl_course_documents_list)
            'tbl_assignment_exams.name' => [
                'raw_select' => "(SELECT GROUP_CONCAT(COALESCE(NULLIF(ae.name, ''), NULLIF(cdl.file_name, ''), 'Assignment') ORDER BY cdl.id SEPARATOR '<br>') FROM tbl_course_documents_list as cdl LEFT JOIN tbl_assignment_exams as ae ON ae.exam_code = cdl.file_path WHERE cdl.course_id = tbl_assignedusers.course_id AND cdl.type = 7 AND cdl.is_delete = 0)",
                'filter_sql' => "(SELECT GROUP_CONCAT(COALESCE(NULLIF(ae.name, ''), NULLIF(cdl.file_name, ''), 'Assignment') SEPARATOR ' ') FROM tbl_course_documents_list as cdl LEFT JOIN tbl_assignment_exams as ae ON ae.exam_code = cdl.file_path WHERE cdl.course_id = tbl_assignedusers.course_id AND cdl.type = 7 AND cdl.is_delete = 0)",
            ],
            'tbl_exam_attempts.exam_result' => [
                'raw_select' => "(SELECT GROUP_CONCAT(COALESCE((SELECT tea.exam_result FROM tbl_exam_attempts as tea WHERE tea.exam_id = ae.id AND tea.user_id = tbl_assignedusers.user_id AND tea.course_id = tbl_assignedusers.course_id AND tea.deleted_at IS NULL ORDER BY tea.id DESC LIMIT 1), 'Not Attempted') ORDER BY cdl.id SEPARATOR '<br>') FROM tbl_course_documents_list as cdl LEFT JOIN tbl_assignment_exams as ae ON ae.exam_code = cdl.file_path WHERE cdl.course_id = tbl_assignedusers.course_id AND cdl.type = 7 AND cdl.is_delete = 0)",
                'filter_sql' => "(SELECT GROUP_CONCAT(COALESCE((SELECT tea.exam_result FROM tbl_exam_attempts as tea WHERE tea.exam_id = ae.id AND tea.user_id = tbl_assignedusers.user_id AND tea.course_id = tbl_assignedusers.course_id AND tea.deleted_at IS NULL ORDER BY tea.id DESC LIMIT 1), 'Not Attempted') SEPARATOR ' ') FROM tbl_course_documents_list as cdl LEFT JOIN tbl_assignment_exams as ae ON ae.exam_code = cdl.file_path WHERE cdl.course_id = tbl_assignedusers.course_id AND cdl.type = 7 AND cdl.is_delete = 0)",
            ],
            'tbl_exam_attempts.exam_attend_date' => [
                'raw_select' => "(SELECT GROUP_CONCAT(COALESCE((SELECT DATE_FORMAT(tea.exam_attend_date, '%d-%b-%Y %h:%i %p') FROM tbl_exam_attempts as tea WHERE tea.exam_id = ae.id AND tea.user_id = tbl_assignedusers.user_id AND tea.course_id = tbl_assignedusers.course_id AND tea.deleted_at IS NULL ORDER BY tea.id DESC LIMIT 1), '-') ORDER BY cdl.id SEPARATOR '<br>') FROM tbl_course_documents_list as cdl LEFT JOIN tbl_assignment_exams as ae ON ae.exam_code = cdl.file_path WHERE cdl.course_id = tbl_assignedusers.course_id AND cdl.type = 7 AND cdl.is_delete = 0)",
            ],
            'tbl_exam_attempts.evaluation_completed_date' => [
                'raw_select' => "(SELECT GROUP_CONCAT(COALESCE((SELECT DATE_FORMAT(tea.evaluation_completed_date, '%d-%b-%Y %h:%i %p') FROM tbl_exam_attempts as tea WHERE tea.exam_id = ae.id AND tea.user_id = tbl_assignedusers.user_id AND tea.course_id = tbl_assignedusers.course_id AND tea.deleted_at IS NULL ORDER BY tea.id DESC LIMIT 1), '-') ORDER BY cdl.id SEPARATOR '<br>') FROM tbl_course_documents_list as cdl LEFT JOIN tbl_assignment_exams as ae ON ae.exam_code = cdl.file_path WHERE cdl.course_id = tbl_assignedusers.course_id AND cdl.type = 7 AND cdl.is_delete = 0)",
            ],

            // Videos & Course Content (type IN 1..5)
            'tbl_course_documents_list.type' => [
                'raw_select' => "(SELECT GROUP_CONCAT(CASE WHEN cdl.type = 1 THEN 'Amazon' WHEN cdl.type = 2 THEN 'YouTube' WHEN cdl.type = 3 THEN 'Local' WHEN cdl.type = 4 THEN 'SCORM' WHEN cdl.type = 5 THEN 'Attachments' ELSE '-' END ORDER BY cdl.id SEPARATOR '<br>') FROM tbl_course_documents_list as cdl WHERE cdl.course_id = tbl_assignedusers.course_id AND cdl.type IN (1, 2, 3, 4, 5) AND cdl.is_delete = 0)",
                'filter_sql' => "(SELECT GROUP_CONCAT(CASE WHEN cdl.type = 1 THEN 'Amazon' WHEN cdl.type = 2 THEN 'YouTube' WHEN cdl.type = 3 THEN 'Local' WHEN cdl.type = 4 THEN 'SCORM' WHEN cdl.type = 5 THEN 'Attachments' ELSE '-' END SEPARATOR ' ') FROM tbl_course_documents_list as cdl WHERE cdl.course_id = tbl_assignedusers.course_id AND cdl.type IN (1, 2, 3, 4, 5) AND cdl.is_delete = 0)",
            ],
            'tbl_course_documents_list.content_title' => [
                'raw_select' => "(SELECT GROUP_CONCAT(COALESCE(NULLIF(cdl.file_name, ''), NULLIF(cdl.org_file_name, ''), NULLIF(cdl.file_path, ''), 'File') ORDER BY cdl.id SEPARATOR '<br>') FROM tbl_course_documents_list as cdl WHERE cdl.course_id = tbl_assignedusers.course_id AND cdl.type IN (1, 2, 3, 4, 5) AND cdl.is_delete = 0)",
                'filter_sql' => "(SELECT GROUP_CONCAT(COALESCE(NULLIF(cdl.file_name, ''), NULLIF(cdl.org_file_name, ''), NULLIF(cdl.file_path, ''), 'File') SEPARATOR ' ') FROM tbl_course_documents_list as cdl WHERE cdl.course_id = tbl_assignedusers.course_id AND cdl.type IN (1, 2, 3, 4, 5) AND cdl.is_delete = 0)",
            ],
            'tbl_course_documents_list.org_file_name' => [
                'raw_select' => "(SELECT GROUP_CONCAT(COALESCE(NULLIF(cdl.org_file_name, ''), NULLIF(cdl.file_name, ''), '-') ORDER BY cdl.id SEPARATOR '<br>') FROM tbl_course_documents_list as cdl WHERE cdl.course_id = tbl_assignedusers.course_id AND cdl.type IN (1, 2, 3, 4, 5) AND cdl.is_delete = 0)",
                'filter_sql' => "(SELECT GROUP_CONCAT(COALESCE(NULLIF(cdl.org_file_name, ''), NULLIF(cdl.file_name, ''), '-') SEPARATOR ' ') FROM tbl_course_documents_list as cdl WHERE cdl.course_id = tbl_assignedusers.course_id AND cdl.type IN (1, 2, 3, 4, 5) AND cdl.is_delete = 0)",
            ],
            'tbl_assignedusers.progress_status' => [
                'raw_select' => (in_array('videos', $validKeys) && !in_array('enrollments', $validKeys) && !in_array('learners', $validKeys))
                    ? "(CASE WHEN tbl_assignedusers.status = 3 OR (EXISTS (SELECT 1 FROM tbl_assessment_video_access as ava WHERE ava.assign_id = tbl_assignedusers.id AND ava.completed_video_ids IS NOT NULL)) THEN 'Watched' ELSE 'Not Watched' END)"
                    : "(CASE WHEN tbl_assignedusers.status = 3 THEN 'Completed' WHEN tbl_courses.expiration_date IS NOT NULL AND tbl_courses.expiration_date < NOW() AND tbl_courses.expiration_date != '1970-01-01 00:00:00' THEN 'Expired' WHEN tbl_assignedusers.status = 1 THEN 'In Progress' ELSE 'Not Started' END)",
                'filter_sql' => (in_array('videos', $validKeys) && !in_array('enrollments', $validKeys) && !in_array('learners', $validKeys))
                    ? "(CASE WHEN tbl_assignedusers.status = 3 OR (EXISTS (SELECT 1 FROM tbl_assessment_video_access as ava WHERE ava.assign_id = tbl_assignedusers.id AND ava.completed_video_ids IS NOT NULL)) THEN 'Watched' ELSE 'Not Watched' END)"
                    : "(CASE WHEN tbl_assignedusers.status = 3 THEN 'Completed' WHEN tbl_courses.expiration_date IS NOT NULL AND tbl_courses.expiration_date < NOW() AND tbl_courses.expiration_date != '1970-01-01 00:00:00' THEN 'Expired' WHEN tbl_assignedusers.status = 1 THEN 'In Progress' ELSE 'Not Started' END)",
            ],
            'tbl_assignedusers.result' => [
                'raw_select' => "(CASE WHEN (SELECT tea.exam_result FROM tbl_exam_attempts as tea WHERE (tea.assigned_id = tbl_assignedusers.id OR (tea.user_id = tbl_assignedusers.user_id AND tea.course_id = tbl_assignedusers.course_id)) AND tea.deleted_at IS NULL ORDER BY tea.id DESC LIMIT 1) = 'Passed' THEN 'Pass' WHEN (SELECT tea.exam_result FROM tbl_exam_attempts as tea WHERE (tea.assigned_id = tbl_assignedusers.id OR (tea.user_id = tbl_assignedusers.user_id AND tea.course_id = tbl_assignedusers.course_id)) AND tea.deleted_at IS NULL ORDER BY tea.id DESC LIMIT 1) = 'Failed' THEN 'Fail' WHEN tbl_assignedusers.status = 3 THEN 'Pass' ELSE 'Not Attempted' END)",
                'filter_sql' => "(CASE WHEN (SELECT tea.exam_result FROM tbl_exam_attempts as tea WHERE (tea.assigned_id = tbl_assignedusers.id OR (tea.user_id = tbl_assignedusers.user_id AND tea.course_id = tbl_assignedusers.course_id)) AND tea.deleted_at IS NULL ORDER BY tea.id DESC LIMIT 1) = 'Passed' THEN 'Pass' WHEN (SELECT tea.exam_result FROM tbl_exam_attempts as tea WHERE (tea.assigned_id = tbl_assignedusers.id OR (tea.user_id = tbl_assignedusers.user_id AND tea.course_id = tbl_assignedusers.course_id)) AND tea.deleted_at IS NULL ORDER BY tea.id DESC LIMIT 1) = 'Failed' THEN 'Fail' WHEN tbl_assignedusers.status = 3 THEN 'Pass' ELSE 'Not Attempted' END)",
            ],

            // Certificates
            'tbl_certificates.certificate_name' => [
                'raw_select' => "(SELECT COALESCE(tc.certificate_name, '-') FROM tbl_certificates as tc WHERE tc.category_id = tbl_courses.category_id AND tc.deleted_at IS NULL ORDER BY tc.id DESC LIMIT 1)",
                'filter_sql' => "(SELECT COALESCE(tc.certificate_name, '-') FROM tbl_certificates as tc WHERE tc.category_id = tbl_courses.category_id AND tc.deleted_at IS NULL ORDER BY tc.id DESC LIMIT 1)",
            ],
            'tbl_certificates.code' => [
                'raw_select' => "(SELECT COALESCE(NULLIF(TRIM(REPLACE(REPLACE(REPLACE(REPLACE(tc.code, '<p>', ''), '</p>', ''), '\\r', ''), '\\n', '')), ''), '-') FROM tbl_certificates as tc WHERE tc.category_id = tbl_courses.category_id AND tc.deleted_at IS NULL ORDER BY tc.id DESC LIMIT 1)",
                'filter_sql' => "(SELECT COALESCE(NULLIF(TRIM(REPLACE(REPLACE(REPLACE(REPLACE(tc.code, '<p>', ''), '</p>', ''), '\\r', ''), '\\n', '')), ''), '-') FROM tbl_certificates as tc WHERE tc.category_id = tbl_courses.category_id AND tc.deleted_at IS NULL ORDER BY tc.id DESC LIMIT 1)",
            ],
            'tbl_certificates.status' => [
                'raw_select' => "(SELECT CASE WHEN tc.status = 1 THEN 'Active' ELSE 'Inactive' END FROM tbl_certificates as tc WHERE tc.category_id = tbl_courses.category_id AND tc.deleted_at IS NULL ORDER BY tc.id DESC LIMIT 1)",
                'filter_sql' => "(SELECT CASE WHEN tc.status = 1 THEN 'Active' ELSE 'Inactive' END FROM tbl_certificates as tc WHERE tc.category_id = tbl_courses.category_id AND tc.deleted_at IS NULL ORDER BY tc.id DESC LIMIT 1)",
            ],
            'tbl_certificates.signature_status' => [
                'raw_select' => "(SELECT CASE WHEN (tc.signature_image IS NOT NULL AND tc.signature_image != '') OR (tc.signature_drawn IS NOT NULL AND tc.signature_drawn != '') THEN 'Present' ELSE 'Not Present' END FROM tbl_certificates as tc WHERE tc.category_id = tbl_courses.category_id AND tc.deleted_at IS NULL ORDER BY tc.id DESC LIMIT 1)",
                'filter_sql' => "(SELECT CASE WHEN (tc.signature_image IS NOT NULL AND tc.signature_image != '') OR (tc.signature_drawn IS NOT NULL AND tc.signature_drawn != '') THEN 'Present' ELSE 'Not Present' END FROM tbl_certificates as tc WHERE tc.category_id = tbl_courses.category_id AND tc.deleted_at IS NULL ORDER BY tc.id DESC LIMIT 1)",
            ],
            'tbl_certificates.created_at' => [
                'raw_select' => "(SELECT DATE_FORMAT(tc.created_at, '%d-%b-%Y') FROM tbl_certificates as tc WHERE tc.category_id = tbl_courses.category_id AND tc.deleted_at IS NULL ORDER BY tc.id DESC LIMIT 1)",
            ],

            // Feedback & Ratings
            'tbl_feedback_ratings_settings.name' => [
                'raw_select' => "(SELECT COALESCE(fs.name, '-') FROM tbl_employee_feedback_ratings as ef LEFT JOIN tbl_feedback_ratings_settings as fs ON fs.id = ef.feedback_rating_setting_id WHERE ef.employee_id = tbl_assignedusers.user_id AND (ef.course_id = tbl_assignedusers.course_id OR ef.category_id = tbl_courses.category_id OR ef.type = 1) ORDER BY ef.id DESC LIMIT 1)",
                'filter_sql' => "(SELECT COALESCE(fs.name, '-') FROM tbl_employee_feedback_ratings as ef LEFT JOIN tbl_feedback_ratings_settings as fs ON fs.id = ef.feedback_rating_setting_id WHERE ef.employee_id = tbl_assignedusers.user_id AND (ef.course_id = tbl_assignedusers.course_id OR ef.category_id = tbl_courses.category_id OR ef.type = 1) ORDER BY ef.id DESC LIMIT 1)",
            ],
            'tbl_employee_feedback_ratings.type' => [
                'raw_select' => "(SELECT CASE WHEN ef.type = 1 THEN 'Overall' WHEN ef.type = 2 THEN 'Category' ELSE 'Overall' END FROM tbl_employee_feedback_ratings as ef WHERE ef.employee_id = tbl_assignedusers.user_id AND (ef.course_id = tbl_assignedusers.course_id OR ef.category_id = tbl_courses.category_id OR ef.type = 1) ORDER BY ef.id DESC LIMIT 1)",
                'filter_sql' => "(SELECT CASE WHEN ef.type = 1 THEN 'Overall' WHEN ef.type = 2 THEN 'Category' ELSE 'Overall' END FROM tbl_employee_feedback_ratings as ef WHERE ef.employee_id = tbl_assignedusers.user_id AND (ef.course_id = tbl_assignedusers.course_id OR ef.category_id = tbl_courses.category_id OR ef.type = 1) ORDER BY ef.id DESC LIMIT 1)",
            ],
            'tbl_employee_feedback_ratings.rating' => [
                'raw_select' => "(SELECT CASE WHEN ef.rating IS NOT NULL THEN CONCAT(ef.rating, ' ★') ELSE '-' END FROM tbl_employee_feedback_ratings as ef WHERE ef.employee_id = tbl_assignedusers.user_id AND (ef.course_id = tbl_assignedusers.course_id OR ef.category_id = tbl_courses.category_id OR ef.type = 1) ORDER BY ef.id DESC LIMIT 1)",
                'filter_sql' => "(SELECT ef.rating FROM tbl_employee_feedback_ratings as ef WHERE ef.employee_id = tbl_assignedusers.user_id AND (ef.course_id = tbl_assignedusers.course_id OR ef.category_id = tbl_courses.category_id OR ef.type = 1) ORDER BY ef.id DESC LIMIT 1)",
            ],
            'tbl_employee_feedback_ratings.feedback' => [
                'raw_select' => "(SELECT COALESCE(ef.feedback, '-') FROM tbl_employee_feedback_ratings as ef WHERE ef.employee_id = tbl_assignedusers.user_id AND (ef.course_id = tbl_assignedusers.course_id OR ef.category_id = tbl_courses.category_id OR ef.type = 1) ORDER BY ef.id DESC LIMIT 1)",
                'filter_sql' => "(SELECT COALESCE(ef.feedback, '-') FROM tbl_employee_feedback_ratings as ef WHERE ef.employee_id = tbl_assignedusers.user_id AND (ef.course_id = tbl_assignedusers.course_id OR ef.category_id = tbl_courses.category_id OR ef.type = 1) ORDER BY ef.id DESC LIMIT 1)",
            ],
            'tbl_employee_feedback_ratings.suggestions' => [
                'raw_select' => "(SELECT COALESCE(ef.suggestions, '-') FROM tbl_employee_feedback_ratings as ef WHERE ef.employee_id = tbl_assignedusers.user_id AND (ef.course_id = tbl_assignedusers.course_id OR ef.category_id = tbl_courses.category_id OR ef.type = 1) ORDER BY ef.id DESC LIMIT 1)",
                'filter_sql' => "(SELECT COALESCE(ef.suggestions, '-') FROM tbl_employee_feedback_ratings as ef WHERE ef.employee_id = tbl_assignedusers.user_id AND (ef.course_id = tbl_assignedusers.course_id OR ef.category_id = tbl_courses.category_id OR ef.type = 1) ORDER BY ef.id DESC LIMIT 1)",
            ],
            'tbl_employee_feedback_ratings.created_at' => [
                'raw_select' => "(SELECT DATE_FORMAT(ef.created_at, '%d-%b-%Y %h:%i %p') FROM tbl_employee_feedback_ratings as ef WHERE ef.employee_id = tbl_assignedusers.user_id AND (ef.course_id = tbl_assignedusers.course_id OR ef.category_id = tbl_courses.category_id OR ef.type = 1) ORDER BY ef.id DESC LIMIT 1)",
            ],

            // Overwrite joined tables whose single-source config had source-specific joins
            'tbl_courses.course_name' => [
                'raw_select' => "COALESCE(tbl_courses.course_name, '-')",
                'filter_sql' => "tbl_courses.course_name",
            ],
            'tbl_categories.category_name' => [
                'raw_select' => "COALESCE(tbl_categories.category_name, 'General')",
                'filter_sql' => "tbl_categories.category_name",
            ],
            'users.active' => [
                'raw_select' => "CASE WHEN users.deleted_at IS NOT NULL OR users.active = 2 OR users.deactivation_reason IS NOT NULL THEN 'Deactivated' WHEN users.active = 1 THEN 'Active' ELSE 'Inactive' END",
                'filter_sql' => "CASE WHEN users.deleted_at IS NOT NULL OR users.active = 2 OR users.deactivation_reason IS NOT NULL THEN 'Deactivated' WHEN users.active = 1 THEN 'Active' ELSE 'Inactive' END",
            ],
        ];

        foreach ($multiSourceExpressions as $exprKey => $exprDef) {
            if (isset($allowedFields[$exprKey])) {
                if (isset($exprDef['raw_select'])) {
                    $allowedFields[$exprKey]['raw_select'] = $exprDef['raw_select'];
                }
                if (isset($exprDef['filter_sql'])) {
                    $allowedFields[$exprKey]['filter_sql'] = $exprDef['filter_sql'];
                }
            }
        }

        // Relational Master Base: tbl_assignedusers connecting users, courses, departments, categories
        $query = DB::table('tbl_assignedusers')
            ->leftJoin('users', 'users.id', '=', 'tbl_assignedusers.user_id')
            ->leftJoin('departments', 'departments.id', '=', 'users.department')
            ->leftJoin('designations', 'designations.id', '=', 'users.designation')
            ->join('tbl_courses', function ($j) {
                $j->on('tbl_courses.id', '=', 'tbl_assignedusers.course_id')
                  ->whereNull('tbl_courses.deleted_at')
                  ->where(function ($q) {
                      $q->whereNull('tbl_courses.is_delete')->orWhere('tbl_courses.is_delete', 0);
                  });
            })
            ->leftJoin('tbl_categories', 'tbl_categories.id', '=', 'tbl_courses.category_id')
            ->leftJoin('tbl_groups', 'tbl_groups.id', '=', 'tbl_assignedusers.group_id')
            ->whereNull('tbl_assignedusers.deleted_at');

        // Dedicated Filters if respective source is present
        // 1. Assessment assignment filter
        if (in_array('assessments', $validKeys) && !empty($config['assessment_assignment_filter'])) {
            $assessFilter = strtolower(trim((string)$config['assessment_assignment_filter']));
            if ($assessFilter === 'assigned') {
                $query->whereNotExists(function ($q) {
                    $q->select(DB::raw(1))
                      ->from('tbl_course_assessment_result as car')
                      ->whereColumn('car.user_id', 'tbl_assignedusers.user_id')
                      ->whereNotNull('car.deleted_at');
                });
            } elseif ($assessFilter === 'reassigned') {
                $query->whereExists(function ($q) {
                    $q->select(DB::raw(1))
                      ->from('tbl_course_assessment_result as car')
                      ->whereColumn('car.user_id', 'tbl_assignedusers.user_id')
                      ->whereNotNull('car.deleted_at');
                });
            }
        }

        // 2. Video filters
        if (in_array('videos', $validKeys)) {
            if (!empty($config['video_watch_filter'])) {
                $vFilter = strtolower(trim((string)$config['video_watch_filter']));
                $watchExpr = "CASE WHEN tbl_assignedusers.status = 3 OR (EXISTS (SELECT 1 FROM tbl_assessment_video_access as ava WHERE ava.assign_id = tbl_assignedusers.id AND ava.completed_video_ids IS NOT NULL)) THEN 'Watched' ELSE 'Not Watched' END";
                if ($vFilter === 'watched') {
                    $query->whereRaw("({$watchExpr}) = 'Watched'");
                } elseif ($vFilter === 'not watched' || $vFilter === 'not_watched' || $vFilter === 'unwatched') {
                    $query->whereRaw("({$watchExpr}) = 'Not Watched'");
                }
            }
        }

        // 3. Exam filters
        if (in_array('exams', $validKeys) && !empty($config['exam_result_filter'])) {
            $examFilter = strtolower(trim((string)$config['exam_result_filter']));
            if ($examFilter === 'passed' || $examFilter === 'pass') {
                $query->whereExists(function ($q) {
                    $q->select(DB::raw(1))
                      ->from('tbl_exam_attempts as tea')
                      ->whereColumn('tea.user_id', 'tbl_assignedusers.user_id')
                      ->whereColumn('tea.course_id', 'tbl_assignedusers.course_id')
                      ->whereNull('tea.deleted_at')
                      ->whereRaw("TRIM(LOWER(tea.exam_result)) = 'passed'");
                });
            } elseif ($examFilter === 'failed' || $examFilter === 'fail') {
                $query->whereExists(function ($q) {
                    $q->select(DB::raw(1))
                      ->from('tbl_exam_attempts as tea')
                      ->whereColumn('tea.user_id', 'tbl_assignedusers.user_id')
                      ->whereColumn('tea.course_id', 'tbl_assignedusers.course_id')
                      ->whereNull('tea.deleted_at')
                      ->whereRaw("TRIM(LOWER(tea.exam_result)) = 'failed'");
                });
            } elseif ($examFilter === 'not attempted' || $examFilter === 'not_attempted') {
                $query->whereNotExists(function ($q) {
                    $q->select(DB::raw(1))
                      ->from('tbl_exam_attempts as tea')
                      ->whereColumn('tea.user_id', 'tbl_assignedusers.user_id')
                      ->whereColumn('tea.course_id', 'tbl_assignedusers.course_id')
                      ->whereNull('tea.deleted_at');
                });
            }
        }

        // 4. Feedback filter
        if (in_array('feedback', $validKeys) && !empty($config['feedback_type_filter'])) {
            $fbFilter = strtolower(trim((string)$config['feedback_type_filter']));
            if ($fbFilter === 'overall') {
                $query->whereExists(function ($q) {
                    $q->select(DB::raw(1))
                      ->from('tbl_employee_feedback_ratings as ef')
                      ->whereColumn('ef.employee_id', 'tbl_assignedusers.user_id')
                      ->where('ef.type', 1);
                });
            } elseif ($fbFilter === 'category') {
                $query->whereExists(function ($q) {
                    $q->select(DB::raw(1))
                      ->from('tbl_employee_feedback_ratings as ef')
                      ->whereColumn('ef.employee_id', 'tbl_assignedusers.user_id')
                      ->where('ef.type', 2);
                });
            }
        }

        // 5. Universal Course filter
        if (!empty($config['course_filter']) && $config['course_filter'] !== 'all' && $config['course_filter'] !== 'Total' && $config['course_filter'] !== '') {
            $courseVal = $config['course_filter'];
            if (is_numeric($courseVal)) {
                $query->where('tbl_assignedusers.course_id', $courseVal);
            } else {
                $query->where(function ($q) use ($courseVal) {
                    $q->where('tbl_courses.course_name', 'LIKE', "%{$courseVal}%")
                      ->orWhere('tbl_courses.course_code', 'LIKE', "%{$courseVal}%");
                });
            }
        }

        // 6. Universal Learner filter
        if (!empty($config['learner_filter']) && $config['learner_filter'] !== 'all' && $config['learner_filter'] !== 'Total' && $config['learner_filter'] !== '') {
            $learnerVal = $config['learner_filter'];
            if (is_numeric($learnerVal)) {
                $query->where('tbl_assignedusers.user_id', $learnerVal);
            } else {
                $query->where(function ($q) use ($learnerVal) {
                    $q->where('users.first_name', 'LIKE', "%{$learnerVal}%")
                      ->orWhere('users.last_name', 'LIKE', "%{$learnerVal}%")
                      ->orWhere('users.email', 'LIKE', "%{$learnerVal}%")
                      ->orWhere('users.emp_id', 'LIKE', "%{$learnerVal}%");
                });
            }
        }

        // 6b. User Status Filter (Active / Inactive)
        if (isset($config['user_status_filter']) && $config['user_status_filter'] !== 'all' && $config['user_status_filter'] !== '') {
            $uStatusVal = (string)$config['user_status_filter'];
            if ($uStatusVal === '1' || $uStatusVal === 'active') {
                $query->where('users.active', 1)->whereNull('users.deleted_at');
            } elseif ($uStatusVal === '0' || $uStatusVal === 'inactive') {
                $query->where('users.active', 0)->whereNull('users.deleted_at')->whereNull('users.deactivation_reason');
            } elseif ($uStatusVal === '2' || $uStatusVal === 'deactivated') {
                $query->where(function ($q) {
                    $q->whereNotNull('users.deleted_at')
                      ->orWhere('users.active', 2)
                      ->orWhereNotNull('users.deactivation_reason');
                });
            }
        }

        // 6bb. Course Active Status Filter (All Courses, Active Courses Only, Inactive Courses Only)
        if (isset($config['course_active_filter']) && $config['course_active_filter'] !== 'all' && $config['course_active_filter'] !== '') {
            $cActiveVal = (string)$config['course_active_filter'];
            if ($cActiveVal === '1' || $cActiveVal === 'active') {
                $query->where('tbl_courses.active', 1);
            } elseif ($cActiveVal === '0' || $cActiveVal === 'inactive') {
                $query->where(function ($q) {
                    $q->where('tbl_courses.active', 0)->orWhereNull('tbl_courses.active');
                });
            }
        }

        // 6c. Department Filter
        if (!empty($config['department_filter']) && $config['department_filter'] !== 'all' && $config['department_filter'] !== '') {
            $deptVal = $config['department_filter'];
            if (is_numeric($deptVal)) {
                $query->where('users.department', $deptVal);
            } else {
                $query->where('departments.department_name', 'LIKE', "%{$deptVal}%");
            }
        }

        // 6d. Designation Filter
        if (!empty($config['designation_filter']) && $config['designation_filter'] !== 'all' && $config['designation_filter'] !== '') {
            $desigVal = $config['designation_filter'];
            if (is_numeric($desigVal)) {
                $query->where('users.designation', $desigVal);
            } else {
                $query->where('designations.designation_name', 'LIKE', "%{$desigVal}%");
            }
        }

        // 7. Date range filter
        $dateFrom = $config['date_from'] ?? null;
        $dateTo = $config['date_to'] ?? null;
        if (!empty($dateFrom) && !empty($dateTo)) {
            $query->whereBetween('tbl_assignedusers.created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59']);
        } elseif (!empty($dateFrom)) {
            $query->where('tbl_assignedusers.created_at', '>=', $dateFrom . ' 00:00:00');
        } elseif (!empty($dateTo)) {
            $query->where('tbl_assignedusers.created_at', '<=', $dateTo . ' 23:59:59');
        }

        // 8. Universal Status filter
        if (!empty($config['status_filter']) && $config['status_filter'] !== 'all' && $config['status_filter'] !== 'Total' && $config['status_filter'] !== '') {
            $statusVal = strtolower(trim((string)$config['status_filter']));
            if ($statusVal === 'completed' || $statusVal === '3') {
                $query->where('tbl_assignedusers.status', 3);
            } elseif ($statusVal === 'in_progress' || $statusVal === 'in progress' || $statusVal === 'progress' || $statusVal === 'incomplete' || $statusVal === '1') {
                $query->where('tbl_assignedusers.status', 1)
                      ->where(function ($q) {
                          $q->whereNull('tbl_courses.expiration_date')
                            ->orWhere('tbl_courses.expiration_date', '>=', now())
                            ->orWhere('tbl_courses.expiration_date', '=', '1970-01-01 00:00:00');
                      });
            } elseif ($statusVal === 'not_started' || $statusVal === 'not started' || $statusVal === 'pending' || $statusVal === '0') {
                $query->where(function ($q) {
                    $q->whereIn('tbl_assignedusers.status', [0, 2])
                      ->orWhereNull('tbl_assignedusers.status');
                })->where(function ($q) {
                    $q->whereNull('tbl_courses.expiration_date')
                      ->orWhere('tbl_courses.expiration_date', '>=', now())
                      ->orWhere('tbl_courses.expiration_date', '=', '1970-01-01 00:00:00');
                });
            } elseif ($statusVal === 'expired') {
                $query->where('tbl_assignedusers.status', '!=', 3)
                      ->whereNotNull('tbl_courses.expiration_date')
                      ->where('tbl_courses.expiration_date', '<', now())
                      ->where('tbl_courses.expiration_date', '!=', '1970-01-01 00:00:00');
            }
        }

        // 9. Custom Field Filters from config['filters']
        if (!empty($config['filters']) && is_array($config['filters'])) {
            foreach ($config['filters'] as $fRule) {
                if (empty($fRule['field']) || (!isset($fRule['value']) && empty($fRule['value_to']))) {
                    continue;
                }
                $fieldKey = $fRule['field'];
                $val = trim((string)($fRule['value'] ?? ''));
                $valTo = trim((string)($fRule['value_to'] ?? ''));
                $fieldDef = $allowedFields[$fieldKey] ?? [];

                if ($val === '' && $valTo === '') {
                    continue;
                }

                $filterCol = !empty($fieldDef['filter_sql']) ? DB::raw("({$fieldDef['filter_sql']})") : $fieldKey;

                if (!empty($fieldDef['type']) && $fieldDef['type'] === 'date') {
                    if ($val !== '' && $valTo !== '') {
                        $query->whereBetween($filterCol, [$val . ' 00:00:00', $valTo . ' 23:59:59']);
                    } elseif ($val !== '') {
                        $query->where($filterCol, '>=', $val . ' 00:00:00');
                    } elseif ($valTo !== '') {
                        $query->where($filterCol, '<=', $valTo . ' 23:59:59');
                    }
                } elseif (!empty($fieldDef['type']) && $fieldDef['type'] === 'select') {
                    if ($val !== 'all' && $val !== 'Total' && $val !== '') {
                        $query->where($filterCol, '=', $val);
                    }
                } else {
                    $query->where($filterCol, 'LIKE', "%{$val}%");
                }
            }
        }

        // Selected Fields (exclude any technical ID columns)
        $selectedFields = $config['fields'] ?? ($config['selected_fields'] ?? []);
        if (empty($selectedFields)) {
            $selectedFields = array_keys(array_filter($allowedFields, function ($f, $k) {
                return !empty($f['default']) && !$this->isTechnicalIdField($k, $f);
            }, ARRAY_FILTER_USE_BOTH));
            if (count($selectedFields) > 12) {
                $selectedFields = array_slice($selectedFields, 0, 12);
            }
            // Ordering priorities for default selected columns
            $multiPriority = function ($field) {
                if ($field === 'users.first_name') return 1;
                if ($field === 'users.last_name') return 2;
                if ($field === 'users.email') return 3;
                if ($field === 'users.emp_id') return 4;
                if ($field === 'departments.department_name') return 5;
                if ($field === 'designations.designation_name') return 6;
                if ($field === 'users.active') return 7;
                if ($field === 'tbl_courses.course_name') return 10;
                if ($field === 'tbl_courses.course_code') return 11;
                if ($field === 'tbl_categories.category_name') return 12;
                if ($field === 'tbl_courses.expiration_date') return 13;
                if ($field === 'tbl_courses.points') return 14;
                if ($field === 'tbl_assignedusers.created_at') return 20;
                if ($field === 'tbl_assignedusers.progress_status') return 21;
                if ($field === 'tbl_assignedusers.start_date') return 22;
                if ($field === 'tbl_assignedusers.completed_on') return 23;
                if ($field === 'tbl_assignedusers.result') return 24;
                if ($field === 'tbl_course_documents_list.file_name') return 30;
                if ($field === 'tbl_course_assessment_result.score') return 31;
                if ($field === 'tbl_course_assessment_result.percentage') return 32;
                if ($field === 'tbl_course_assessment_result.pass_fail') return 33;
                if ($field === 'tbl_course_assessment_result.time_spent') return 34;
                if ($field === 'tbl_course_assessment_result.status') return 35;
                if ($field === 'tbl_assignment_exams.name') return 40;
                if ($field === 'tbl_exam_attempts.exam_result') return 41;
                if ($field === 'tbl_exam_attempts.exam_attend_date') return 42;
                if ($field === 'tbl_exam_attempts.evaluation_completed_date') return 43;
                if ($field === 'tbl_course_documents_list.type') return 50;
                if ($field === 'tbl_employee_feedback_ratings.rating') return 60;
                if ($field === 'tbl_employee_feedback_ratings.feedback') return 61;
                if ($field === 'tbl_certificates.certificate_name') return 70;
                if ($field === 'tbl_certificates.code') return 71;
                return 80;
            };
            usort($selectedFields, function ($a, $b) use ($multiPriority) {
                return $multiPriority($a) <=> $multiPriority($b);
            });
        } else {
            // Strictly preserve the exact user selection order
            $validSelected = [];
            foreach ($selectedFields as $fKey) {
                if (isset($allowedFields[$fKey]) && !$this->isTechnicalIdField($fKey, $allowedFields[$fKey])) {
                    if (!in_array($fKey, $validSelected)) {
                        $validSelected[] = $fKey;
                    }
                }
            }
            $selectedFields = $validSelected;
        }

        // Grouping & Aggregations
        $groupBy = $config['group_by'] ?? null;
        if ($groupBy === 'none_individual' || $groupBy === 'none' || $groupBy === '') {
            $groupBy = null;
        }

        $calculation = $config['calculation'] ?? null;
        $aggType = !empty($calculation['type']) ? strtoupper(trim($calculation['type'])) : 'COUNT';

        if (!empty($groupBy) && isset($allowedFields[$groupBy])) {
            $groupFieldDef = $allowedFields[$groupBy];
            if (!empty($groupFieldDef['raw_select'])) {
                $groupExpr = "({$groupFieldDef['raw_select']})";
            } elseif (!empty($groupFieldDef['is_name'])) {
                $tableAlias = explode('.', $groupBy)[0];
                $groupExpr = "TRIM(CONCAT({$tableAlias}.first_name, ' ', COALESCE({$tableAlias}.last_name, '')))";
            } else {
                $groupExpr = $groupBy;
            }

            if ($aggType === 'COUNT_PASSED') {
                $calcExpr = "SUM(CASE WHEN tbl_assignedusers.status = 3 THEN 1 ELSE 0 END)";
            } elseif ($aggType === 'COUNT_FAILED') {
                $calcExpr = "SUM(CASE WHEN tbl_assignedusers.status = 1 AND tbl_courses.expiration_date < NOW() THEN 1 ELSE 0 END)";
            } else {
                $calcExpr = "COUNT(*)";
            }

            $query->selectRaw("{$groupExpr} as group_label, {$calcExpr} as calc_val");
            $query->groupBy(DB::raw('group_label'));
        } else {
            // Standard column selections
            $selects = [];
            foreach ($selectedFields as $f) {
                $alias = str_replace('.', '__', $f);
                $fieldDef = $allowedFields[$f] ?? [];

                if (!empty($fieldDef['raw_select'])) {
                    $rawSelectExpr = $fieldDef['raw_select'];
                    $selects[] = "({$rawSelectExpr}) as {$alias}";
                } elseif (!empty($fieldDef['is_name'])) {
                    $tableAlias = explode('.', $f)[0];
                    $selects[] = "TRIM(CONCAT({$tableAlias}.first_name, ' ', COALESCE({$tableAlias}.last_name, ''))) as {$alias}";
                } else {
                    $selects[] = "{$f} as {$alias}";
                }
            }

            if (!empty($selects)) {
                $query->selectRaw(implode(', ', $selects));
            }
        }

        // Apply Sorting
        $sortField = $config['sort_field'] ?? null;
        $sortDir = strtolower($config['sort_direction'] ?? 'desc');
        if (!in_array($sortDir, ['asc', 'desc'])) {
            $sortDir = 'desc';
        }

        if (!empty($groupBy) && isset($allowedFields[$groupBy])) {
            // When grouped by a field with calculation, MySQL ONLY_FULL_GROUP_BY requires ordering by aggregate or group expression
            if ($sortField === 'group_label' || $sortField === $groupBy) {
                $query->orderBy('group_label', $sortDir);
            } else {
                $query->orderBy('calc_val', $sortDir);
            }
        } elseif (!empty($sortField) && isset($allowedFields[$sortField])) {
            $fieldDef = $allowedFields[$sortField];
            if (!empty($fieldDef['raw_select'])) {
                $query->orderBy(DB::raw("({$fieldDef['raw_select']})"), $sortDir);
            } elseif (!empty($fieldDef['is_name'])) {
                $tableAlias = explode('.', $sortField)[0];
                $query->orderBy(DB::raw("CONCAT({$tableAlias}.first_name, ' ', COALESCE({$tableAlias}.last_name, ''))"), $sortDir);
            } else {
                $query->orderBy($sortField, $sortDir);
            }
        } else {
            $query->orderBy('tbl_assignedusers.id', 'desc');
        }

        $compositeSource = [
            'label' => 'Multi-Source Composite Report',
            'fields' => $allowedFields,
        ];

        return [
            'query' => $query,
            'source' => $compositeSource,
            'selected_fields' => $selectedFields,
            'group_by' => $groupBy,
            'calculation' => $calculation,
            'field_defs' => $allowedFields,
        ];
    }

    /**
     * Build the query for given configuration safely.
     */
    public function buildQuery($sourceKey, array $config)
    {
        // Detect multi-source configuration
        $selectedSources = $config['data_sources'] ?? null;
        if (empty($selectedSources)) {
            if (is_array($sourceKey)) {
                $selectedSources = $sourceKey;
            } elseif (is_string($sourceKey) && str_contains($sourceKey, ',')) {
                $selectedSources = array_filter(array_map('trim', explode(',', $sourceKey)));
            }
        }

        if (is_array($selectedSources) && count($selectedSources) > 1) {
            return $this->buildMultiSourceQuery($selectedSources, $config);
        }

        if (is_array($selectedSources) && count($selectedSources) === 1) {
            $sourceKey = $selectedSources[0];
        }

        $sources = $this->getDataSources();
        if (!isset($sources[$sourceKey])) {
            throw new \InvalidArgumentException("Invalid data source: {$sourceKey}");
        }

        $source = $sources[$sourceKey];
        $query = DB::table($source['table']);

        // Apply Joins
        if (!empty($source['joins'])) {
            foreach ($source['joins'] as $join) {
                $joinType = $join['type'] ?? 'leftJoin';
                if ($join['table'] === 'tbl_courses') {
                    $query->$joinType('tbl_courses', function ($j) use ($join) {
                        $j->on($join['first'], $join['operator'] ?? '=', $join['second'])
                          ->whereNull('tbl_courses.deleted_at')
                          ->where(function ($q) {
                              $q->whereNull('tbl_courses.is_delete')->orWhere('tbl_courses.is_delete', 0);
                          });
                    });
                } else {
                    $query->$joinType($join['table'], $join['first'], $join['operator'] ?? '=', $join['second']);
                }
            }
        }

        // Apply base conditions
        if (!empty($source['conditions'])) {
            foreach ($source['conditions'] as $cond) {
                if (isset($cond[1]) && strtoupper($cond[1]) === 'IS NULL') {
                    $query->whereNull($cond[0]);
                } elseif (isset($cond[1]) && strtoupper($cond[1]) === 'IS NOT NULL') {
                    $query->whereNotNull($cond[0]);
                } elseif (isset($cond[1]) && strtoupper($cond[1]) === 'IN' && is_array($cond[2])) {
                    $query->whereIn($cond[0], $cond[2]);
                } elseif (isset($cond[1]) && strtoupper($cond[1]) === 'NOT IN' && is_array($cond[2])) {
                    $query->whereNotIn($cond[0], $cond[2]);
                } elseif (count($cond) === 3) {
                    $query->where($cond[0], $cond[1], $cond[2]);
                }
            }
        }

        // Strictly exclude soft-deleted and trashed data across all primary tables
        if ($source['table'] === 'tbl_courses') {
            $query->whereNull('tbl_courses.deleted_at')
                  ->where(function ($q) {
                      $q->whereNull('tbl_courses.is_delete')->orWhere('tbl_courses.is_delete', 0);
                  });
        } elseif ($source['table'] === 'tbl_certificates') {
            $query->whereNull('tbl_certificates.deleted_at');
        } elseif ($source['table'] === 'tbl_assignedusers') {
            $query->whereNull('tbl_assignedusers.deleted_at');
            if ($sourceKey === 'enrollments') {
                $query->whereNotNull('tbl_courses.id')
                      ->whereNull('tbl_courses.deleted_at')
                      ->where(function ($q) {
                          $q->whereNull('tbl_courses.is_delete')->orWhere('tbl_courses.is_delete', 0);
                      });
            }
        } elseif ($source['table'] === 'tbl_course_documents_list') {
            $query->where('tbl_course_documents_list.is_delete', 0);
            if (in_array($sourceKey, ['assessments', 'exams', 'videos'])) {
                $query->whereNotNull('tbl_courses.id')
                      ->whereNull('tbl_courses.deleted_at')
                      ->where(function ($q) {
                          $q->whereNull('tbl_courses.is_delete')->orWhere('tbl_courses.is_delete', 0);
                      });
            }
        }

        // Dedicated Assessment Filter (Total, Assigned, Reassigned)
        if ($sourceKey === 'assessments' && !empty($config['assessment_assignment_filter'])) {
            $assessFilter = strtolower(trim((string)$config['assessment_assignment_filter']));
            if ($assessFilter === 'assigned') {
                $query->whereNotExists(function ($q) {
                    $q->select(DB::raw(1))
                      ->from('tbl_course_assessment_result as car')
                      ->whereColumn('car.user_id', 'tbl_assignedusers.user_id')
                      ->whereColumn('car.course_document_id', 'tbl_course_documents_list.id')
                      ->whereNotNull('car.deleted_at');
                });
            } elseif ($assessFilter === 'reassigned') {
                $query->whereExists(function ($q) {
                    $q->select(DB::raw(1))
                      ->from('tbl_course_assessment_result as car')
                      ->whereColumn('car.user_id', 'tbl_assignedusers.user_id')
                      ->whereColumn('car.course_document_id', 'tbl_course_documents_list.id')
                      ->whereNotNull('car.deleted_at');
                });
            }
        }

        // Dedicated Assessment Status & Result Filter (Total, Not Started, In Progress, Completed, Pending, Passed, Failed)
        if ($sourceKey === 'assessments' && !empty($config['assessment_status_filter'])) {
            $statusFilter = strtolower(trim((string)$config['assessment_status_filter']));
            if ($statusFilter === 'not started' || $statusFilter === 'not_started' || $statusFilter === 'not attempted') {
                $query->whereNull('tbl_course_assessment_result.id');
            } elseif ($statusFilter === 'in progress' || $statusFilter === 'in_progress' || $statusFilter === 'progress') {
                $query->whereNotNull('tbl_course_assessment_result.id')
                      ->whereNull('tbl_course_assessment_result.completed_at')
                      ->whereRaw("COALESCE(JSON_UNQUOTE(JSON_EXTRACT(tbl_course_assessment_result.results, '$.pass_or_fail')), '') NOT IN ('Passed', 'Failed')");
            } elseif ($statusFilter === 'completed') {
                $query->whereNotNull('tbl_course_assessment_result.id')
                      ->where(function ($q) {
                          $q->whereNotNull('tbl_course_assessment_result.completed_at')
                            ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(tbl_course_assessment_result.results, '$.pass_or_fail')) IN ('Passed', 'Failed')");
                      });
            } elseif ($statusFilter === 'pending') {
                $query->whereNotNull('tbl_course_assessment_result.id')
                      ->whereRaw("TRIM(LOWER(JSON_UNQUOTE(JSON_EXTRACT(tbl_course_assessment_result.results, '$.pass_or_fail')))) = 'pending'");
            } elseif ($statusFilter === 'passed' || $statusFilter === 'pass') {
                $query->whereNotNull('tbl_course_assessment_result.id')
                      ->whereRaw("TRIM(LOWER(JSON_UNQUOTE(JSON_EXTRACT(tbl_course_assessment_result.results, '$.pass_or_fail')))) = 'passed'");
            } elseif ($statusFilter === 'failed' || $statusFilter === 'fail') {
                $query->whereNotNull('tbl_course_assessment_result.id')
                      ->whereRaw("TRIM(LOWER(JSON_UNQUOTE(JSON_EXTRACT(tbl_course_assessment_result.results, '$.pass_or_fail')))) = 'failed'");
            }
        }

        // Dedicated Video Watch Status Filter (Total, Watched, Not Watched)
        if ($sourceKey === 'videos' && !empty($config['video_watch_filter'])) {
            $vFilter = strtolower(trim((string)$config['video_watch_filter']));
            $watchExpr = "CASE WHEN tbl_assignedusers.status = 3 OR (tbl_assessment_video_access.completed_video_ids IS NOT NULL AND JSON_CONTAINS(tbl_assessment_video_access.completed_video_ids, CAST(tbl_course_documents_list.id AS CHAR))) THEN 'Watched' ELSE 'Not Watched' END";
            if ($vFilter === 'watched') {
                $query->whereRaw("({$watchExpr}) = 'Watched'");
            } elseif ($vFilter === 'not watched' || $vFilter === 'not_watched' || $vFilter === 'unwatched') {
                $query->whereRaw("({$watchExpr}) = 'Not Watched'");
            }
        }

        // Dedicated Video Type Filter (1=>Amazon, 2=>YouTube, 3=>Local, 4=>SCORM, 5=>Attachments)
        if ($sourceKey === 'videos' && !empty($config['video_type_filter'])) {
            $vtFilter = strtolower(trim((string)$config['video_type_filter']));
            if ($vtFilter === 'all' || $vtFilter === 'total' || $vtFilter === '') {
                // No filtering
            } elseif ($vtFilter === '1' || $vtFilter === 'amazon' || str_contains($vtFilter, 'amazon')) {
                $query->where('tbl_course_documents_list.type', 1);
            } elseif ($vtFilter === '2' || $vtFilter === 'youtube' || str_contains($vtFilter, 'youtube')) {
                $query->where('tbl_course_documents_list.type', 2);
            } elseif ($vtFilter === '3' || $vtFilter === 'local' || str_contains($vtFilter, 'local')) {
                $query->where('tbl_course_documents_list.type', 3);
            } elseif ($vtFilter === '4' || $vtFilter === 'scorm' || str_contains($vtFilter, 'scorm')) {
                $query->where('tbl_course_documents_list.type', 4);
            } elseif ($vtFilter === '5' || $vtFilter === 'attachment' || $vtFilter === 'attachments' || str_contains($vtFilter, 'attachment')) {
                $query->where('tbl_course_documents_list.type', 5);
            }
        }

        // Dedicated Assignment Exam Result Filter (Total, Passed, Failed, Pending, Not Attempted)
        if ($sourceKey === 'exams' && !empty($config['exam_result_filter'])) {
            $examFilter = strtolower(trim((string)$config['exam_result_filter']));
            if ($examFilter === 'passed' || $examFilter === 'pass') {
                $query->whereRaw("TRIM(LOWER(tbl_exam_attempts.exam_result)) = 'passed'");
            } elseif ($examFilter === 'failed' || $examFilter === 'fail') {
                $query->whereRaw("TRIM(LOWER(tbl_exam_attempts.exam_result)) = 'failed'");
            } elseif ($examFilter === 'pending' || $examFilter === 'pending evaluation') {
                $query->whereNotNull('tbl_exam_attempts.id')
                      ->whereRaw("TRIM(LOWER(tbl_exam_attempts.exam_result)) = 'pending'");
            } elseif ($examFilter === 'not attempted' || $examFilter === 'not_attempted' || $examFilter === 'not_started') {
                $query->whereNull('tbl_exam_attempts.id');
            }
        }

        // Filter by Course (Dropdown or Search)
        if (!empty($config['course_filter']) && $config['course_filter'] !== 'all' && $config['course_filter'] !== 'Total' && $config['course_filter'] !== '') {
            $courseVal = $config['course_filter'];
            if (is_numeric($courseVal)) {
                if ($sourceKey === 'courses') {
                    $query->where('tbl_courses.id', $courseVal);
                } elseif ($sourceKey === 'feedback') {
                    $query->where('tbl_employee_feedback_ratings.course_id', $courseVal);
                } elseif ($sourceKey === 'exams') {
                    $query->where('tbl_courses.id', $courseVal);
                } elseif ($sourceKey === 'videos' || $sourceKey === 'assessments' || $sourceKey === 'enrollments') {
                    $query->where(function ($q) use ($courseVal) {
                        $q->where('tbl_courses.id', $courseVal)
                          ->orWhere('tbl_assignedusers.course_id', $courseVal);
                    });
                } else {
                    $query->where('tbl_courses.id', $courseVal);
                }
            } else {
                $query->where('tbl_courses.course_name', 'LIKE', "%{$courseVal}%");
            }
        }

        // Filter by Specific Learner / User (Dropdown or Search)
        if (!empty($config['learner_filter']) && $config['learner_filter'] !== 'all' && $config['learner_filter'] !== 'Total' && $config['learner_filter'] !== '') {
            $learnerVal = $config['learner_filter'];
            if ($sourceKey === 'certificates') {
                // Certificates template catalog does not filter by user
            } elseif (is_numeric($learnerVal)) {
                if ($sourceKey === 'learners') {
                    $query->where('users.id', $learnerVal);
                } elseif ($sourceKey === 'feedback') {
                    $query->where('tbl_employee_feedback_ratings.employee_id', $learnerVal);
                } elseif ($sourceKey === 'training_matrix') {
                    $query->whereExists(function ($q) use ($learnerVal) {
                        $q->select(DB::raw(1))->from('users')->whereColumn('users.department', 'departments.id')->where('users.id', $learnerVal);
                    });
                } elseif ($sourceKey === 'courses') {
                    $query->whereExists(function ($q) use ($learnerVal) {
                        $q->select(DB::raw(1))->from('tbl_assignedusers')->whereColumn('tbl_assignedusers.course_id', 'tbl_courses.id')->where('tbl_assignedusers.user_id', $learnerVal)->whereNull('tbl_assignedusers.deleted_at');
                    });
                } else {
                    $query->where('users.id', $learnerVal);
                }
            } else {
                if ($sourceKey === 'training_matrix') {
                    $query->whereExists(function ($q) use ($learnerVal) {
                        $q->select(DB::raw(1))->from('users')->whereColumn('users.department', 'departments.id')
                          ->where(function ($uq) use ($learnerVal) {
                              $uq->where('users.first_name', 'LIKE', "%{$learnerVal}%")
                                ->orWhere('users.last_name', 'LIKE', "%{$learnerVal}%")
                                ->orWhere('users.email', 'LIKE', "%{$learnerVal}%")
                                ->orWhere('users.emp_id', 'LIKE', "%{$learnerVal}%");
                          });
                    });
                } elseif ($sourceKey === 'courses') {
                    $query->whereExists(function ($q) use ($learnerVal) {
                        $q->select(DB::raw(1))->from('tbl_assignedusers')->join('users as u2', 'u2.id', '=', 'tbl_assignedusers.user_id')
                          ->whereColumn('tbl_assignedusers.course_id', 'tbl_courses.id')
                          ->whereNull('tbl_assignedusers.deleted_at')
                          ->where(function ($uq) use ($learnerVal) {
                              $uq->where('u2.first_name', 'LIKE', "%{$learnerVal}%")
                                ->orWhere('u2.last_name', 'LIKE', "%{$learnerVal}%")
                                ->orWhere('u2.email', 'LIKE', "%{$learnerVal}%")
                                ->orWhere('u2.emp_id', 'LIKE', "%{$learnerVal}%");
                          });
                    });
                } else {
                    $query->where(function ($q) use ($learnerVal) {
                        $q->where('users.first_name', 'LIKE', "%{$learnerVal}%")
                          ->orWhere('users.last_name', 'LIKE', "%{$learnerVal}%")
                          ->orWhere('users.email', 'LIKE', "%{$learnerVal}%")
                          ->orWhere('users.emp_id', 'LIKE', "%{$learnerVal}%");
                    });
                }
            }
        }

        // Filter by User Status (Active / Inactive / Deactivated)
        if (isset($config['user_status_filter']) && $config['user_status_filter'] !== 'all' && $config['user_status_filter'] !== '') {
            $uStatusVal = (string)$config['user_status_filter'];
            if ($sourceKey === 'courses') {
                $query->whereExists(function ($q) use ($uStatusVal) {
                    $q->select(DB::raw(1))->from('tbl_assignedusers')
                      ->join('users', 'users.id', '=', 'tbl_assignedusers.user_id')
                      ->whereColumn('tbl_assignedusers.course_id', 'tbl_courses.id')
                      ->where(function ($sub) use ($uStatusVal) {
                          if ($uStatusVal === '1' || $uStatusVal === 'active') {
                              $sub->where('users.active', 1)->whereNull('users.deleted_at');
                          } elseif ($uStatusVal === '0' || $uStatusVal === 'inactive') {
                              $sub->where(function ($sq) {
                                  $sq->where('users.active', 0)->orWhereNull('users.active');
                              })->whereNull('users.deleted_at')->whereNull('users.deactivation_reason');
                          } elseif ($uStatusVal === '2' || $uStatusVal === 'deactivated') {
                              $sub->where(function ($dq) {
                                  $dq->whereNotNull('users.deleted_at')
                                     ->orWhere('users.active', 2)
                                     ->orWhereNotNull('users.deactivation_reason');
                              });
                          }
                      })
                      ->whereNull('tbl_assignedusers.deleted_at');
                });
            } elseif ($sourceKey === 'training_matrix') {
                // Training matrix displays department level totals
            } elseif ($sourceKey !== 'certificates') {
                if ($uStatusVal === '1' || $uStatusVal === 'active') {
                    $query->where('users.active', 1)->whereNull('users.deleted_at');
                } elseif ($uStatusVal === '0' || $uStatusVal === 'inactive') {
                    $query->where(function ($q) {
                        $q->where('users.active', 0)->orWhereNull('users.active');
                    })->whereNull('users.deleted_at')->whereNull('users.deactivation_reason');
                } elseif ($uStatusVal === '2' || $uStatusVal === 'deactivated') {
                    $query->where(function ($q) {
                        $q->whereNotNull('users.deleted_at')
                          ->orWhere('users.active', 2)
                          ->orWhereNotNull('users.deactivation_reason');
                    });
                }
            }
        }

        // Filter by Course Active Status (Active / Inactive Courses)
        if (isset($config['course_active_filter']) && $config['course_active_filter'] !== 'all' && $config['course_active_filter'] !== '') {
            $cActiveVal = (string)$config['course_active_filter'];
            $cActiveInt = ($cActiveVal === '1' || $cActiveVal === 'active') ? 1 : (($cActiveVal === '0' || $cActiveVal === 'inactive') ? 0 : null);
            if ($cActiveInt !== null) {
                if ($sourceKey === 'courses') {
                    if ($cActiveInt === 1) {
                        $query->where('tbl_courses.active', 1);
                    } else {
                        $query->where(function ($q) {
                            $q->where('tbl_courses.active', 0)->orWhereNull('tbl_courses.active');
                        });
                    }
                } elseif (in_array($sourceKey, ['enrollments', 'assessments', 'exams', 'videos'])) {
                    if ($cActiveInt === 1) {
                        $query->where('tbl_courses.active', 1);
                    } else {
                        $query->where(function ($q) {
                            $q->where('tbl_courses.active', 0)->orWhereNull('tbl_courses.active');
                        });
                    }
                }
            }
        }

        // Filter by Department
        if (!empty($config['department_filter']) && $config['department_filter'] !== 'all' && $config['department_filter'] !== '') {
            $deptVal = $config['department_filter'];
            if ($sourceKey === 'training_matrix') {
                if (is_numeric($deptVal)) {
                    $query->where('departments.id', $deptVal);
                } else {
                    $query->where('departments.department_name', 'LIKE', "%{$deptVal}%");
                }
            } elseif ($sourceKey === 'courses') {
                if (is_numeric($deptVal)) {
                    $query->whereExists(function ($q) use ($deptVal) {
                        $q->select(DB::raw(1))->from('tbl_assignedusers')
                          ->join('users', 'users.id', '=', 'tbl_assignedusers.user_id')
                          ->whereColumn('tbl_assignedusers.course_id', 'tbl_courses.id')
                          ->where('users.department', $deptVal)
                          ->whereNull('tbl_assignedusers.deleted_at');
                    });
                }
            } elseif ($sourceKey !== 'certificates') {
                if (is_numeric($deptVal)) {
                    $query->where('users.department', $deptVal);
                } else {
                    $query->where('departments.department_name', 'LIKE', "%{$deptVal}%");
                }
            }
        }

        // Filter by Designation
        if (!empty($config['designation_filter']) && $config['designation_filter'] !== 'all' && $config['designation_filter'] !== '') {
            $desigVal = $config['designation_filter'];
            if ($sourceKey !== 'certificates' && $sourceKey !== 'training_matrix' && $sourceKey !== 'courses') {
                if (is_numeric($desigVal)) {
                    $query->where('users.designation', $desigVal);
                } else {
                    $query->where('designations.designation_name', 'LIKE', "%{$desigVal}%");
                }
            }
        }

        // Filter by Assessment Name
        if (!empty($config['assessment_name_filter']) && trim($config['assessment_name_filter']) !== '') {
            $assessVal = trim($config['assessment_name_filter']);
            $query->where(function ($q) use ($assessVal) {
                $q->where('tbl_course_documents_list.file_name', 'LIKE', "%{$assessVal}%")
                  ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(tbl_course_assessment_result.quiz_data, '$.title')) LIKE ?", ["%{$assessVal}%"]);
            });
        }

        // Universal Date Preset & Date Range Filter (Today, Yesterday, Last 7 Days, Last 30 Days, This Month, Last Month, etc.)
        $datePreset = strtolower(trim((string)($config['date_preset'] ?? 'all')));
        $dateFrom = $config['date_from'] ?? null;
        $dateTo = $config['date_to'] ?? null;

        if ($datePreset !== 'all' && $datePreset !== '' && $datePreset !== 'custom') {
            $today = date('Y-m-d');
            if ($datePreset === 'today') {
                $dateFrom = $today;
                $dateTo = $today;
            } elseif ($datePreset === 'yesterday') {
                $dateFrom = date('Y-m-d', strtotime('-1 day'));
                $dateTo = date('Y-m-d', strtotime('-1 day'));
            } elseif ($datePreset === 'last_7_days' || $datePreset === 'last_7') {
                $dateFrom = date('Y-m-d', strtotime('-7 days'));
                $dateTo = $today;
            } elseif ($datePreset === 'last_30_days' || $datePreset === 'last_30') {
                $dateFrom = date('Y-m-d', strtotime('-30 days'));
                $dateTo = $today;
            } elseif ($datePreset === 'this_month') {
                $dateFrom = date('Y-m-01');
                $dateTo = date('Y-m-t');
            } elseif ($datePreset === 'last_month') {
                $dateFrom = date('Y-m-d', strtotime('first day of last month'));
                $dateTo = date('Y-m-d', strtotime('last day of last month'));
            } elseif ($datePreset === 'last_3_months' || $datePreset === 'last_90_days') {
                $dateFrom = date('Y-m-d', strtotime('-90 days'));
                $dateTo = $today;
            } elseif ($datePreset === 'this_year') {
                $dateFrom = date('Y-01-01');
                $dateTo = date('Y-12-31');
            }
        }

        if (!empty($dateFrom) || !empty($dateTo)) {
            $dateField = $config['date_field'] ?? 'auto';
            $targetCol = null;

            if ($dateField !== 'auto' && !empty($dateField) && isset($source['fields'][$dateField])) {
                $targetCol = $dateField;
            } else {
                if ($sourceKey === 'learners') {
                    $targetCol = 'tbl_assignedusers.created_at';
                } elseif ($sourceKey === 'assessments') {
                    $targetCol = 'tbl_course_assessment_result.created_at';
                } elseif ($sourceKey === 'exams') {
                    $targetCol = 'tbl_exam_attempts.exam_attend_date';
                } elseif ($sourceKey === 'feedback') {
                    $targetCol = 'tbl_employee_feedback_ratings.created_at';
                } elseif ($sourceKey === 'certificates') {
                    $targetCol = 'tbl_certificates.created_at';
                } elseif ($sourceKey === 'courses' || $sourceKey === 'enrollments' || $sourceKey === 'videos') {
                    $targetCol = 'tbl_assignedusers.created_at';
                }
            }

            if ($targetCol) {
                if (!empty($dateFrom)) {
                    $query->where($targetCol, '>=', date('Y-m-d 00:00:00', strtotime($dateFrom)));
                }
                if (!empty($dateTo)) {
                    $query->where($targetCol, '<=', date('Y-m-d 23:59:59', strtotime($dateTo)));
                }
            }
        }

        // Universal Status & Result Filter (All, In Progress, Completed, Passed, Failed, Pending, Not Started, Expired)
        if (!empty($config['status_filter']) && $config['status_filter'] !== 'all' && $config['status_filter'] !== 'Total' && $config['status_filter'] !== '') {
            $statusVal = strtolower(trim((string)$config['status_filter']));

            if ($sourceKey === 'learners') {
                if ($statusVal === 'completed' || $statusVal === '3') {
                    $query->where('tbl_assignedusers.status', 3);
                } elseif ($statusVal === 'in_progress' || $statusVal === 'in progress' || $statusVal === 'incomplete' || $statusVal === '1') {
                    $query->where('tbl_assignedusers.status', 1)
                          ->where(function ($q) {
                              $q->whereNull('tbl_courses.expiration_date')
                                ->orWhere('tbl_courses.expiration_date', '>=', now())
                                ->orWhere('tbl_courses.expiration_date', '=', '1970-01-01 00:00:00');
                          });
                } elseif ($statusVal === 'not_started' || $statusVal === 'not started' || $statusVal === 'pending' || $statusVal === '0') {
                    $query->where(function ($q) {
                        $q->whereIn('tbl_assignedusers.status', [0, 2])
                          ->orWhereNull('tbl_assignedusers.status');
                    })->where(function ($q) {
                        $q->whereNull('tbl_courses.expiration_date')
                          ->orWhere('tbl_courses.expiration_date', '>=', now())
                          ->orWhere('tbl_courses.expiration_date', '=', '1970-01-01 00:00:00');
                    });
                } elseif ($statusVal === 'expired') {
                    $query->where('tbl_assignedusers.status', '!=', 3)
                          ->whereNotNull('tbl_courses.expiration_date')
                          ->where('tbl_courses.expiration_date', '<', now())
                          ->where('tbl_courses.expiration_date', '!=', '1970-01-01 00:00:00');
                }
            } elseif ($sourceKey === 'assessments') {
                if ($statusVal === 'completed' || $statusVal === '3') {
                    $query->where('tbl_assignedusers.status', 3);
                } elseif ($statusVal === 'in_progress' || $statusVal === 'in progress' || $statusVal === 'incomplete' || $statusVal === '1') {
                    $query->where('tbl_assignedusers.status', 1)
                          ->where(function ($q) {
                              $q->whereNull('tbl_courses.expiration_date')
                                ->orWhere('tbl_courses.expiration_date', '>=', now())
                                ->orWhere('tbl_courses.expiration_date', '=', '1970-01-01 00:00:00');
                          });
                } elseif ($statusVal === 'not_started' || $statusVal === 'not started' || $statusVal === 'pending' || $statusVal === '0') {
                    $query->where(function ($q) {
                        $q->whereIn('tbl_assignedusers.status', [0, 2])
                          ->orWhereNull('tbl_assignedusers.status');
                    })->where(function ($q) {
                        $q->whereNull('tbl_courses.expiration_date')
                          ->orWhere('tbl_courses.expiration_date', '>=', now())
                          ->orWhere('tbl_courses.expiration_date', '=', '1970-01-01 00:00:00');
                    });
                } elseif ($statusVal === 'expired') {
                    $query->where('tbl_assignedusers.status', '!=', 3)
                          ->whereNotNull('tbl_courses.expiration_date')
                          ->where('tbl_courses.expiration_date', '<', now())
                          ->where('tbl_courses.expiration_date', '!=', '1970-01-01 00:00:00');
                }
            } elseif ($sourceKey === 'exams') {
                if ($statusVal === 'passed' || $statusVal === 'pass') {
                    $query->whereRaw("TRIM(LOWER(tbl_exam_attempts.exam_result)) = 'passed'");
                } elseif ($statusVal === 'failed' || $statusVal === 'fail') {
                    $query->whereRaw("TRIM(LOWER(tbl_exam_attempts.exam_result)) = 'failed'");
                } elseif ($statusVal === 'pending' || $statusVal === 'pending evaluation') {
                    $query->whereNotNull('tbl_exam_attempts.id')
                          ->whereRaw("TRIM(LOWER(tbl_exam_attempts.exam_result)) = 'pending'");
                } elseif ($statusVal === 'not_attempted' || $statusVal === 'not attempted' || $statusVal === 'not_started' || $statusVal === 'not started') {
                    $query->whereNull('tbl_exam_attempts.id');
                }
            } elseif ($sourceKey === 'courses') {
                if ($statusVal === 'expired') {
                    $query->whereNotNull('tbl_courses.expiration_date')
                          ->where('tbl_courses.expiration_date', '<', now())
                          ->where('tbl_courses.expiration_date', '!=', '1970-01-01 00:00:00');
                } elseif ($statusVal === 'completed' || $statusVal === '3') {
                    $query->where(function ($q) {
                        $q->whereNull('tbl_courses.expiration_date')
                          ->orWhere('tbl_courses.expiration_date', '>=', now())
                          ->orWhere('tbl_courses.expiration_date', '=', '1970-01-01 00:00:00');
                    })->whereExists(function ($sub) {
                        $sub->select(DB::raw(1))->from('tbl_assignedusers as au')->whereColumn('au.course_id', 'tbl_courses.id')->whereNull('au.deleted_at');
                    })->whereNotExists(function ($sub) {
                        $sub->select(DB::raw(1))->from('tbl_assignedusers as au')->whereColumn('au.course_id', 'tbl_courses.id')->where('au.status', '!=', 3)->whereNull('au.deleted_at');
                    });
                } elseif ($statusVal === 'in_progress' || $statusVal === 'in progress' || $statusVal === 'incomplete' || $statusVal === '1') {
                    $query->where(function ($q) {
                        $q->whereNull('tbl_courses.expiration_date')
                          ->orWhere('tbl_courses.expiration_date', '>=', now())
                          ->orWhere('tbl_courses.expiration_date', '=', '1970-01-01 00:00:00');
                    })->whereExists(function ($sub) {
                        $sub->select(DB::raw(1))->from('tbl_assignedusers as au')->whereColumn('au.course_id', 'tbl_courses.id')->whereIn('au.status', [1, 3])->whereNull('au.deleted_at');
                    })->whereExists(function ($sub) {
                        $sub->select(DB::raw(1))->from('tbl_assignedusers as au')->whereColumn('au.course_id', 'tbl_courses.id')->where('au.status', '!=', 3)->whereNull('au.deleted_at');
                    });
                } elseif ($statusVal === 'not_started' || $statusVal === 'not started' || $statusVal === 'pending' || $statusVal === '0') {
                    $query->where(function ($q) {
                        $q->whereNull('tbl_courses.expiration_date')
                          ->orWhere('tbl_courses.expiration_date', '>=', now())
                          ->orWhere('tbl_courses.expiration_date', '=', '1970-01-01 00:00:00');
                    })->whereNotExists(function ($sub) {
                        $sub->select(DB::raw(1))->from('tbl_assignedusers as au')->whereColumn('au.course_id', 'tbl_courses.id')->whereIn('au.status', [1, 3])->whereNull('au.deleted_at');
                    });
                }
            } elseif ($sourceKey === 'enrollments' || $sourceKey === 'videos') {
                if ($statusVal === 'completed' || $statusVal === '3') {
                    $query->where('tbl_assignedusers.status', 3);
                } elseif ($statusVal === 'in_progress' || $statusVal === 'in progress' || $statusVal === 'incomplete' || $statusVal === '1') {
                    $query->where('tbl_assignedusers.status', 1)
                          ->where(function ($q) {
                              $q->whereNull('tbl_courses.expiration_date')
                                ->orWhere('tbl_courses.expiration_date', '>=', now())
                                ->orWhere('tbl_courses.expiration_date', '=', '1970-01-01 00:00:00');
                          });
                } elseif ($statusVal === 'not_started' || $statusVal === 'not started' || $statusVal === 'pending' || $statusVal === '0') {
                    $query->where(function ($q) {
                        $q->whereIn('tbl_assignedusers.status', [0, 2])
                          ->orWhereNull('tbl_assignedusers.status');
                    })->where(function ($q) {
                        $q->whereNull('tbl_courses.expiration_date')
                          ->orWhere('tbl_courses.expiration_date', '>=', now())
                          ->orWhere('tbl_courses.expiration_date', '=', '1970-01-01 00:00:00');
                    });
                } elseif ($statusVal === 'expired') {
                    $query->where('tbl_assignedusers.status', '!=', 3)
                          ->whereNotNull('tbl_courses.expiration_date')
                          ->where('tbl_courses.expiration_date', '<', now())
                          ->where('tbl_courses.expiration_date', '!=', '1970-01-01 00:00:00');
                }
            }
        }

        // Available fields whitelist (excluding any technical ID fields)
        $allowedFields = [];
        foreach ($source['fields'] as $fKey => $fDef) {
            if (!$this->isTechnicalIdField($fKey, $fDef)) {
                $allowedFields[$fKey] = $fDef;
            }
        }

        // Selected fields
        // Selected fields
        $selectedFields = $config['fields'] ?? ($config['selected_fields'] ?? []);
        if (!empty($selectedFields)) {
            $selectedFields = array_map(function ($k) {
                if ($k === 'users.in_progress_courses_count') return 'users.inprogress_courses_count';
                if ($k === 'users.not_started_courses_count') return 'users.notstarted_courses_count';
                return $k;
            }, $selectedFields);
        }
        if (empty($selectedFields)) {
            // Pick default fields
            $selectedFields = array_keys(array_filter($allowedFields, function ($f, $k) {
                return !empty($f['default']) && !$this->isTechnicalIdField($k, $f);
            }, ARRAY_FILTER_USE_BOTH));

            // Hierarchical field ordering for default fields
            if ($sourceKey === 'learners') {
                $fieldOrderPriority = function ($field) {
                    // 1. Learner Profile & Identity
                    if ($field === 'users.first_name') return 1;
                    if ($field === 'users.email') return 2;
                    if ($field === 'departments.department_name') return 3;
                    if ($field === 'designations.designation_name') return 4;
                    if ($field === 'users.emp_id') return 5;
                    if ($field === 'users.active') return 6;
                    if ($field === 'users.id') return 7;
                    if ($field === 'users.assigned_courses_count') return 8;
                    if ($field === 'users.completed_courses_count') return 9;
                    if ($field === 'users.inprogress_courses_count' || $field === 'users.in_progress_courses_count') return 10;
                    if ($field === 'users.notstarted_courses_count' || $field === 'users.not_started_courses_count') return 11;
                    if ($field === 'users.expired_courses_count') return 12;
                    if ($field === 'users.course_completion_rate') return 13;
                    if ($field === 'users.assigned_assessments_count') return 14;
                    if ($field === 'users.completed_assessments_count') return 15;
                    if ($field === 'users.passed_assessments_count') return 16;
                    if ($field === 'users.failed_assessments_count') return 16;
                    if ($field === 'users.pending_assessments_count') return 17;
                    if ($field === 'users.avg_assessment_score') return 18;
                    if ($field === 'users.exams_attempted_count') return 19;
                    if ($field === 'users.exams_passed_count') return 20;
                    if ($field === 'users.videos_watched_count') return 21;
                    if ($field === 'users.certificates_count') return 22;
                    if ($field === 'users.last_login') return 23;
                    if ($field === 'users.created_at') return 24;
                    // 2. Assigned Courses
                    if ($field === 'tbl_courses.course_name') return 30;
                    if ($field === 'tbl_courses.course_code') return 31;
                    if ($field === 'tbl_categories.category_name') return 32;
                    if ($field === 'tbl_assignedusers.progress_status') return 33;
                    if ($field === 'tbl_assignedusers.created_at') return 34;
                    if ($field === 'tbl_courses.expiration_date') return 35;
                    // 3. Course Assessments & Assignment Exams
                    if ($field === 'tbl_course_documents_list.file_name') return 40;
                    if ($field === 'tbl_course_assessment_result.score') return 41;
                    if ($field === 'tbl_course_assessment_result.percentage') return 42;
                    if ($field === 'tbl_course_assessment_result.pass_fail') return 43;
                    if ($field === 'tbl_course_assessment_result.time_spent') return 44;
                    if ($field === 'tbl_course_assessment_result.status') return 45;
                    if ($field === 'tbl_assignment_exams.name') return 46;
                    if ($field === 'tbl_exam_attempts.exam_result') return 47;
                    return 50;
                };

                usort($selectedFields, function ($a, $b) use ($fieldOrderPriority) {
                    return $fieldOrderPriority($a) <=> $fieldOrderPriority($b);
                });
            } elseif (in_array('tbl_courses.course_name', $selectedFields) || in_array('tbl_courses.course_code', $selectedFields)) {
                $fieldOrderPriority = function ($field) {
                    if ($field === 'tbl_courses.course_name') return 1;
                    if ($field === 'tbl_courses.course_code') return 2;
                    if ($field === 'tbl_categories.category_name') return 3;
                    if ($field === 'tbl_courses.expiration_date') return 4;
                    if ($field === 'tbl_course_documents_list.file_name') return 10;
                    if ($field === 'tbl_assignment_exams.name') return 11;
                    if ($field === 'users.id') return 20;
                    if ($field === 'users.first_name') return 21;
                    if ($field === 'users.email') return 22;
                    if ($field === 'users.emp_id') return 23;
                    if ($field === 'departments.department_name') return 24;
                    if ($field === 'designations.designation_name') return 25;
                    if ($field === 'tbl_assignedusers.created_at') return 26;
                    if ($field === 'tbl_assignedusers.progress_status') return 27;
                    if ($field === 'users.active') return 28;
                    if (str_starts_with($field, 'tbl_course_assessment_result.')) return 40;
                    if (str_starts_with($field, 'tbl_exam_attempts.')) return 41;
                    return 50;
                };

                usort($selectedFields, function ($a, $b) use ($fieldOrderPriority) {
                    return $fieldOrderPriority($a) <=> $fieldOrderPriority($b);
                });
            }
        } else {
            // Strictly preserve the exact user selection order
            $validSelected = [];
            foreach ($selectedFields as $fKey) {
                if (isset($allowedFields[$fKey]) && !$this->isTechnicalIdField($fKey, $allowedFields[$fKey])) {
                    if (!in_array($fKey, $validSelected)) {
                        $validSelected[] = $fKey;
                    }
                }
            }
            $selectedFields = $validSelected;
        }

        // Dynamic joins for learners data source if course, assessment, or exam fields are selected
        $hasLearnerCourseFields = false;
        if ($sourceKey === 'learners') {
            $hasAssessmentFields = false;
            $hasExamFields = false;

            if (!empty($config['course_filter']) && $config['course_filter'] !== 'all' && $config['course_filter'] !== 'Total') {
                $hasLearnerCourseFields = true;
            }
            if (isset($config['course_active_filter']) && $config['course_active_filter'] !== 'all' && $config['course_active_filter'] !== '') {
                $hasLearnerCourseFields = true;
            }
            if (!empty($dateFrom) || !empty($dateTo) || (!empty($config['status_filter']) && $config['status_filter'] !== 'all')) {
                $hasLearnerCourseFields = true;
            }

            foreach ($selectedFields as $sf) {
                if (str_starts_with($sf, 'tbl_courses.') || str_starts_with($sf, 'tbl_assignedusers.') || str_starts_with($sf, 'tbl_categories.')) {
                    $hasLearnerCourseFields = true;
                }
                if (str_starts_with($sf, 'tbl_course_documents_list.') || str_starts_with($sf, 'tbl_course_assessment_result.')) {
                    $hasLearnerCourseFields = true;
                    $hasAssessmentFields = true;
                }
                if (str_starts_with($sf, 'tbl_assignment_exams.') || str_starts_with($sf, 'tbl_exam_attempts.')) {
                    $hasLearnerCourseFields = true;
                    $hasExamFields = true;
                }
            }

            if ($hasLearnerCourseFields) {
                $query->leftJoin(DB::raw("(
                    SELECT MAX(au.id) as id, au.user_id, au.course_id, MAX(au.status) as status, MAX(au.created_at) as created_at
                    FROM tbl_assignedusers as au
                    JOIN tbl_courses as c ON c.id = au.course_id AND c.deleted_at IS NULL AND (c.is_delete IS NULL OR c.is_delete = 0)
                    WHERE au.deleted_at IS NULL
                    GROUP BY au.user_id, au.course_id
                ) as tbl_assignedusers"), 'tbl_assignedusers.user_id', '=', 'users.id');

                $query->leftJoin('tbl_courses', function ($j) {
                    $j->on('tbl_courses.id', '=', 'tbl_assignedusers.course_id')
                      ->whereNull('tbl_courses.deleted_at')
                      ->where(function ($q) {
                          $q->whereNull('tbl_courses.is_delete')->orWhere('tbl_courses.is_delete', 0);
                      });
                });
                $query->leftJoin('tbl_categories', 'tbl_categories.id', '=', 'tbl_courses.category_id');

                if (isset($config['course_active_filter']) && $config['course_active_filter'] !== 'all' && $config['course_active_filter'] !== '') {
                    $cActiveVal = (string)$config['course_active_filter'];
                    if ($cActiveVal === '1' || $cActiveVal === 'active') {
                        $query->where('tbl_courses.active', 1);
                    } elseif ($cActiveVal === '0' || $cActiveVal === 'inactive') {
                        $query->where(function ($q) {
                            $q->where('tbl_courses.active', 0)->orWhereNull('tbl_courses.active');
                        });
                    }
                }
            }
        }

        // Check for Grouping and Calculations
        $groupBy = $config['group_by'] ?? null;
        if ($groupBy === 'none_individual' || $groupBy === 'none' || $groupBy === '') {
            $groupBy = null;
        }

        $calculation = $config['calculation'] ?? null; // e.g. ['type' => 'AVG'] or ['type' => 'COUNT']
        $aggType = !empty($calculation['type']) ? strtoupper(trim($calculation['type'])) : 'COUNT';

        if ($groupBy === 'course_hierarchy_grouped') {
            $query->select('tbl_courses.id as course_id', 'tbl_courses.course_name', 'tbl_courses.course_code')
                  ->whereNotNull('tbl_courses.id')
                  ->distinct();
        } elseif ($groupBy === 'course_and_user' || $groupBy === 'user_and_course') {
            if ($groupBy === 'course_and_user') {
                $firstExpr = "COALESCE(tbl_courses.course_name, '-')";
                $secondExpr = "TRIM(CONCAT(users.first_name, ' ', COALESCE(users.last_name, '')))";
            } else {
                $firstExpr = "TRIM(CONCAT(users.first_name, ' ', COALESCE(users.last_name, '')))";
                $secondExpr = "COALESCE(tbl_courses.course_name, '-')";
            }

            if ($sourceKey === 'assessments') {
                $query->selectRaw("
                    {$firstExpr} as group_col1,
                    {$secondExpr} as group_col2,
                    COUNT(*) as total_count,
                    SUM(CASE WHEN tbl_course_assessment_result.id IS NOT NULL THEN 1 ELSE 0 END) as written_count,
                    SUM(CASE WHEN TRIM(LOWER(JSON_UNQUOTE(JSON_EXTRACT(tbl_course_assessment_result.results, '$.pass_or_fail')))) = 'passed' THEN 1 ELSE 0 END) as passed_count,
                    SUM(CASE WHEN TRIM(LOWER(JSON_UNQUOTE(JSON_EXTRACT(tbl_course_assessment_result.results, '$.pass_or_fail')))) = 'failed' THEN 1 ELSE 0 END) as failed_count,
                    SUM(CASE WHEN tbl_course_assessment_result.id IS NULL THEN 1 ELSE 0 END) as not_started_count,
                    ROUND(COALESCE(AVG(CASE WHEN tbl_course_assessment_result.id IS NOT NULL THEN CAST(JSON_UNQUOTE(JSON_EXTRACT(tbl_course_assessment_result.results, '$.percentage')) AS DECIMAL(10,2)) ELSE NULL END), 0), 1) as avg_score
                ");
            } elseif ($sourceKey === 'exams') {
                $query->selectRaw("
                    {$firstExpr} as group_col1,
                    {$secondExpr} as group_col2,
                    COUNT(*) as total_count,
                    SUM(CASE WHEN tbl_exam_attempts.id IS NOT NULL THEN 1 ELSE 0 END) as written_count,
                    SUM(CASE WHEN TRIM(LOWER(tbl_exam_attempts.exam_result)) = 'passed' THEN 1 ELSE 0 END) as passed_count,
                    SUM(CASE WHEN TRIM(LOWER(tbl_exam_attempts.exam_result)) = 'failed' THEN 1 ELSE 0 END) as failed_count,
                    SUM(CASE WHEN tbl_exam_attempts.exam_result IS NULL OR tbl_exam_attempts.exam_result = 'Pending' THEN 1 ELSE 0 END) as pending_count
                ");
            } elseif ($sourceKey === 'enrollments') {
                $query->selectRaw("
                    {$firstExpr} as group_col1,
                    {$secondExpr} as group_col2,
                    COUNT(*) as total_count,
                    SUM(CASE WHEN tbl_assignedusers.status = 3 THEN 1 ELSE 0 END) as completed_count,
                    SUM(CASE WHEN tbl_assignedusers.status = 1 AND (tbl_courses.expiration_date IS NULL OR tbl_courses.expiration_date >= NOW() OR tbl_courses.expiration_date = '1970-01-01 00:00:00') THEN 1 ELSE 0 END) as progress_count,
                    SUM(CASE WHEN (tbl_assignedusers.status = 0 OR tbl_assignedusers.status = 2 OR tbl_assignedusers.status IS NULL) AND (tbl_courses.expiration_date IS NULL OR tbl_courses.expiration_date >= NOW() OR tbl_courses.expiration_date = '1970-01-01 00:00:00') THEN 1 ELSE 0 END) as not_started_count,
                    SUM(CASE WHEN tbl_assignedusers.status != 3 AND tbl_courses.expiration_date IS NOT NULL AND tbl_courses.expiration_date != '1970-01-01 00:00:00' AND tbl_courses.expiration_date < NOW() THEN 1 ELSE 0 END) as expired_count
                ");
            } elseif ($sourceKey === 'videos') {
                $query->selectRaw("
                    {$firstExpr} as group_col1,
                    {$secondExpr} as group_col2,
                    COUNT(*) as total_count,
                    SUM(CASE WHEN tbl_assignedusers.status = 3 OR (tbl_assessment_video_access.completed_video_ids IS NOT NULL AND JSON_CONTAINS(tbl_assessment_video_access.completed_video_ids, CAST(tbl_course_documents_list.id AS CHAR))) THEN 1 ELSE 0 END) as watched_count,
                    SUM(CASE WHEN NOT (tbl_assignedusers.status = 3 OR (tbl_assessment_video_access.completed_video_ids IS NOT NULL AND JSON_CONTAINS(tbl_assessment_video_access.completed_video_ids, CAST(tbl_course_documents_list.id AS CHAR)))) THEN 1 ELSE 0 END) as unwatched_count
                ");
            } else {
                $query->selectRaw("{$firstExpr} as group_col1, {$secondExpr} as group_col2, COUNT(*) as total_count");
            }
            $query->groupBy('tbl_courses.course_name', 'users.first_name', 'users.last_name');
        } elseif ($groupBy === 'course_and_assessment') {
            $firstExpr = "COALESCE(tbl_courses.course_name, '-')";
            if ($sourceKey === 'exams') {
                $secondExpr = "COALESCE(tbl_assignment_exams.name, 'Exam')";
                $groupCol2 = 'tbl_assignment_exams.name';
            } elseif ($sourceKey === 'videos') {
                $secondExpr = "COALESCE(NULLIF(tbl_course_documents_list.file_name, ''), NULLIF(tbl_course_documents_list.org_file_name, ''), NULLIF(tbl_course_documents_list.file_path, ''), 'Video / Content')";
                $groupCol2 = 'tbl_course_documents_list.file_name';
            } else {
                $secondExpr = "COALESCE(NULLIF(tbl_course_documents_list.file_name, '-'), 'Assessment')";
                $groupCol2 = 'tbl_course_documents_list.file_name';
            }

            if ($sourceKey === 'assessments') {
                $query->selectRaw("
                    {$firstExpr} as group_col1,
                    {$secondExpr} as group_col2,
                    COUNT(DISTINCT tbl_assignedusers.user_id) as total_count,
                    SUM(CASE WHEN tbl_course_assessment_result.id IS NOT NULL THEN 1 ELSE 0 END) as written_count,
                    SUM(CASE WHEN TRIM(LOWER(JSON_UNQUOTE(JSON_EXTRACT(tbl_course_assessment_result.results, '$.pass_or_fail')))) = 'passed' THEN 1 ELSE 0 END) as passed_count,
                    SUM(CASE WHEN TRIM(LOWER(JSON_UNQUOTE(JSON_EXTRACT(tbl_course_assessment_result.results, '$.pass_or_fail')))) = 'failed' THEN 1 ELSE 0 END) as failed_count,
                    ROUND(COALESCE(AVG(CASE WHEN tbl_course_assessment_result.id IS NOT NULL THEN CAST(JSON_UNQUOTE(JSON_EXTRACT(tbl_course_assessment_result.results, '$.percentage')) AS DECIMAL(10,2)) ELSE NULL END), 0), 1) as avg_score
                ");
            } elseif ($sourceKey === 'videos') {
                $query->selectRaw("
                    {$firstExpr} as group_col1,
                    {$secondExpr} as group_col2,
                    COUNT(DISTINCT tbl_assignedusers.user_id) as total_count,
                    SUM(CASE WHEN tbl_assignedusers.status = 3 OR (tbl_assessment_video_access.completed_video_ids IS NOT NULL AND JSON_CONTAINS(tbl_assessment_video_access.completed_video_ids, CAST(tbl_course_documents_list.id AS CHAR))) THEN 1 ELSE 0 END) as watched_count,
                    SUM(CASE WHEN NOT (tbl_assignedusers.status = 3 OR (tbl_assessment_video_access.completed_video_ids IS NOT NULL AND JSON_CONTAINS(tbl_assessment_video_access.completed_video_ids, CAST(tbl_course_documents_list.id AS CHAR)))) THEN 1 ELSE 0 END) as unwatched_count
                ");
            } else {
                $query->selectRaw("
                    {$firstExpr} as group_col1,
                    {$secondExpr} as group_col2,
                    COUNT(*) as total_count,
                    SUM(CASE WHEN tbl_course_assessment_result.id IS NOT NULL THEN 1 ELSE 0 END) as written_count
                ");
            }
            $query->groupBy('tbl_courses.course_name', $groupCol2);
        } elseif (!empty($groupBy) && isset($allowedFields[$groupBy])) {
            $groupFieldDef = $allowedFields[$groupBy];
            if (!empty($groupFieldDef['raw_select'])) {
                $groupExpr = "({$groupFieldDef['raw_select']})";
            } elseif (!empty($groupFieldDef['is_name'])) {
                $tableAlias = explode('.', $groupBy)[0];
                $groupExpr = "TRIM(CONCAT({$tableAlias}.first_name, ' ', COALESCE({$tableAlias}.last_name, '')))";
            } else {
                $groupExpr = $groupBy;
            }

            // Determine accurate metric expression based on data source and aggregation type
            if ($aggType === 'COUNT') {
                $calcExpr = "COUNT(*)";
            } elseif ($aggType === 'COUNT_PASSED') {
                if ($sourceKey === 'assessments') {
                    $calcExpr = "SUM(CASE WHEN TRIM(LOWER(JSON_UNQUOTE(JSON_EXTRACT(tbl_course_assessment_result.results, '$.pass_or_fail')))) = 'passed' THEN 1 ELSE 0 END)";
                } elseif ($sourceKey === 'exams') {
                    $calcExpr = "SUM(CASE WHEN TRIM(LOWER(tbl_exam_attempts.exam_result)) = 'passed' THEN 1 ELSE 0 END)";
                } elseif ($sourceKey === 'enrollments') {
                    $calcExpr = "SUM(CASE WHEN tbl_assignedusers.status = 3 OR tbl_exam_attempts.exam_result = 'Passed' THEN 1 ELSE 0 END)";
                } else {
                    $calcExpr = "COUNT(*)";
                }
            } elseif ($aggType === 'COUNT_FAILED') {
                if ($sourceKey === 'assessments') {
                    $calcExpr = "SUM(CASE WHEN TRIM(LOWER(JSON_UNQUOTE(JSON_EXTRACT(tbl_course_assessment_result.results, '$.pass_or_fail')))) = 'failed' THEN 1 ELSE 0 END)";
                } elseif ($sourceKey === 'exams') {
                    $calcExpr = "SUM(CASE WHEN TRIM(LOWER(tbl_exam_attempts.exam_result)) = 'failed' THEN 1 ELSE 0 END)";
                } elseif ($sourceKey === 'enrollments') {
                    $calcExpr = "SUM(CASE WHEN tbl_exam_attempts.exam_result = 'Failed' THEN 1 ELSE 0 END)";
                } else {
                    $calcExpr = "0";
                }
            } elseif ($aggType === 'COUNT_PENDING' || $aggType === 'COUNT_NOT_ATTEMPTED') {
                if ($sourceKey === 'exams') {
                    $calcExpr = "SUM(CASE WHEN tbl_exam_attempts.exam_result IS NULL OR TRIM(LOWER(tbl_exam_attempts.exam_result)) = 'pending' THEN 1 ELSE 0 END)";
                } elseif ($sourceKey === 'assessments') {
                    $calcExpr = "SUM(CASE WHEN tbl_course_assessment_result.id IS NULL OR TRIM(LOWER(JSON_UNQUOTE(JSON_EXTRACT(tbl_course_assessment_result.results, '$.pass_or_fail')))) = 'pending' THEN 1 ELSE 0 END)";
                } else {
                    $calcExpr = "0";
                }
            } elseif ($aggType === 'COUNT_COMPLETED') {
                if ($sourceKey === 'assessments') {
                    $calcExpr = "SUM(CASE WHEN tbl_course_assessment_result.id IS NOT NULL AND (tbl_course_assessment_result.completed_at IS NOT NULL OR JSON_UNQUOTE(JSON_EXTRACT(tbl_course_assessment_result.results, '$.pass_or_fail')) IN ('Passed', 'Failed')) THEN 1 ELSE 0 END)";
                } else {
                    $calcExpr = "0";
                }
            } elseif ($aggType === 'COUNT_IN_PROGRESS') {
                if ($sourceKey === 'assessments') {
                    $calcExpr = "SUM(CASE WHEN tbl_course_assessment_result.id IS NOT NULL AND tbl_course_assessment_result.completed_at IS NULL AND COALESCE(JSON_UNQUOTE(JSON_EXTRACT(tbl_course_assessment_result.results, '$.pass_or_fail')), '') NOT IN ('Passed', 'Failed') THEN 1 ELSE 0 END)";
                } else {
                    $calcExpr = "0";
                }
            } elseif ($aggType === 'COUNT_NOT_STARTED') {
                if ($sourceKey === 'assessments') {
                    $calcExpr = "SUM(CASE WHEN tbl_course_assessment_result.id IS NULL THEN 1 ELSE 0 END)";
                } else {
                    $calcExpr = "0";
                }
            } elseif ($aggType === 'COUNT_WATCHED') {
                $calcExpr = "SUM(CASE WHEN tbl_assignedusers.status = 3 OR (tbl_assessment_video_access.completed_video_ids IS NOT NULL AND JSON_CONTAINS(tbl_assessment_video_access.completed_video_ids, CAST(tbl_course_documents_list.id AS CHAR))) THEN 1 ELSE 0 END)";
            } elseif ($aggType === 'COUNT_UNWATCHED') {
                $calcExpr = "SUM(CASE WHEN NOT (tbl_assignedusers.status = 3 OR (tbl_assessment_video_access.completed_video_ids IS NOT NULL AND JSON_CONTAINS(tbl_assessment_video_access.completed_video_ids, CAST(tbl_course_documents_list.id AS CHAR)))) THEN 1 ELSE 0 END)";
            } elseif ($aggType === 'AVG_TIME') {
                if ($sourceKey === 'assessments') {
                    $calcExpr = "ROUND(COALESCE(AVG(tbl_course_assessment_result.total_time_taken), 0), 1)";
                } elseif ($sourceKey === 'exams') {
                    $calcExpr = "ROUND(COALESCE(AVG(CASE WHEN tbl_exam_attempts.evaluation_completed_date IS NOT NULL AND tbl_exam_attempts.exam_attend_date IS NOT NULL THEN TIMESTAMPDIFF(SECOND, tbl_exam_attempts.exam_attend_date, tbl_exam_attempts.evaluation_completed_date) ELSE NULL END), 0), 1)";
                } else {
                    $calcExpr = "0";
                }
            } elseif ($aggType === 'SUM_TIME') {
                if ($sourceKey === 'assessments') {
                    $calcExpr = "COALESCE(SUM(tbl_course_assessment_result.total_time_taken), 0)";
                } elseif ($sourceKey === 'exams') {
                    $calcExpr = "COALESCE(SUM(CASE WHEN tbl_exam_attempts.evaluation_completed_date IS NOT NULL AND tbl_exam_attempts.exam_attend_date IS NOT NULL THEN TIMESTAMPDIFF(SECOND, tbl_exam_attempts.exam_attend_date, tbl_exam_attempts.evaluation_completed_date) ELSE 0 END), 0)";
                } else {
                    $calcExpr = "0";
                }
            } elseif ($aggType === 'SUM_COURSES') {
                $calcExpr = "COALESCE(SUM((SELECT COUNT(DISTINCT au.course_id) FROM tbl_assignedusers as au JOIN tbl_courses as c ON c.id = au.course_id WHERE au.user_id = users.id AND au.deleted_at IS NULL AND c.deleted_at IS NULL AND (c.is_delete IS NULL OR c.is_delete = 0))), 0)";
            } elseif ($aggType === 'SUM_COMPLETED_COURSES') {
                $calcExpr = "COALESCE(SUM((SELECT COUNT(DISTINCT au.course_id) FROM tbl_assignedusers as au JOIN tbl_courses as c ON c.id = au.course_id WHERE au.user_id = users.id AND au.status = 3 AND au.deleted_at IS NULL AND c.deleted_at IS NULL AND (c.is_delete IS NULL OR c.is_delete = 0))), 0)";
            } elseif ($aggType === 'SUM_INPROGRESS_COURSES') {
                $calcExpr = "COALESCE(SUM((SELECT COUNT(DISTINCT au.course_id) FROM tbl_assignedusers as au JOIN tbl_courses as c ON c.id = au.course_id WHERE au.user_id = users.id AND au.status = 1 AND au.deleted_at IS NULL AND c.deleted_at IS NULL AND (c.is_delete IS NULL OR c.is_delete = 0) AND (c.expiration_date IS NULL OR c.expiration_date >= NOW() OR c.expiration_date = '1970-01-01 00:00:00'))), 0)";
            } elseif ($aggType === 'SUM_NOTSTARTED_COURSES') {
                $calcExpr = "COALESCE(SUM((SELECT COUNT(DISTINCT au.course_id) FROM tbl_assignedusers as au JOIN tbl_courses as c ON c.id = au.course_id WHERE au.user_id = users.id AND (au.status = 0 OR au.status = 2 OR au.status IS NULL) AND au.deleted_at IS NULL AND c.deleted_at IS NULL AND (c.is_delete IS NULL OR c.is_delete = 0) AND (c.expiration_date IS NULL OR c.expiration_date >= NOW() OR c.expiration_date = '1970-01-01 00:00:00'))), 0)";
            } elseif ($aggType === 'SUM_EXPIRED_COURSES') {
                $calcExpr = "COALESCE(SUM((SELECT COUNT(DISTINCT au.course_id) FROM tbl_assignedusers as au JOIN tbl_courses as c ON c.id = au.course_id WHERE au.user_id = users.id AND au.status != 3 AND au.deleted_at IS NULL AND c.deleted_at IS NULL AND (c.is_delete IS NULL OR c.is_delete = 0) AND c.expiration_date IS NOT NULL AND c.expiration_date != '1970-01-01 00:00:00' AND c.expiration_date < NOW())), 0)";
            } elseif ($aggType === 'SUM_ASSESSMENTS') {
                $calcExpr = "COALESCE(SUM((SELECT COUNT(DISTINCT cdl.id) FROM tbl_assignedusers as au JOIN tbl_course_documents_list as cdl ON cdl.course_id = au.course_id WHERE au.user_id = users.id AND cdl.type = 6 AND cdl.is_delete = 0 AND au.deleted_at IS NULL)), 0)";
            } elseif ($aggType === 'SUM_ENROLLMENTS') {
                $calcExpr = "COALESCE(SUM((SELECT COUNT(DISTINCT au.user_id) FROM tbl_assignedusers as au WHERE au.course_id = tbl_courses.id AND au.deleted_at IS NULL)), 0)";
            } elseif ($aggType === 'SUM_COMPLETED') {
                $calcExpr = "COALESCE(SUM((SELECT COUNT(DISTINCT au.user_id) FROM tbl_assignedusers as au WHERE au.course_id = tbl_courses.id AND au.status = 3 AND au.deleted_at IS NULL)), 0)";
            } elseif ($aggType === 'SUM_INPROGRESS') {
                $calcExpr = "COALESCE(SUM((SELECT COUNT(DISTINCT au.user_id) FROM tbl_assignedusers as au WHERE au.course_id = tbl_courses.id AND au.status = 1 AND au.deleted_at IS NULL AND (tbl_courses.expiration_date IS NULL OR tbl_courses.expiration_date >= NOW() OR tbl_courses.expiration_date = '1970-01-01 00:00:00'))), 0)";
            } elseif ($aggType === 'SUM_NOTSTARTED') {
                $calcExpr = "COALESCE(SUM((SELECT COUNT(DISTINCT au.user_id) FROM tbl_assignedusers as au WHERE au.course_id = tbl_courses.id AND (au.status = 0 OR au.status = 2 OR au.status IS NULL) AND au.deleted_at IS NULL AND (tbl_courses.expiration_date IS NULL OR tbl_courses.expiration_date >= NOW() OR tbl_courses.expiration_date = '1970-01-01 00:00:00'))), 0)";
            } elseif ($aggType === 'SUM_EXPIRED') {
                $calcExpr = "COALESCE(SUM((SELECT COUNT(DISTINCT au.user_id) FROM tbl_assignedusers as au WHERE au.course_id = tbl_courses.id AND au.status != 3 AND au.deleted_at IS NULL AND tbl_courses.expiration_date IS NOT NULL AND tbl_courses.expiration_date != '1970-01-01 00:00:00' AND tbl_courses.expiration_date < NOW())), 0)";
            } elseif ($aggType === 'COUNT_COMPLETED') {
                $calcExpr = "SUM(CASE WHEN tbl_assignedusers.status = 3 THEN 1 ELSE 0 END)";
            } elseif ($aggType === 'COUNT_INPROGRESS') {
                $calcExpr = "SUM(CASE WHEN tbl_assignedusers.status = 1 AND (tbl_courses.expiration_date IS NULL OR tbl_courses.expiration_date >= NOW() OR tbl_courses.expiration_date = '1970-01-01 00:00:00') THEN 1 ELSE 0 END)";
            } elseif ($aggType === 'COUNT_NOTSTARTED') {
                $calcExpr = "SUM(CASE WHEN (tbl_assignedusers.status = 0 OR tbl_assignedusers.status = 2 OR tbl_assignedusers.status IS NULL) AND (tbl_courses.expiration_date IS NULL OR tbl_courses.expiration_date >= NOW() OR tbl_courses.expiration_date = '1970-01-01 00:00:00') THEN 1 ELSE 0 END)";
            } elseif ($aggType === 'COUNT_EXPIRED') {
                $calcExpr = "SUM(CASE WHEN tbl_assignedusers.status != 3 AND tbl_courses.expiration_date IS NOT NULL AND tbl_courses.expiration_date != '1970-01-01 00:00:00' AND tbl_courses.expiration_date < NOW() THEN 1 ELSE 0 END)";
            } elseif ($aggType === 'AVG_PERCENTAGE') {
                $calcExpr = "ROUND(COALESCE(AVG(CAST(JSON_UNQUOTE(JSON_EXTRACT(tbl_course_assessment_result.results, '$.percentage')) AS DECIMAL(10,2))), 0), 1)";
            } elseif ($aggType === 'AVG') {
                $metricField = $calculation['field'] ?? ($source['metric_field'] ?? "{$source['table']}.id");
                $calcExpr = "ROUND(COALESCE(AVG({$metricField}), 0), 2)";
            } elseif ($aggType === 'SUM') {
                $metricField = $calculation['field'] ?? ($source['metric_field'] ?? "{$source['table']}.id");
                $calcExpr = "COALESCE(SUM({$metricField}), 0)";
            } elseif ($aggType === 'MAX') {
                $metricField = $calculation['field'] ?? ($source['metric_field'] ?? "{$source['table']}.id");
                $calcExpr = "COALESCE(MAX({$metricField}), 0)";
            } elseif ($aggType === 'MIN') {
                $metricField = $calculation['field'] ?? ($source['metric_field'] ?? "{$source['table']}.id");
                $calcExpr = "COALESCE(MIN({$metricField}), 0)";
            } else {
                $calcExpr = "COUNT(*)";
            }

            $query->selectRaw("{$groupExpr} as group_label, {$calcExpr} as calc_val");
            $query->groupBy(DB::raw($groupExpr));
        } else {
            // Standard select columns
            $selects = [];
            foreach ($selectedFields as $f) {
                // Generate friendly alias
                $alias = str_replace('.', '__', $f);
                $fieldDef = $allowedFields[$f] ?? [];

                if (!empty($fieldDef['raw_select'])) {
                    $rawSelectExpr = $fieldDef['raw_select'];
                    $selects[] = "({$rawSelectExpr}) as {$alias}";
                } elseif (!empty($fieldDef['is_name'])) {
                    $tableAlias = explode('.', $f)[0];
                    $selects[] = "TRIM(CONCAT({$tableAlias}.first_name, ' ', COALESCE({$tableAlias}.last_name, ''))) as {$alias}";
                } else {
                    $selects[] = "{$f} as {$alias}";
                }
            }
            if (empty($selects)) {
                $selects = ["{$source['table']}.id as {$source['table']}__id"];
            }
            $query->selectRaw(implode(', ', $selects));
        }

        // Apply Filters
        if (!empty($config['filters']) && is_array($config['filters'])) {
            foreach ($config['filters'] as $filter) {
                $field = $filter['field'] ?? null;
                $value = $filter['value'] ?? null;
                $valueTo = $filter['value_to'] ?? null;
                $operator = strtoupper(trim($filter['operator'] ?? ''));

                // Validate field in whitelist
                if (!$field || !isset($allowedFields[$field])) {
                    continue;
                }

                $fieldDef = $allowedFields[$field];
                $fieldType = $fieldDef['type'] ?? 'text';
                $filterSql = $fieldDef['filter_sql'] ?? (!empty($fieldDef['raw_select']) ? "({$fieldDef['raw_select']})" : $field);

                // Handle Date range
                if ($fieldType === 'date') {
                    // Compare the column directly so date indexes remain usable.
                    if (!empty($value)) {
                        $query->where($field, '>=', date('Y-m-d 00:00:00', strtotime($value)));
                    }
                    if (!empty($valueTo)) {
                        $query->where($field, '<', date('Y-m-d 00:00:00', strtotime('+1 day', strtotime($valueTo))));
                    }
                    continue;
                }

                // Skip if empty value or Total / All
                if ($value === null || $value === '' || strtolower(trim((string)$value)) === 'total' || strtolower(trim((string)$value)) === 'all') {
                    continue;
                }

                // Handle text (smart auto-contains), select dropdowns, and numbers
                if (!empty($fieldDef['filter_sql']) || !empty($fieldDef['raw_select'])) {
                    if ($fieldType === 'select') {
                        $query->whereRaw("TRIM(LOWER({$filterSql})) = ?", [strtolower(trim($value))]);
                    } elseif ($fieldType === 'number') {
                        if (in_array($operator, ['>', '>=', '<', '<='])) {
                            $query->whereRaw("CAST({$filterSql} AS DECIMAL(10,2)) {$operator} ?", [$value]);
                        } else {
                            $query->whereRaw("CAST({$filterSql} AS DECIMAL(10,2)) = ?", [$value]);
                        }
                    } else {
                        $query->whereRaw("{$filterSql} LIKE ?", ["%{$value}%"]);
                    }
                } else {
                    if ($fieldType === 'text') {
                        $query->where($field, 'LIKE', "%{$value}%");
                    } elseif ($fieldType === 'select') {
                        $query->whereRaw("TRIM(LOWER({$field})) = ?", [strtolower(trim($value))]);
                    } elseif ($fieldType === 'number') {
                        if (in_array($operator, ['>', '>=', '<', '<='])) {
                            $query->where($field, $operator, $value);
                        } else {
                            $query->where($field, '=', $value);
                        }
                    } else {
                        $query->where($field, 'LIKE', "%{$value}%");
                    }
                }
            }
        }

        // Apply Sorting
        $sortField = $config['sort_field'] ?? null;
        $sortDirection = strtolower($config['sort_direction'] ?? 'desc') === 'asc' ? 'asc' : 'desc';

        if ($groupBy === 'course_hierarchy_grouped') {
            $query->orderBy('tbl_courses.course_name', $sortDirection);
        } elseif ($groupBy === 'course_and_user' || $groupBy === 'user_and_course' || $groupBy === 'course_and_assessment') {
            $query->orderBy('total_count', $sortDirection);
        } elseif (!empty($groupBy)) {
            $query->orderBy('calc_val', $sortDirection);
        } elseif (!empty($sortField) && isset($allowedFields[$sortField])) {
            $fieldDef = $allowedFields[$sortField];
            if (!empty($fieldDef['raw_select'])) {
                $query->orderByRaw("({$fieldDef['raw_select']}) {$sortDirection}");
            } else {
                $query->orderBy($sortField, $sortDirection);
            }
        } else {
            if ($sourceKey === 'assessments') {
                $query->orderBy('tbl_courses.course_name', 'asc')
                      ->orderBy('tbl_courses.course_code', 'asc')
                      ->orderBy('tbl_course_documents_list.file_name', 'asc')
                      ->orderBy('users.first_name', 'asc')
                      ->orderBy('users.id', 'asc');
            } elseif ($sourceKey === 'exams') {
                $query->orderBy('tbl_courses.course_name', 'asc')
                      ->orderBy('tbl_courses.course_code', 'asc')
                      ->orderBy('tbl_assignment_exams.name', 'asc')
                      ->orderBy('users.first_name', 'asc')
                      ->orderBy('users.id', 'asc');
            } elseif ($sourceKey === 'enrollments') {
                $query->orderBy('tbl_courses.course_name', 'asc')
                      ->orderBy('tbl_courses.course_code', 'asc')
                      ->orderBy('users.first_name', 'asc')
                      ->orderBy('users.id', 'asc');
            } elseif ($sourceKey === 'videos') {
                $query->orderBy('tbl_courses.course_name', 'asc')
                      ->orderBy('tbl_courses.course_code', 'asc')
                      ->orderBy('tbl_course_documents_list.file_name', 'asc')
                      ->orderBy('users.first_name', 'asc')
                      ->orderBy('users.id', 'asc');
            } elseif ($sourceKey === 'learners') {
                $query->orderBy('users.first_name', 'asc')
                      ->orderBy('users.id', 'asc');
                if (in_array('tbl_courses.course_name', $selectedFields) || $hasLearnerCourseFields) {
                    $query->orderBy('tbl_courses.course_name', 'asc')
                          ->orderBy('tbl_assignedusers.id', 'asc');
                }
            } else {
                $query->orderBy("{$source['table']}.id", 'desc');
            }
        }

        return [
            'query' => $query,
            'source' => $source,
            'selected_fields' => $selectedFields,
            'group_by' => $groupBy,
            'calculation' => $calculation,
        ];
    }

    /**
     * Execute the report and return structured data for DataTables and Charts.
     */
    public function executeReport(array $config, $limit = 5000)
    {
        $sourceKey = $config['data_source'] ?? 'learners';
        if (!empty($config['data_sources']) && is_array($config['data_sources']) && count($config['data_sources']) > 1) {
            $sourceKey = $config['data_sources'];
        } elseif (is_string($sourceKey) && str_contains($sourceKey, ',')) {
            $sourceKey = array_filter(array_map('trim', explode(',', $sourceKey)));
        }
        $built = $this->buildQuery($sourceKey, $config);

        $query = $built['query'];
        $source = $built['source'];
        $selectedFields = $built['selected_fields'];
        $groupBy = $built['group_by'];
        $calculation = $built['calculation'];
        $outputType = $config['output_type'] ?? 'table';

        // Fetch results
        $results = $query->limit($limit)->get();

        // Format headers and rows
        $headers = [];
        $rows = [];

        if ($groupBy === 'course_hierarchy_grouped') {
            $isExamSource = ($sourceKey === 'exams');
            $isVideoSource = ($sourceKey === 'videos');

            if ($isVideoSource) {
                $headers = [
                    'S.No',
                    'Course Name',
                    'Content Title',
                    'Users (Related to this course)',
                    'Learner Email',
                    'Watch Status',
                    'Course Status',
                    'Assigned Date'
                ];
            } elseif ($isExamSource) {
                $headers = [
                    'S.No',
                    'Course Name',
                    'Assignment Name',
                    'Users (Related to this course)',
                    'Learner Email',
                    'Result (Passed / Failed)',
                    'Marks / Score',
                    'Score (%)',
                    'Status',
                    'Assigned Date',
                    'Attend Date / Start Time',
                    'Completed / End Time'
                ];
            } else {
                $headers = [
                    'S.No',
                    'Course Name',
                    'Assessment Name',
                    'Users (Related to this course)',
                    'Total Attempts (Per User)',
                    'Learner Email',
                    'Course Status',
                    'Marks / Score',
                    'Score (%)',
                    'Time Spent on Exam',
                    'Status',
                    'Assigned Date',
                    'Attend Date / Start Time',
                    'Completed / End Time',
                    'Assessment Status'
                ];
            }

            $courseIds = $results->pluck('course_id')->filter()->unique()->values()->toArray();

            if (empty($courseIds)) {
                return [
                    'headers' => $headers,
                    'rows' => [],
                    'total_count' => 0,
                    'output_type' => $outputType,
                    'chart_data' => null,
                ];
            }

            // BULK QUERY 1: Assessments for all courses (type = 6 only, strictly Quiz / Assessments)
            $allAssessmentDocs = DB::table('tbl_course_documents_list')
                ->whereIn('course_id', $courseIds)
                ->where('type', 6)
                ->where('is_delete', 0)
                ->whereNotNull('file_name')
                ->where('file_name', '!=', '')
                ->select('course_id', 'id', 'file_name')
                ->get()
                ->unique(function ($item) {
                    return $item->course_id . '_' . trim(strtolower($item->file_name));
                })
                ->groupBy('course_id');

            // BULK QUERY 1b: Video / Content docs for all courses (strictly Videos / Content: 1=>amazon, 2=>youtube, 3=>local, 4=>scorm, 5=>attachments)
            $allVideoDocsQuery = DB::table('tbl_course_documents_list')
                ->whereIn('course_id', $courseIds)
                ->whereIn('type', [1, 2, 3, 4, 5])
                ->where('is_delete', 0)
                ->where('is_active', 1);

            if (!empty($config['video_type_filter'])) {
                $vtFilter = strtolower(trim((string)$config['video_type_filter']));
                if ($vtFilter === '1' || $vtFilter === 'amazon' || str_contains($vtFilter, 'amazon')) {
                    $allVideoDocsQuery->where('type', 1);
                } elseif ($vtFilter === '2' || $vtFilter === 'youtube' || str_contains($vtFilter, 'youtube')) {
                    $allVideoDocsQuery->where('type', 2);
                } elseif ($vtFilter === '3' || $vtFilter === 'local' || str_contains($vtFilter, 'local')) {
                    $allVideoDocsQuery->where('type', 3);
                } elseif ($vtFilter === '4' || $vtFilter === 'scorm' || str_contains($vtFilter, 'scorm')) {
                    $allVideoDocsQuery->where('type', 4);
                } elseif ($vtFilter === '5' || $vtFilter === 'attachment' || $vtFilter === 'attachments' || str_contains($vtFilter, 'attachment')) {
                    $allVideoDocsQuery->where('type', 5);
                }
            }

            $allVideoDocs = $allVideoDocsQuery
                ->select('course_id', 'id', 'type', DB::raw("COALESCE(NULLIF(file_name, ''), NULLIF(org_file_name, ''), NULLIF(file_path, ''), 'Video / Content') as title"))
                ->get()
                ->unique(function ($item) {
                    return $item->course_id . '_' . trim(strtolower($item->title));
                })
                ->groupBy('course_id');

            // BULK QUERY 1c: Video Access records
            $allVideoAccess = DB::table('tbl_assessment_video_access')
                ->whereIn('course_id', $courseIds)
                ->select('course_id', 'user_id', 'completed_video_ids')
                ->get()
                ->groupBy(function ($r) {
                    return $r->course_id . '_' . $r->user_id;
                });

            // BULK QUERY 2: Assignment Exams for all courses
            $allAssignmentExamsFromAttempts = DB::table('tbl_exam_attempts')
                ->join('tbl_assignment_exams', 'tbl_assignment_exams.id', '=', 'tbl_exam_attempts.exam_id')
                ->whereIn('tbl_exam_attempts.course_id', $courseIds)
                ->whereNull('tbl_exam_attempts.deleted_at')
                ->select('tbl_exam_attempts.course_id', 'tbl_assignment_exams.id', 'tbl_assignment_exams.name')
                ->distinct()
                ->get();

            $allAssignmentExamsFromDocs = DB::table('tbl_course_documents_list')
                ->join('tbl_assignment_exams', 'tbl_assignment_exams.exam_code', '=', 'tbl_course_documents_list.file_path')
                ->whereIn('tbl_course_documents_list.course_id', $courseIds)
                ->where('tbl_course_documents_list.type', 7)
                ->where('tbl_course_documents_list.is_delete', 0)
                ->select('tbl_course_documents_list.course_id', 'tbl_assignment_exams.id', 'tbl_assignment_exams.name')
                ->distinct()
                ->get();

            $allAssignmentExams = $allAssignmentExamsFromAttempts
                ->concat($allAssignmentExamsFromDocs)
                ->unique(function ($item) {
                    return $item->course_id . '_' . trim(strtolower($item->name));
                })
                ->groupBy('course_id');

            // Active Learner Filter
            $learnerFilter = !empty($config['learner_filter']) && $config['learner_filter'] !== 'all' && $config['learner_filter'] !== 'Total' && $config['learner_filter'] !== '' ? $config['learner_filter'] : null;

            // BULK QUERY 3: Assigned Users for all courses with assigned date & status (Strictly 1 record per learner per course)
            $assignedUsersQuery = DB::table('tbl_assignedusers')
                ->join('users', 'users.id', '=', 'tbl_assignedusers.user_id')
                ->join('tbl_courses', function ($j) {
                    $j->on('tbl_courses.id', '=', 'tbl_assignedusers.course_id')
                      ->whereNull('tbl_courses.deleted_at')
                      ->where(function ($q) {
                          $q->whereNull('tbl_courses.is_delete')->orWhere('tbl_courses.is_delete', 0);
                      });
                })
                ->whereIn('tbl_assignedusers.course_id', $courseIds)
                ->whereNull('tbl_assignedusers.deleted_at')
                ->select(
                    'tbl_assignedusers.course_id',
                    'tbl_assignedusers.status as course_status',
                    'tbl_courses.expiration_date',
                    'users.id as user_id',
                    'users.first_name',
                    'users.last_name',
                    'users.email',
                    'tbl_assignedusers.created_at as assigned_date'
                )
                ->orderBy('tbl_assignedusers.id', 'desc');

            // Active Quick Filter Values
            $statusFilter = !empty($config['status_filter']) ? strtolower(trim((string)$config['status_filter'])) : (!empty($config['assessment_status_filter']) ? strtolower(trim((string)$config['assessment_status_filter'])) : null);
            if ($statusFilter === 'total' || $statusFilter === 'all' || $statusFilter === '') {
                $statusFilter = null;
            }

            if ($learnerFilter) {
                if (is_numeric($learnerFilter)) {
                    $assignedUsersQuery->where('users.id', $learnerFilter);
                } else {
                    $assignedUsersQuery->where(function ($q) use ($learnerFilter) {
                        $q->where('users.first_name', 'LIKE', "%{$learnerFilter}%")
                          ->orWhere('users.last_name', 'LIKE', "%{$learnerFilter}%")
                          ->orWhere('users.email', 'LIKE', "%{$learnerFilter}%")
                          ->orWhere('users.emp_id', 'LIKE', "%{$learnerFilter}%");
                    });
                }
            }

            // User Status Filter (Active / Inactive / Deactivated)
            if (isset($config['user_status_filter']) && $config['user_status_filter'] !== 'all' && $config['user_status_filter'] !== '') {
                $uStatusVal = (string)$config['user_status_filter'];
                $assignedUsersQuery->where(function ($sub) use ($uStatusVal) {
                    if ($uStatusVal === '1' || $uStatusVal === 'active') {
                        $sub->where('users.active', 1)->whereNull('users.deleted_at');
                    } elseif ($uStatusVal === '0' || $uStatusVal === 'inactive') {
                        $sub->where(function ($sq) {
                            $sq->where('users.active', 0)->orWhereNull('users.active');
                        })->whereNull('users.deleted_at')->whereNull('users.deactivation_reason');
                    } elseif ($uStatusVal === '2' || $uStatusVal === 'deactivated') {
                        $sub->where(function ($dq) {
                            $dq->whereNotNull('users.deleted_at')
                               ->orWhere('users.active', 2)
                               ->orWhereNotNull('users.deactivation_reason');
                        });
                    }
                });
            }

            // Course Active Status Filter (Active / Inactive Courses)
            if (isset($config['course_active_filter']) && $config['course_active_filter'] !== 'all' && $config['course_active_filter'] !== '') {
                $cActiveVal = (string)$config['course_active_filter'];
                if ($cActiveVal === '1' || $cActiveVal === 'active') {
                    $assignedUsersQuery->where('tbl_courses.active', 1);
                } elseif ($cActiveVal === '0' || $cActiveVal === 'inactive') {
                    $assignedUsersQuery->where(function ($q) {
                        $q->where('tbl_courses.active', 0)->orWhereNull('tbl_courses.active');
                    });
                }
            }

            // Department Filter
            if (!empty($config['department_filter']) && $config['department_filter'] !== 'all' && $config['department_filter'] !== '') {
                $assignedUsersQuery->where('users.department', $config['department_filter']);
            }

            // Designation Filter
            if (!empty($config['designation_filter']) && $config['designation_filter'] !== 'all' && $config['designation_filter'] !== '') {
                $assignedUsersQuery->where('users.designation', $config['designation_filter']);
            }

            if ($statusFilter && !$isVideoSource && !$isExamSource) {
                if ($statusFilter === 'completed' || $statusFilter === '3') {
                    $assignedUsersQuery->where('tbl_assignedusers.status', 3);
                } elseif ($statusFilter === 'in_progress' || $statusFilter === 'incomplete' || $statusFilter === '1') {
                    $assignedUsersQuery->where('tbl_assignedusers.status', 1)
                        ->where(function ($expQ) {
                            $expQ->whereNull('tbl_courses.expiration_date')
                                 ->orWhere('tbl_courses.expiration_date', '>=', now())
                                 ->orWhere('tbl_courses.expiration_date', '=', '1970-01-01 00:00:00');
                        });
                } elseif ($statusFilter === 'not_started' || $statusFilter === 'not started' || $statusFilter === 'pending' || $statusFilter === '0') {
                    $assignedUsersQuery->where(function ($q) {
                        $q->whereIn('tbl_assignedusers.status', [0, 2])
                          ->orWhereNull('tbl_assignedusers.status');
                    })->where(function ($expQ) {
                        $expQ->whereNull('tbl_courses.expiration_date')
                             ->orWhere('tbl_courses.expiration_date', '>=', now())
                             ->orWhere('tbl_courses.expiration_date', '=', '1970-01-01 00:00:00');
                    });
                } elseif ($statusFilter === 'expired') {
                    $assignedUsersQuery->where(function ($q) {
                        $q->where('tbl_assignedusers.status', '!=', 3)
                          ->orWhereNull('tbl_assignedusers.status');
                    })
                    ->whereNotNull('tbl_courses.expiration_date')
                    ->where('tbl_courses.expiration_date', '!=', '1970-01-01 00:00:00')
                    ->where('tbl_courses.expiration_date', '<', now());
                }
            }

            $allAssignedUsers = $assignedUsersQuery->get()
                ->unique(function ($item) {
                    return $item->course_id . '_' . $item->user_id;
                })
                ->groupBy('course_id');

            // BULK QUERY 3b: Reassigned learners check (Assessments per doc & user)
            $reassignedUserKeys = DB::table('tbl_course_assessment_result')
                ->join('tbl_course_documents_list', 'tbl_course_documents_list.id', '=', 'tbl_course_assessment_result.course_document_id')
                ->whereIn('tbl_course_documents_list.course_id', $courseIds)
                ->whereNotNull('tbl_course_assessment_result.deleted_at')
                ->select('tbl_course_assessment_result.course_document_id', 'tbl_course_assessment_result.user_id')
                ->distinct()
                ->get()
                ->mapWithKeys(function ($row) {
                    return [$row->course_document_id . '_' . $row->user_id => true];
                });

            // BULK QUERY 3c: Reassigned learners check (Assignment Exams per exam & user)
            $reassignedExamUserKeys = DB::table('tbl_exam_attempts')
                ->whereIn('course_id', $courseIds)
                ->whereNotNull('deleted_at')
                ->select('course_id', 'exam_id', 'user_id')
                ->distinct()
                ->get()
                ->mapWithKeys(function ($row) {
                    return [$row->course_id . '_' . $row->exam_id . '_' . $row->user_id => true];
                });

            // BULK QUERY 4: Assessment Attempts counts (per doc & user)
            $allAssessAttempts = DB::table('tbl_course_assessment_result')
                ->join('tbl_course_documents_list', 'tbl_course_documents_list.id', '=', 'tbl_course_assessment_result.course_document_id')
                ->whereIn('tbl_course_documents_list.course_id', $courseIds)
                ->whereNull('tbl_course_assessment_result.deleted_at')
                ->select('tbl_course_assessment_result.course_document_id', 'tbl_course_assessment_result.user_id', DB::raw('COUNT(*) as attempts_count'))
                ->groupBy('tbl_course_assessment_result.course_document_id', 'tbl_course_assessment_result.user_id')
                ->get()
                ->mapWithKeys(function ($row) {
                    return [$row->course_document_id . '_' . $row->user_id => $row->attempts_count];
                });

            // BULK QUERY 5: Exam Attempts counts (per exam & user)
            $allExamAttempts = DB::table('tbl_exam_attempts')
                ->whereIn('tbl_exam_attempts.course_id', $courseIds)
                ->whereNull('tbl_exam_attempts.deleted_at')
                ->select('tbl_exam_attempts.course_id', 'tbl_exam_attempts.exam_id', 'tbl_exam_attempts.user_id', DB::raw('COUNT(*) as attempts_count'))
                ->groupBy('tbl_exam_attempts.course_id', 'tbl_exam_attempts.exam_id', 'tbl_exam_attempts.user_id')
                ->get()
                ->mapWithKeys(function ($row) {
                    return [$row->course_id . '_' . $row->exam_id . '_' . $row->user_id => $row->attempts_count];
                });

            // BULK QUERY 6: Latest Assessment Results (per doc & user)
            $rawResults = DB::table('tbl_course_assessment_result')
                ->join('tbl_course_documents_list', 'tbl_course_documents_list.id', '=', 'tbl_course_assessment_result.course_document_id')
                ->whereIn('tbl_course_documents_list.course_id', $courseIds)
                ->whereNull('tbl_course_assessment_result.deleted_at')
                ->select(
                    'tbl_course_assessment_result.course_document_id',
                    'tbl_course_assessment_result.user_id',
                    'tbl_course_assessment_result.results',
                    'tbl_course_assessment_result.total_time_taken',
                    'tbl_course_assessment_result.completed_at',
                    'tbl_course_assessment_result.created_at',
                    'tbl_course_assessment_result.id'
                )
                ->orderBy('tbl_course_assessment_result.id', 'desc')
                ->get();

            $allLatestResults = $rawResults->groupBy(function ($r) {
                return $r->course_document_id . '_' . $r->user_id;
            })->map(function ($group) {
                return $group->first();
            });

            // BULK QUERY 7: Latest Exam Results (per exam & user)
            $rawExamResults = DB::table('tbl_exam_attempts')
                ->whereIn('tbl_exam_attempts.course_id', $courseIds)
                ->whereNull('tbl_exam_attempts.deleted_at')
                ->select(
                    'tbl_exam_attempts.course_id',
                    'tbl_exam_attempts.user_id',
                    'tbl_exam_attempts.exam_id',
                    'tbl_exam_attempts.exam_result',
                    'tbl_exam_attempts.evaluation_completed_date',
                    'tbl_exam_attempts.exam_attend_date',
                    'tbl_exam_attempts.id'
                )
                ->orderBy('tbl_exam_attempts.id', 'desc')
                ->get();

            $allLatestExamResults = $rawExamResults->groupBy(function ($r) {
                return $r->course_id . '_' . $r->exam_id . '_' . $r->user_id;
            })->map(function ($group) {
                return $group->first();
            });

            // Scored marks from tbl_assigned_answers
            $attemptIds = $rawExamResults->pluck('id')->filter()->unique()->toArray();
            $rawExamMarks = !empty($attemptIds)
                ? DB::table('tbl_assigned_answers')
                    ->whereIn('exam_attendance_id', $attemptIds)
                    ->select('exam_attendance_id', DB::raw('SUM(COALESCE(answer_marks, 0)) as total_marks'))
                    ->groupBy('exam_attendance_id')
                    ->pluck('total_marks', 'exam_attendance_id')
                : collect();

            // Total possible marks from tbl_assignment_questions
            $examIds = $rawExamResults->pluck('exam_id')->filter()->unique()->toArray();
            $rawExamQuestionsTotal = !empty($examIds)
                ? DB::table('tbl_assignment_questions')
                    ->whereIn('exam_id', $examIds)
                    ->select('exam_id', DB::raw('SUM(COALESCE(question_mark, 1)) as total_marks'))
                    ->groupBy('exam_id')
                    ->pluck('total_marks', 'exam_id')
                : collect();

            $badgeStyle = 'style="display: inline-flex; align-items: center; justify-content: center; min-width: 95px; height: 24px; box-shadow: none !important; font-size: 11.5px; font-weight: 500;"';

            // Active Quick Filter Values
            $assignFilter = !empty($config['assessment_assignment_filter']) ? strtolower(trim((string)$config['assessment_assignment_filter'])) : null;
            if ($assignFilter === 'total' || $assignFilter === 'all' || $assignFilter === '') {
                $assignFilter = null;
            }

            $statusFilter = !empty($config['assessment_status_filter']) ? strtolower(trim((string)$config['assessment_status_filter'])) : null;
            if ($statusFilter === 'total' || $statusFilter === 'all' || $statusFilter === '') {
                $statusFilter = null;
            }

            $examResultFilter = !empty($config['exam_result_filter']) ? strtolower(trim((string)$config['exam_result_filter'])) : null;
            if ($examResultFilter === 'total' || $examResultFilter === 'all' || $examResultFilter === '') {
                $examResultFilter = null;
            }

            $videoWatchFilter = !empty($config['video_watch_filter']) ? strtolower(trim((string)$config['video_watch_filter'])) : null;
            if ($videoWatchFilter === 'total' || $videoWatchFilter === 'all' || $videoWatchFilter === '') {
                $videoWatchFilter = null;
            }

            $hasAnyUserLevelFilter = ($assignFilter !== null || $statusFilter !== null || $examResultFilter !== null || $videoWatchFilter !== null || $learnerFilter !== null);
            $courseSNo = 1;

            foreach ($results as $item) {
                $courseId = $item->course_id;
                $courseName = $item->course_name ?: 'Course';
                $courseCode = $item->course_code ?: 'C-' . $courseId;

                // Get items for this course
                if ($isVideoSource) {
                    $courseItems = $allVideoDocs[$courseId] ?? collect();
                } elseif ($isExamSource) {
                    $courseItems = $allAssignmentExams[$courseId] ?? collect();
                } else {
                    $courseItems = $allAssessmentDocs[$courseId] ?? collect();
                }

                if (!empty($config['assessment_name_filter']) && trim($config['assessment_name_filter']) !== '') {
                    $assessSearch = strtolower(trim((string)$config['assessment_name_filter']));
                    $courseItems = $courseItems->filter(function ($ci) use ($assessSearch, $isVideoSource, $isExamSource) {
                        $name = $isVideoSource ? ($ci->title ?? '') : ($isExamSource ? ($ci->name ?? '') : ($ci->file_name ?? ''));
                        return str_contains(strtolower($name), $assessSearch);
                    })->values();
                }

                $assignedUsers = $allAssignedUsers[$courseId] ?? collect();

                if ($learnerFilter && $assignedUsers->isEmpty()) {
                    continue;
                }

                $totalItemsCount = $courseItems->count();
                $totalLearnersCount = $assignedUsers->count();
                $itemLabelText = $isVideoSource ? 'Videos' : ($isExamSource ? 'Exams' : 'Assessments');

                // Course Cell (Displayed ONE TIME via rowspan with total assessments & users badges)
                $colCourse = '<div class="py-1 text-start" style="min-width: 220px;">' .
                    '<div class="d-flex align-items-center mb-1" style="gap: 8px;">' .
                        '<div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px; background-color: #e0f2f1; color: #008080; font-size: 14px;"><i class="fa-solid fa-book-open"></i></div>' .
                        '<div class="fw-bold text-dark font-smallsize mb-0" style="line-height: 1.35; font-size: 13.5px;">' . htmlspecialchars($courseName) . '</div>' .
                    '</div>' .
                    '<div class="d-flex flex-wrap gap-1 mt-1 ms-1">' .
                        '<span class="badge bg-light text-dark border font-smallsize" style="font-size: 11px;"><i class="fa-solid fa-hashtag text-teal me-1" style="color: #008080;"></i>' . htmlspecialchars($courseCode) . '</span>' .
                        '<span class="badge bg-teal text-white font-smallsize" style="background-color: #008080; font-size: 11px;"><i class="fa-solid fa-list-check me-1"></i>' . $totalItemsCount . ' ' . $itemLabelText . '</span>' .
                        '<span class="badge bg-primary text-white font-smallsize" style="font-size: 11px;"><i class="fa-solid fa-users me-1"></i>' . $totalLearnersCount . ' Learners</span>' .
                    '</div>' .
                '</div>';

                if ($courseItems->isEmpty()) {
                    if (!$hasAnyUserLevelFilter) {
                        $colItemEmpty = '<span class="text-muted font-smallsize fst-italic">' . ($isVideoSource ? 'No video content created' : ($isExamSource ? 'No assignments created' : 'No assessments created')) . '</span>';
                        $colUserEmpty = '<span class="text-muted font-smallsize fst-italic">No learners assigned</span>';

                        if ($isVideoSource) {
                            $rows[] = [
                                $courseSNo++,
                                $colCourse,
                                $colItemEmpty,
                                $colUserEmpty,
                                '-',
                                '<span class="badge rounded-1 bg-light text-muted border shadow-none" ' . $badgeStyle . '>Not Watched</span>',
                                '<span class="badge rounded-1 bg-secondary text-white shadow-none" ' . $badgeStyle . '>Not Started</span>',
                                '-',
                                '_course_rowspan' => 1,
                                '_item_rowspan' => 1,
                                '_rowspans' => [0 => 1, 1 => 1, 2 => 1, 3 => 1, 4 => 1, 5 => 1, 6 => 1, 7 => 1],
                            ];
                        } elseif ($isExamSource) {
                            $rows[] = [
                                $courseSNo++,
                                $colCourse,
                                $colItemEmpty,
                                $colUserEmpty,
                                '-',
                                '<span class="badge rounded-1 bg-light text-muted border shadow-none" ' . $badgeStyle . '>Not Attempted</span>',
                                '-',
                                '-',
                                '<span class="badge rounded-1 bg-secondary text-white shadow-none" ' . $badgeStyle . '>Not Started</span>',
                                '-',
                                '-',
                                '-',
                                '_course_rowspan' => 1,
                                '_item_rowspan' => 1,
                                '_rowspans' => [0 => 1, 1 => 1, 2 => 1, 3 => 1, 4 => 1, 5 => 1, 6 => 1, 7 => 1, 8 => 1, 9 => 1, 10 => 1, 11 => 1],
                            ];
                        } else {
                            $rows[] = [
                                $courseSNo++,
                                $colCourse,
                                $colItemEmpty,
                                $colUserEmpty,
                                0,
                                '-',
                                '<span class="badge rounded-1 bg-light text-muted border shadow-none" ' . $badgeStyle . '>Not Attempted</span>',
                                '-',
                                '-',
                                '-',
                                '<span class="badge rounded-1 bg-secondary text-white shadow-none" ' . $badgeStyle . '>Not Started</span>',
                                '-',
                                '-',
                                '-',
                                '<span class="badge rounded-1 bg-primary text-white shadow-none" ' . $badgeStyle . '>Assigned</span>',
                                '_course_rowspan' => 1,
                                '_item_rowspan' => 1,
                                '_rowspans' => [0 => 1, 1 => 1, 2 => 1, 3 => 1, 4 => 1, 5 => 1, 6 => 1, 7 => 1, 8 => 1, 9 => 1, 10 => 1, 11 => 1, 12 => 1, 13 => 1, 14 => 1],
                            ];
                        }
                    }
                    continue;
                }

                // Collect matched items & user rows for this course
                $courseItemData = [];
                $totalCourseRows = 0;

                foreach ($courseItems as $ci) {
                    $itemId = $ci->id;
                    $itemName = $isVideoSource ? ($ci->title ?? 'Video') : ($isExamSource ? ($ci->name ?? 'Assignment') : ($ci->file_name ?? 'Assessment'));
                    $itemAssignedCount = $assignedUsers->count();

                    // Assessment Cell (Displayed ONE TIME via rowspan with total assigned users badge)
                    $colItem = '<div class="py-1 text-start" style="min-width: 200px;">' .
                        '<div class="fw-bold text-dark font-smallsize mb-1" style="line-height: 1.35; font-size: 13px;">' .
                            '<i class="fa-solid fa-file-lines text-teal me-1" style="color: #008080;"></i>' . htmlspecialchars($itemName) .
                        '</div>' .
                        '<div>' .
                            '<span class="badge bg-light text-dark border font-smallsize" style="font-size: 11px;"><i class="fa-solid fa-user-check text-teal me-1" style="color: #008080;"></i>' . $itemAssignedCount . ' Users Assigned</span>' .
                        '</div>' .
                    '</div>';

                    $itemUserRows = [];

                    if ($assignedUsers->isEmpty()) {
                        if (!$hasAnyUserLevelFilter) {
                            $colUserEmpty = '<span class="text-muted font-smallsize fst-italic">No learners assigned</span>';
                            if ($isVideoSource) {
                                $itemUserRows[] = [
                                    $colCourse, $colItem, $colUserEmpty, '-',
                                    '<span class="badge rounded-1 bg-light text-muted border shadow-none" ' . $badgeStyle . '>Not Watched</span>',
                                    '<span class="badge rounded-1 bg-secondary text-white shadow-none" ' . $badgeStyle . '>Not Started</span>',
                                    '-'
                                ];
                            } elseif ($isExamSource) {
                                $itemUserRows[] = [
                                    $colCourse, $colItem, $colUserEmpty, '-',
                                    '<span class="badge rounded-1 bg-light text-muted border shadow-none" ' . $badgeStyle . '>Not Attempted</span>',
                                    '-', '-',
                                    '<span class="badge rounded-1 bg-secondary text-white shadow-none" ' . $badgeStyle . '>Not Started</span>',
                                    '-', '-', '-'
                                ];
                            } else {
                                $itemUserRows[] = [
                                    $colCourse, $colItem, $colUserEmpty, 0, '-',
                                    '<span class="badge rounded-1 bg-light text-muted border shadow-none" ' . $badgeStyle . '>Not Attempted</span>',
                                    '-', '-', '-',
                                    '<span class="badge rounded-1 bg-secondary text-white shadow-none" ' . $badgeStyle . '>Not Started</span>',
                                    '-', '-', '-',
                                    '<span class="badge rounded-1 bg-primary text-white shadow-none" ' . $badgeStyle . '>Assigned</span>'
                                ];
                            }
                        }
                    } else {
                        foreach ($assignedUsers as $u) {
                            $userName = trim($u->first_name . ' ' . ($u->last_name ?? ''));
                            $colUser = '<div class="text-dark d-flex align-items-center" style="gap: 8px;">' .
                                '<i class="fa-solid fa-user text-secondary" style="font-size: 12px; width: 14px; flex-shrink: 0;"></i>' .
                                '<span class="font-smallsize text-dark" style="white-space: nowrap;">' . htmlspecialchars($userName) . '</span>' .
                            '</div>';

                            $colEmail = '<span class="text-muted font-smallsize">' . htmlspecialchars($u->email ?? '-') . '</span>';
                            $assignedDateVal = (!empty($u->assigned_date)) ? date('d-M-Y', strtotime($u->assigned_date)) : '-';

                            if ($isVideoSource) {
                                $vAccess = $allVideoAccess[$courseId . '_' . $u->user_id] ?? null;
                                $isWatched = false;
                                if ($u->course_status == 3) {
                                    $isWatched = true;
                                } elseif ($vAccess && !empty($vAccess->first()->completed_video_ids)) {
                                    $rawCompleted = (string)$vAccess->first()->completed_video_ids;
                                    $decoded = json_decode($rawCompleted, true);
                                    if (is_array($decoded)) {
                                        $completedIds = array_map('strval', $decoded);
                                    } else {
                                        $completedIds = array_map('trim', explode(',', str_replace(['[', ']', '"'], '', $rawCompleted)));
                                    }
                                    $isWatched = in_array((string)$itemId, $completedIds);
                                }

                                if ($videoWatchFilter === 'watched' && !$isWatched) continue;
                                if (($videoWatchFilter === 'not watched' || $videoWatchFilter === 'not_watched') && $isWatched) continue;

                                $watchLabel = $isWatched ? 'Watched' : 'Not Watched';
                                $watchBadge = $isWatched ? 'bg-success text-white' : 'bg-light text-muted border';
                                $colWatch = '<span class="badge rounded-1 ' . $watchBadge . ' shadow-none" ' . $badgeStyle . '>' . $watchLabel . '</span>';

                                $isExpired = (!empty($u->expiration_date) && $u->expiration_date !== '1970-01-01 00:00:00' && strtotime($u->expiration_date) < time() && $u->course_status != 3);
                                if ($isExpired) {
                                    $courseStatusLabel = 'Expired';
                                    $courseStatusBadge = 'bg-danger text-white';
                                } elseif ($u->course_status == 3) {
                                    $courseStatusLabel = 'Completed';
                                    $courseStatusBadge = 'bg-success text-white';
                                } elseif ($u->course_status == 1) {
                                    $courseStatusLabel = 'In Progress';
                                    $courseStatusBadge = 'bg-warning text-dark';
                                } else {
                                    $courseStatusLabel = 'Not Started';
                                    $courseStatusBadge = 'bg-secondary text-white';
                                }
                                $colCourseStatus = '<span class="badge rounded-1 ' . $courseStatusBadge . ' shadow-none" ' . $badgeStyle . '>' . $courseStatusLabel . '</span>';

                                $itemUserRows[] = [
                                    $colCourse,
                                    $colItem,
                                    $colUser,
                                    $colEmail,
                                    $colWatch,
                                    $colCourseStatus,
                                    $assignedDateVal,
                                ];
                            } elseif ($isExamSource) {
                                $examKey = $courseId . '_' . $itemId . '_' . $u->user_id;
                                $totalUserAttempts = $allExamAttempts[$examKey] ?? 0;
                                $latestExam = $allLatestExamResults[$examKey] ?? null;
                                $isReassigned = isset($reassignedExamUserKeys[$examKey]);

                                if ($assignFilter === 'reassigned' && !$isReassigned) continue;
                                if ($assignFilter === 'assigned' && $isReassigned) continue;

                                $passFail = 'Not Attempted';
                                $marksVal = '-';
                                $scoreVal = '-';
                                $statusVal = 'Not Started';
                                $startDateVal = '-';
                                $completedDateVal = '-';

                                if ($latestExam) {
                                    $passFail = $latestExam->exam_result ?: 'Pending';
                                    $scored = $rawExamMarks[$latestExam->id] ?? null;
                                    if ($scored !== null) {
                                        $marksVal = round((float)$scored, 2);
                                    }
                                    $totalQ = $rawExamQuestionsTotal[$itemId] ?? null;
                                    if ($scored !== null && $totalQ > 0) {
                                        $scoreVal = round(($scored / $totalQ) * 100, 1) . '%';
                                    }
                                    if ($latestExam->evaluation_completed_date) {
                                        $statusVal = 'Completed';
                                        $completedDateVal = date('d-M-Y h:i A', strtotime($latestExam->evaluation_completed_date));
                                    }
                                    if ($latestExam->exam_attend_date) {
                                        $startDateVal = date('d-M-Y h:i A', strtotime($latestExam->exam_attend_date));
                                        if (!$latestExam->evaluation_completed_date) {
                                            $statusVal = 'In Progress';
                                        }
                                    }
                                }

                                $passFailLower = strtolower(trim($passFail));

                                if ($examResultFilter === 'passed' && $passFailLower !== 'passed' && $passFailLower !== 'pass') continue;
                                if ($examResultFilter === 'failed' && $passFailLower !== 'failed' && $passFailLower !== 'fail') continue;
                                if (($examResultFilter === 'not attempted' || $examResultFilter === 'not_attempted' || $examResultFilter === 'pending') && ($passFailLower === 'passed' || $passFailLower === 'pass' || $passFailLower === 'failed' || $passFailLower === 'fail')) continue;

                                if ($passFailLower === 'passed' || $passFailLower === 'pass') {
                                    $badgeClass = 'bg-success text-white';
                                } elseif ($passFailLower === 'failed' || $passFailLower === 'fail') {
                                    $badgeClass = 'bg-danger text-white';
                                } elseif ($passFailLower === 'pending') {
                                    $badgeClass = 'bg-warning text-dark';
                                } else {
                                    $badgeClass = 'bg-light text-muted border';
                                    $passFail = 'Not Attempted';
                                }
                                $statusBadge = ($statusVal === 'Completed') ? 'bg-success text-white' : (($statusVal === 'In Progress') ? 'bg-warning text-dark' : 'bg-secondary text-white');

                                $itemUserRows[] = [
                                    $colCourse,
                                    $colItem,
                                    $colUser,
                                    $colEmail,
                                    '<span class="badge rounded-1 ' . $badgeClass . ' shadow-none" ' . $badgeStyle . '>' . htmlspecialchars($passFail) . '</span>',
                                    $marksVal,
                                    $scoreVal,
                                    '<span class="badge rounded-1 ' . $statusBadge . ' shadow-none" ' . $badgeStyle . '>' . $statusVal . '</span>',
                                    $assignedDateVal,
                                    $startDateVal,
                                    $completedDateVal,
                                ];
                            } else { // Assessments
                                $assessKey = $itemId . '_' . $u->user_id;
                                $totalUserAttempts = $allAssessAttempts[$assessKey] ?? 0;
                                $latestRes = $allLatestResults[$assessKey] ?? null;
                                $isReassigned = isset($reassignedUserKeys[$assessKey]);

                                if ($assignFilter === 'reassigned' && !$isReassigned) continue;
                                if ($assignFilter === 'assigned' && $isReassigned) continue;

                                $passFail = 'Not Attempted';
                                $marksVal = '-';
                                $scoreVal = '-';
                                $timeVal = '-';
                                $statusVal = 'Not Started';
                                $startDateVal = '-';
                                $completedDateVal = '-';

                                if ($latestRes && !empty($latestRes->results)) {
                                    $resData = is_array($latestRes->results) ? $latestRes->results : json_decode($latestRes->results, true);
                                    $passFail = $resData['pass_or_fail'] ?? 'Pending';
                                    if (isset($resData['score']) && $resData['score'] !== null && $resData['score'] !== '') {
                                        $marksVal = round((float)$resData['score'], 2);
                                    }
                                    if (isset($resData['percentage']) && $resData['percentage'] !== null && $resData['percentage'] !== '') {
                                        $scoreVal = round((float)$resData['percentage'], 1) . '%';
                                    }
                                    if (!empty($latestRes->total_time_taken)) {
                                        $sec = (int)$latestRes->total_time_taken;
                                        $timeVal = $sec >= 60 ? (floor($sec / 60) . 'm ' . ($sec % 60) . 's') : ($sec . 's');
                                    }
                                    if ($latestRes->completed_at) {
                                        $statusVal = 'Completed';
                                        $completedDateVal = date('d-M-Y h:i A', strtotime($latestRes->completed_at));
                                    } elseif ($latestRes->created_at) {
                                        $statusVal = 'Completed';
                                    }
                                    if ($latestRes->created_at) {
                                        $startDateVal = date('d-M-Y h:i A', strtotime($latestRes->created_at));
                                    }
                                }

                                $isExpired = (!empty($u->expiration_date) && $u->expiration_date !== '1970-01-01 00:00:00' && strtotime($u->expiration_date) < time() && $u->course_status != 3);

                                if ($statusFilter) {
                                    if (($statusFilter === 'completed' || $statusFilter === '3') && $u->course_status != 3) continue;
                                    if (($statusFilter === 'in_progress' || $statusFilter === 'incomplete' || $statusFilter === '1') && ($u->course_status != 1 || $isExpired)) continue;
                                    if (($statusFilter === 'not started' || $statusFilter === 'not_started' || $statusFilter === '0') && (($u->course_status != 0 && $u->course_status !== null) || $isExpired)) continue;
                                    if ($statusFilter === 'expired' && !$isExpired) continue;
                                }

                                if ($isExpired) {
                                    $courseStatusLabel = 'Expired';
                                    $courseStatusBadge = 'bg-danger text-white';
                                } elseif ($u->course_status == 3) {
                                    $courseStatusLabel = 'Completed';
                                    $courseStatusBadge = 'bg-success text-white';
                                } elseif ($u->course_status == 1) {
                                    $courseStatusLabel = 'In Progress';
                                    $courseStatusBadge = 'bg-warning text-dark';
                                } else {
                                    $courseStatusLabel = 'Not Started';
                                    $courseStatusBadge = 'bg-secondary text-white';
                                }
                                $colCourseStatus = '<span class="badge rounded-1 ' . $courseStatusBadge . ' shadow-none" ' . $badgeStyle . '>' . $courseStatusLabel . '</span>';
                                $statusBadge = ($statusVal === 'Completed') ? 'bg-success text-white' : 'bg-secondary text-white';
                                $assignTypeLabel = $isReassigned ? 'Reassigned' : 'Assigned';
                                $assignTypeBadge = $isReassigned ? 'bg-warning text-dark' : 'bg-primary text-white';

                                $itemUserRows[] = [
                                    $colCourse,
                                    $colItem,
                                    $colUser,
                                    (int)$totalUserAttempts,
                                    $colEmail,
                                    $colCourseStatus,
                                    $marksVal,
                                    $scoreVal,
                                    $timeVal,
                                    '<span class="badge rounded-1 ' . $statusBadge . ' shadow-none" ' . $badgeStyle . '>' . $statusVal . '</span>',
                                    $assignedDateVal,
                                    $startDateVal,
                                    $completedDateVal,
                                    '<span class="badge rounded-1 ' . $assignTypeBadge . ' shadow-none" ' . $badgeStyle . '>' . $assignTypeLabel . '</span>',
                                ];
                            }
                        }
                    }

                    if (!empty($itemUserRows)) {
                        $courseItemData[] = [
                            'item' => $ci,
                            'rows' => $itemUserRows
                        ];
                        $totalCourseRows += count($itemUserRows);
                    }
                }

                if (empty($courseItemData)) {
                    continue;
                }

                $courseHierarchyItems = [];
                foreach ($courseItemData as $cData) {
                    $ci = $cData['item'];
                    $itemName = $isVideoSource ? ($ci->title ?? 'Video') : ($isExamSource ? ($ci->name ?? 'Assignment') : ($ci->file_name ?? 'Assessment'));
                    $courseHierarchyItems[] = [
                        'item_id' => $ci->id,
                        'item_name' => $itemName,
                        'item_type' => $isVideoSource ? 'Video Content' : ($isExamSource ? 'Assignment Exam' : 'Assessment'),
                        'rows' => $cData['rows']
                    ];
                }

                $hierarchy[] = [
                    'course_id' => $courseId,
                    'course_name' => $courseName,
                    'course_code' => $courseCode,
                    'total_rows' => $totalCourseRows,
                    'items' => $courseHierarchyItems
                ];

                $isFirstCourseRow = true;
                foreach ($courseItemData as $cData) {
                    $itemRows = $cData['rows'];
                    $totalItemRows = count($itemRows);
                    $isFirstItemRow = true;

                    foreach ($itemRows as $uRow) {
                        $rowspans = [
                            0 => $isFirstCourseRow ? $totalCourseRows : 0, // S.No
                            1 => $isFirstCourseRow ? $totalCourseRows : 0, // Course Name
                            2 => $isFirstItemRow ? $totalItemRows : 0,     // Item / Assessment Name
                        ];
                        for ($cIdx = 3; $cIdx < count($headers); $cIdx++) {
                            $rowspans[$cIdx] = 1;
                        }
                        $rowWithSNo = array_merge([$courseSNo], $uRow);
                        $rowWithSNo['_course_rowspan'] = $isFirstCourseRow ? $totalCourseRows : 0;
                        $rowWithSNo['_item_rowspan'] = $isFirstItemRow ? $totalItemRows : 0;
                        $rowWithSNo['_rowspans'] = $rowspans;
                        $rows[] = $rowWithSNo;

                        $isFirstCourseRow = false;
                        $isFirstItemRow = false;
                    }
                }
                $courseSNo++;
            }

            return [
                'headers' => $headers,
                'rows' => $rows,
                'hierarchy' => $hierarchy ?? [],
                'total_count' => count($rows),
                'output_type' => $outputType,
                'chart_data' => null,
            ];
        } elseif ($groupBy === 'course_and_user' || $groupBy === 'user_and_course') {
            $isCourseFirst = ($groupBy === 'course_and_user');
            $col1 = $isCourseFirst ? 'Course Name' : 'Learner Name';
            $col2 = $isCourseFirst ? 'Learner Name' : 'Course Name';

            if ($sourceKey === 'assessments') {
                $headers = ['S.No', $col1, $col2, 'Total Assessments', 'Written / Attempted', 'Passed', 'Failed', 'Not Started', 'Avg Score (%)'];
            } elseif ($sourceKey === 'exams') {
                $headers = ['S.No', $col1, $col2, 'Total Assigned Exams', 'Written / Attempted', 'Passed', 'Failed', 'Pending Evaluation'];
            } elseif ($sourceKey === 'enrollments') {
                $headers = ['S.No', $col1, $col2, 'Total Enrollments', 'Completed', 'In Progress', 'Not Started', 'Expired'];
            } elseif ($sourceKey === 'videos') {
                $headers = ['S.No', $col1, $col2, 'Total Course Videos', 'Watched Videos', 'Unwatched Videos'];
            } else {
                $headers = ['S.No', $col1, $col2, 'Total Records'];
            }

            $groupedByFirst = $results->groupBy(function ($item) {
                return $item->group_col1 ?: 'Unassigned';
            });

            $parentSNo = 1;
            foreach ($groupedByFirst as $parentName => $childItems) {
                $pCount = $childItems->count();
                $isFirstParent = true;

                $colParentHtml = '<div class="py-1 text-start" style="min-width: 200px;">' .
                    '<div class="d-flex align-items-center mb-1" style="gap: 8px;">' .
                        '<div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 30px; height: 30px; background-color: #e0f2f1; color: #008080; font-size: 13px;"><i class="' . ($isCourseFirst ? 'fa-solid fa-book-open' : 'fa-solid fa-user') . '"></i></div>' .
                        '<div class="fw-bold text-dark font-smallsize mb-0" style="line-height: 1.35; font-size: 13.5px;">' . htmlspecialchars($parentName) . '</div>' .
                    '</div>' .
                    '<div class="d-flex flex-wrap gap-1 mt-1 ms-1">' .
                        '<span class="badge bg-teal text-white font-smallsize" style="background-color: #008080; font-size: 11px;"><i class="' . ($isCourseFirst ? 'fa-solid fa-users' : 'fa-solid fa-book') . ' me-1"></i>' . $pCount . ($isCourseFirst ? ' Learners' : ' Courses') . '</span>' .
                    '</div>' .
                '</div>';

                foreach ($childItems as $item) {
                    $childName = $item->group_col2 ?: 'Unknown';
                    $colChildHtml = '<div class="fw-semibold text-dark font-smallsize"><i class="' . ($isCourseFirst ? 'fa-solid fa-user text-teal' : 'fa-solid fa-book text-teal') . ' me-1" style="color: #008080;"></i>' . htmlspecialchars($childName) . '</div>';

                    if ($sourceKey === 'assessments') {
                        $rows[] = [
                            $parentSNo,
                            $colParentHtml,
                            $colChildHtml,
                            '<span class="badge bg-light text-dark border font-smallsize">' . (int)$item->total_count . ' Assessments</span>',
                            (string)$item->written_count,
                            '<span class="badge bg-success text-white">' . (int)$item->passed_count . '</span>',
                            '<span class="badge bg-danger text-white">' . (int)$item->failed_count . '</span>',
                            '<span class="badge bg-secondary text-white">' . (int)$item->not_started_count . '</span>',
                            "{$item->avg_score}%",
                            '_course_rowspan' => $isFirstParent ? $pCount : 0,
                            '_item_rowspan' => 1,
                            '_rowspans' => [
                                0 => $isFirstParent ? $pCount : 0,
                                1 => $isFirstParent ? $pCount : 0,
                                2 => 1,
                                3 => 1,
                                4 => 1,
                                5 => 1,
                                6 => 1,
                                7 => 1,
                                8 => 1,
                            ],
                        ];
                    } elseif ($sourceKey === 'exams') {
                        $rows[] = [
                            $parentSNo,
                            $colParentHtml,
                            $colChildHtml,
                            '<span class="badge bg-light text-dark border font-smallsize">' . (int)$item->total_count . ' Exams</span>',
                            (string)$item->written_count,
                            '<span class="badge bg-success text-white">' . (int)$item->passed_count . '</span>',
                            '<span class="badge bg-danger text-white">' . (int)$item->failed_count . '</span>',
                            '<span class="badge bg-warning text-dark">' . (int)$item->pending_count . '</span>',
                            '_course_rowspan' => $isFirstParent ? $pCount : 0,
                            '_item_rowspan' => 1,
                            '_rowspans' => [
                                0 => $isFirstParent ? $pCount : 0,
                                1 => $isFirstParent ? $pCount : 0,
                                2 => 1,
                                3 => 1,
                                4 => 1,
                                5 => 1,
                                6 => 1,
                                7 => 1,
                            ],
                        ];
                    } elseif ($sourceKey === 'enrollments') {
                        $rows[] = [
                            $parentSNo,
                            $colParentHtml,
                            $colChildHtml,
                            '<span class="badge bg-light text-dark border font-smallsize">' . (int)$item->total_count . '</span>',
                            '<span class="badge bg-success text-white">' . (int)$item->completed_count . '</span>',
                            '<span class="badge bg-warning text-dark">' . (int)$item->progress_count . '</span>',
                            '<span class="badge bg-secondary text-white">' . (int)$item->not_started_count . '</span>',
                            '<span class="badge bg-danger text-white">' . (int)($item->expired_count ?? 0) . '</span>',
                            '_course_rowspan' => $isFirstParent ? $pCount : 0,
                            '_item_rowspan' => 1,
                            '_rowspans' => [
                                0 => $isFirstParent ? $pCount : 0,
                                1 => $isFirstParent ? $pCount : 0,
                                2 => 1,
                                3 => 1,
                                4 => 1,
                                5 => 1,
                                6 => 1,
                                7 => 1,
                            ],
                        ];
                    } elseif ($sourceKey === 'videos') {
                        $rows[] = [
                            $parentSNo,
                            $colParentHtml,
                            $colChildHtml,
                            '<span class="badge bg-light text-dark border font-smallsize">' . (int)$item->total_count . ' Videos</span>',
                            '<span class="badge bg-success text-white">' . (int)$item->watched_count . '</span>',
                            '<span class="badge bg-light text-muted border">' . (int)$item->unwatched_count . '</span>',
                            '_course_rowspan' => $isFirstParent ? $pCount : 0,
                            '_item_rowspan' => 1,
                            '_rowspans' => [
                                0 => $isFirstParent ? $pCount : 0,
                                1 => $isFirstParent ? $pCount : 0,
                                2 => 1,
                                3 => 1,
                                4 => 1,
                                5 => 1,
                            ],
                        ];
                    } else {
                        $rows[] = [
                            $parentSNo,
                            $colParentHtml,
                            $colChildHtml,
                            (int)$item->total_count,
                            '_course_rowspan' => $isFirstParent ? $pCount : 0,
                            '_item_rowspan' => 1,
                            '_rowspans' => [
                                0 => $isFirstParent ? $pCount : 0,
                                1 => $isFirstParent ? $pCount : 0,
                                2 => 1,
                                3 => 1,
                            ],
                        ];
                    }
                    $isFirstParent = false;
                }
                $parentSNo++;
            }
        } elseif ($groupBy === 'course_and_assessment') {
            $isExam = ($sourceKey === 'exams');
            $isVideo = ($sourceKey === 'videos');
            $itemColTitle = $isVideo ? 'Content Title' : ($isExam ? 'Assignment Exam Name' : 'Assessment Name');
            
            if ($isVideo) {
                $headers = ['S.No', 'Course Name', $itemColTitle, 'Assigned Learners', 'Watched Users', 'Unwatched Users', 'Watch Rate (%)'];
            } elseif ($isExam) {
                $headers = ['S.No', 'Course Name', $itemColTitle, 'Assigned Learners', 'Attempts Written', 'Passed', 'Failed', 'Avg Score (%)'];
            } else {
                $headers = ['S.No', 'Course Name', $itemColTitle, 'Assigned Learners', 'Attempts Written', 'Passed', 'Failed', 'Avg Score (%)'];
            }

            $groupedByCourse = $results->groupBy(function ($item) {
                return $item->group_col1 ?: 'Unassigned Course';
            });

            $courseSNo = 1;
            foreach ($groupedByCourse as $cName => $cItems) {
                $cCount = $cItems->count();
                $isFirstCourse = true;

                $colCourseHtml = '<div class="py-1 text-start" style="min-width: 220px;">' .
                    '<div class="d-flex align-items-center mb-1" style="gap: 8px;">' .
                        '<div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px; background-color: #e0f2f1; color: #008080; font-size: 14px;"><i class="fa-solid fa-book-open"></i></div>' .
                        '<div class="fw-bold text-dark font-smallsize mb-0" style="line-height: 1.35; font-size: 13.5px;">' . htmlspecialchars($cName) . '</div>' .
                    '</div>' .
                    '<div class="d-flex flex-wrap gap-1 mt-1 ms-1">' .
                        '<span class="badge bg-teal text-white font-smallsize" style="background-color: #008080; font-size: 11px;"><i class="fa-solid fa-list-check me-1"></i>' . $cCount . ' ' . ($isVideo ? 'Videos' : ($isExam ? 'Exams' : 'Assessments')) . '</span>' .
                    '</div>' .
                '</div>';

                foreach ($cItems as $item) {
                    $itemName = $item->group_col2 ?: ($isVideo ? 'Video' : ($isExam ? 'Exam' : 'Assessment'));
                    $colItemHtml = '<div class="fw-semibold text-dark font-smallsize"><i class="fa-solid fa-file-lines text-teal me-1" style="color: #008080;"></i>' . htmlspecialchars($itemName) . '</div>';

                    if ($isVideo) {
                        $wCount = (int)($item->watched_count ?? 0);
                        $uCount = (int)($item->unwatched_count ?? 0);
                        $tCount = (int)($item->total_count ?? 0);
                        $wRate = $tCount > 0 ? round(($wCount / $tCount) * 100, 1) . '%' : '0%';
                        $rows[] = [
                            $courseSNo,
                            $colCourseHtml,
                            $colItemHtml,
                            '<span class="badge bg-light text-dark border font-smallsize"><i class="fa-solid fa-users text-teal me-1" style="color: #008080;"></i>' . $tCount . ' Users</span>',
                            '<span class="badge bg-success text-white">' . $wCount . '</span>',
                            '<span class="badge bg-light text-muted border">' . $uCount . '</span>',
                            $wRate,
                            '_course_rowspan' => $isFirstCourse ? $cCount : 0,
                            '_item_rowspan' => 1,
                            '_rowspans' => [
                                0 => $isFirstCourse ? $cCount : 0,
                                1 => $isFirstCourse ? $cCount : 0,
                                2 => 1,
                                3 => 1,
                                4 => 1,
                                5 => 1,
                                6 => 1,
                            ],
                        ];
                    } else {
                        $rows[] = [
                            $courseSNo,
                            $colCourseHtml,
                            $colItemHtml,
                            '<span class="badge bg-light text-dark border font-smallsize"><i class="fa-solid fa-users text-teal me-1" style="color: #008080;"></i>' . (int)$item->total_count . ' Users</span>',
                            (int)$item->written_count,
                            '<span class="badge bg-success text-white">' . (int)$item->passed_count . '</span>',
                            '<span class="badge bg-danger text-white">' . (int)$item->failed_count . '</span>',
                            "{$item->avg_score}%",
                            '_course_rowspan' => $isFirstCourse ? $cCount : 0,
                            '_item_rowspan' => 1,
                            '_rowspans' => [
                                0 => $isFirstCourse ? $cCount : 0,
                                1 => $isFirstCourse ? $cCount : 0,
                                2 => 1,
                                3 => 1,
                                4 => 1,
                                5 => 1,
                                6 => 1,
                            ],
                        ];
                    }
                    $isFirstCourse = false;
                }
                $courseSNo++;
            }
        } elseif (!empty($groupBy)) {
            $calcType = !empty($calculation['type']) ? strtoupper($calculation['type']) : 'COUNT';
            $calcLabel = $source['summary_options'][$calcType] ?? (ucfirst(strtolower($calcType)) . ' Total');
            $groupFieldLabel = $source['group_by'][$groupBy] ?? ($source['fields'][$groupBy]['label'] ?? $groupBy);
            $headers = [
                'S.No',
                $groupFieldLabel,
                $calcLabel,
            ];

            $sNo = 1;
            foreach ($results as $item) {
                $rawLabel = $item->group_label;
                if ($rawLabel === null || $rawLabel === '' || $rawLabel === '-') {
                    $label = 'Unassigned';
                } elseif ($groupBy === 'users.active' || $groupBy === 'tbl_courses.active' || $groupBy === 'tbl_certificates.status') {
                    $label = ($rawLabel == '1' || $rawLabel === 1 || strtolower((string)$rawLabel) === 'active') ? 'Active' : 'Inactive';
                } elseif ($groupBy === 'tbl_assignedusers.status') {
                    $label = ($rawLabel == '3' || $rawLabel === 3 || strtolower((string)$rawLabel) === 'completed') ? 'Completed' : (($rawLabel == '1' || $rawLabel === 1 || strtolower((string)$rawLabel) === 'in progress') ? 'In Progress' : 'Not Started');
                } elseif ($groupBy === 'tbl_employee_feedback_ratings.type') {
                    $label = ($rawLabel == '1' || $rawLabel === 1 || strtolower((string)$rawLabel) === 'overall') ? 'Overall' : 'Category';
                } elseif ($groupBy === 'tbl_employee_feedback_ratings.rating') {
                    $label = str_ends_with((string)$rawLabel, '★') ? (string)$rawLabel : ((string)$rawLabel . ' ★');
                } else {
                    $label = (string)$rawLabel;
                }
                $val = $item->calc_val ?? 0;
                if (is_numeric($val)) {
                    $val = (floor($val) == $val) ? (int)$val : (float)number_format((float)$val, 2, '.', '');
                }
                $rows[] = [
                    $sNo++,
                    $label,
                    $val,
                    '_rowspans' => [0 => 1, 1 => 1, 2 => 1],
                ];
            }
        } else {
            $headers = ['S.No'];
            foreach ($selectedFields as $f) {
                $fLabel = $source['fields'][$f]['label'] ?? $f;
                if (in_array(strtolower(trim($fLabel)), ['id', 'user id', 'course id', 'assignment id', 'enrollment id'])) {
                    continue;
                }
                $headers[] = $fLabel;
            }

            $hasLearnerFields = false;
            foreach ($selectedFields as $sf) {
                if (str_starts_with($sf, 'users.') || $sf === 'tbl_assignedusers.id' || $sf === 'tbl_assignedusers.user_id') {
                    $hasLearnerFields = true;
                    break;
                }
            }

            // If learner fields are omitted in assessments/exams/videos, consolidate per Course (or Course + Assessment) so each row has exactly 1 result badge
            if (!$hasLearnerFields && in_array($sourceKey, ['assessments', 'exams', 'videos'])) {
                $hasItemField = in_array('tbl_course_documents_list.file_name', $selectedFields) || in_array('tbl_assignment_exams.name', $selectedFields);

                $groupedResults = $results->groupBy(function ($item) use ($hasItemField) {
                    $cName = $item->tbl_courses__course_name ?? $item->tbl_courses__id ?? 'course';
                    $iName = $hasItemField ? ($item->tbl_course_documents_list__file_name ?? $item->tbl_assignment_exams__name ?? '') : '';
                    return $cName . '___' . $iName;
                });

                $consolidatedResults = collect();
                foreach ($groupedResults as $group) {
                    $bestItem = $group->first();
                    $bestPriority = 0;

                    foreach ($group as $gItem) {
                        $prio = 1; // Not Attempted
                        $resVal = strtolower(trim((string)($gItem->tbl_course_assessment_result__pass_fail ?? $gItem->tbl_exam_attempts__exam_result ?? '')));
                        if ($resVal === 'passed' || $resVal === 'pass') {
                            $prio = 4;
                        } elseif ($resVal === 'failed' || $resVal === 'fail') {
                            $prio = 3;
                        } elseif ($resVal === 'pending') {
                            $prio = 2;
                        }
                        if ($prio > $bestPriority) {
                            $bestPriority = $prio;
                            $bestItem = $gItem;
                        }
                    }
                    $consolidatedResults->push($bestItem);
                }
                $results = $consolidatedResults;
            }

            $seenRowKeys = [];
            $itemSNo = 1;
            foreach ($results as $item) {
                $row = [$itemSNo];
                $cId = (int)($item->_meta_course_id ?? ($item->tbl_courses__id ?? 0));
                $cCode = $item->_meta_course_code ?? ($item->tbl_courses__course_code ?? ($cId ? 'C-' . $cId : ''));

                foreach ($selectedFields as $f) {
                    $fieldDef = $source['fields'][$f] ?? [];
                    $fLabel = $fieldDef['label'] ?? $f;
                    if (in_array(strtolower(trim($fLabel)), ['id', 'user id', 'course id', 'assignment id', 'enrollment id'])) {
                        continue;
                    }
                    $alias = str_replace('.', '__', $f);
                    $val = $item->$alias ?? '-';

                    $badgeStyleFlat = 'style="display: inline-flex; align-items: center; justify-content: center; min-width: 95px; height: 24px; box-shadow: none !important; font-size: 11.5px; font-weight: 500;"';

                    // Format Pass / Fail Result badge
                    if ($f === 'tbl_course_assessment_result.pass_fail' || $f === 'tbl_exam_attempts.exam_result' || $f === 'tbl_assignedusers.result') {
                        $items = explode('<br>', (string)$val);
                        $formattedItems = [];
                        foreach ($items as $itemStr) {
                            $strVal = strtolower(trim($itemStr));
                            if ($strVal === 'passed' || $strVal === 'pass') {
                                $badgeHtml = '<span class="badge rounded-1 bg-success text-white shadow-none" ' . $badgeStyleFlat . '>Passed</span>';
                            } elseif ($strVal === 'failed' || $strVal === 'fail') {
                                $badgeHtml = '<span class="badge rounded-1 bg-danger text-white shadow-none" ' . $badgeStyleFlat . '>Failed</span>';
                            } elseif ($strVal === 'pending') {
                                $badgeHtml = '<span class="badge rounded-1 bg-warning text-dark shadow-none" ' . $badgeStyleFlat . '>Pending</span>';
                            } elseif ($strVal === 'not attempted' || $strVal === '-') {
                                $badgeHtml = '<span class="badge rounded-1 bg-light text-muted border shadow-none" ' . $badgeStyleFlat . '>Not Attempted</span>';
                            } else {
                                $badgeHtml = htmlspecialchars($itemStr);
                            }
                            $formattedItems[] = '<div class="line-item-entry py-1 d-flex align-items-center justify-content-center" style="min-height: 28px;">' . $badgeHtml . '</div>';
                        }
                        $val = implode('', $formattedItems);
                    }
                    // Format Status badge
                    elseif ($f === 'tbl_course_assessment_result.status' || $f === 'tbl_assignedusers.status' || $f === 'tbl_assignedusers.progress_status' || $f === 'tbl_courses.course_status') {
                        $items = explode('<br>', (string)$val);
                        $formattedItems = [];
                        foreach ($items as $itemStr) {
                            $strVal = strtolower(trim($itemStr));
                            if ($strVal === 'completed' || $strVal === '3') {
                                $badgeHtml = '<span class="badge rounded-1 bg-success text-white shadow-none" ' . $badgeStyleFlat . '>Completed</span>';
                            } elseif ($strVal === 'watched') {
                                $badgeHtml = '<span class="badge rounded-1 bg-success text-white shadow-none" ' . $badgeStyleFlat . '>Watched</span>';
                            } elseif ($strVal === 'not watched') {
                                $badgeHtml = '<span class="badge rounded-1 bg-light text-muted border shadow-none" ' . $badgeStyleFlat . '>Not Watched</span>';
                            } elseif ($strVal === 'in progress' || $strVal === '1') {
                                $badgeHtml = '<span class="badge rounded-1 bg-warning text-dark shadow-none" ' . $badgeStyleFlat . '>In Progress</span>';
                            } elseif ($strVal === 'not started' || $strVal === '0' || $strVal === '-') {
                                $badgeHtml = '<span class="badge rounded-1 bg-secondary text-white shadow-none" ' . $badgeStyleFlat . '>Not Started</span>';
                            } elseif ($strVal === 'expired') {
                                $badgeHtml = '<span class="badge rounded-1 bg-danger text-white shadow-none" ' . $badgeStyleFlat . '>Expired</span>';
                            } else {
                                $badgeHtml = htmlspecialchars($itemStr);
                            }
                            $formattedItems[] = '<div class="line-item-entry py-1 d-flex align-items-center justify-content-center" style="min-height: 28px;">' . $badgeHtml . '</div>';
                        }
                        $val = implode('', $formattedItems);
                    }
                    // Format Assessment / Exam Name
                    elseif ($f === 'tbl_course_documents_list.file_name' || $f === 'tbl_assignment_exams.name') {
                        $items = explode('<br>', (string)$val);
                        $formattedItems = [];
                        foreach ($items as $itemStr) {
                            $itemTrim = trim($itemStr);
                            if ($itemTrim === '' || $itemTrim === '-') {
                                $formattedItems[] = '<div class="line-item-entry py-1 d-flex align-items-center text-muted" style="min-height: 28px;">-</div>';
                            } else {
                                $formattedItems[] = '<div class="line-item-entry py-1 d-flex align-items-center text-start" style="min-height: 28px;"><i class="fa-solid fa-file-circle-check text-teal me-2" style="color: #008080; font-size: 13px;"></i><span class="fw-semibold text-dark">' . htmlspecialchars($itemTrim) . '</span></div>';
                            }
                        }
                        $val = implode('', $formattedItems);
                    }
                    // Format Learner Name
                    elseif ($f === 'users.first_name') {
                        $items = explode('<br>', (string)$val);
                        $formattedItems = [];
                        foreach ($items as $itemStr) {
                            $itemTrim = trim($itemStr);
                            if ($itemTrim === '' || $itemTrim === '-') {
                                $formattedItems[] = '<div class="line-item-entry py-1 d-flex align-items-center text-muted" style="min-height: 28px;">-</div>';
                            } else {
                                $formattedItems[] = '<div class="line-item-entry py-1 d-flex align-items-center text-start" style="min-height: 28px;"><i class="fa-solid fa-user text-teal me-2" style="color: #008080; font-size: 13px;"></i><span class="fw-semibold text-dark">' . htmlspecialchars($itemTrim) . '</span></div>';
                            }
                        }
                        $val = implode('', $formattedItems);
                    }
                    // Format boolean/status
                    elseif ($f === 'users.active') {
                        $valStr = strtolower(trim((string)$val));
                        if ($valStr === '2' || $valStr === 'deactivated') {
                            $val = '<span class="badge rounded-1 bg-danger text-white shadow-none" ' . $badgeStyleFlat . '>Deactivated</span>';
                        } elseif ($valStr === '1' || $valStr === 'active') {
                            $val = '<span class="badge rounded-1 bg-success text-white shadow-none" ' . $badgeStyleFlat . '>Active</span>';
                        } else {
                            $val = '<span class="badge rounded-1 bg-warning text-dark shadow-none" ' . $badgeStyleFlat . '>Inactive</span>';
                        }
                    } elseif ($f === 'users.deactivation_reason') {
                        $trimmedReason = trim((string)$val);
                        if ($trimmedReason === '' || $trimmedReason === '-') {
                            $val = '<span class="text-muted">-</span>';
                        } else {
                            $val = '<div class="d-flex align-items-center text-start"><i class="fa-solid fa-circle-info text-warning me-1"></i><span class="text-dark font-smallsize">' . htmlspecialchars($trimmedReason) . '</span></div>';
                        }
                    } elseif ($f === 'users.deactivation_date') {
                        $trimmedDate = trim((string)$val);
                        if ($trimmedDate === '' || $trimmedDate === '-') {
                            $val = '<span class="text-muted">-</span>';
                        } else {
                            try {
                                $val = \Carbon\Carbon::parse($trimmedDate)->format('d M Y, h:i A');
                            } catch (\Exception $e) {
                                $val = htmlspecialchars($trimmedDate);
                            }
                        }
                    } elseif ($f === 'tbl_courses.active' || $f === 'tbl_certificates.status') {
                        if ($val !== 'Active' && $val !== 'Inactive') {
                            $val = ($val == '1' || $val === 1 || strtolower((string)$val) === 'active') ? '<span class="badge rounded-1 bg-success text-white shadow-none" ' . $badgeStyleFlat . '>Active</span>' : '<span class="badge rounded-1 bg-warning text-dark shadow-none" ' . $badgeStyleFlat . '>Inactive</span>';
                        }
                    } elseif ($f === 'tbl_employee_feedback_ratings.type') {
                        if ($val !== 'Overall' && $val !== 'Category') {
                            $val = ($val == '1' || $val === 1 || strtolower((string)$val) === 'overall') ? 'Overall' : 'Category';
                        }
                    } elseif ($f === 'tbl_course_documents_list.type') {
                        $items = explode('<br>', (string)$val);
                        $formattedItems = [];
                        foreach ($items as $itemStr) {
                            $tVal = strtolower(trim($itemStr));
                            if ($tVal === '1' || $tVal === 'amazon') {
                                $label = 'Amazon';
                            } elseif ($tVal === '2' || $tVal === 'youtube') {
                                $label = 'YouTube';
                            } elseif ($tVal === '3' || $tVal === 'local') {
                                $label = 'Local Video';
                            } elseif ($tVal === '4' || $tVal === 'scorm') {
                                $label = 'SCORM';
                            } elseif ($tVal === '5' || $tVal === 'attachments' || $tVal === 'attachment') {
                                $label = 'Attachment';
                            } elseif ($tVal === '' || $tVal === '-') {
                                $label = '-';
                            } else {
                                $label = trim($itemStr);
                            }
                            $formattedItems[] = '<div class="line-item-entry py-1 d-flex align-items-center justify-content-center text-dark" style="min-height: 28px;">' . htmlspecialchars($label) . '</div>';
                        }
                        $val = implode('', $formattedItems);
                    }

                    // Format float / decimal numbers to max 2 decimals (e.g. 73.33 instead of 73.3299999...)
                    if (is_numeric($val) && strpos((string)$val, '.') !== false) {
                        $val = (float)number_format((float)$val, 2, '.', '');
                    }

                    // Format ISO date or MySQL datetime strings to 12-hour readable format
                    if (is_string($val) && preg_match('/^\d{4}-\d{2}-\d{2}[\sT]\d{2}:\d{2}/', $val)) {
                        $time = strtotime($val);
                        if ($time !== false && $time > 0) {
                            $val = date('d-M-Y h:i A', $time);
                        }
                    } elseif (is_string($val) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $val)) {
                        $time = strtotime($val);
                        if ($time !== false && $time > 0) {
                            $val = date('d-M-Y', $time);
                        }
                    }

                    // For other multi-line columns (e.g. score, percentage, time spent) wrap each line for clean alignment
                    if (is_string($val) && strpos($val, '<br>') !== false && strpos($val, 'line-item-entry') === false) {
                        $items = explode('<br>', $val);
                        $formattedItems = [];
                        foreach ($items as $itemStr) {
                            $formattedItems[] = '<div class="line-item-entry py-1 d-flex align-items-center justify-content-center" style="min-height: 28px;">' . trim($itemStr) . '</div>';
                        }
                        $val = implode('', $formattedItems);
                    }

                    $row[] = $val;
                }

                // Global logical deduplication across entire report to prevent duplicate rows when learner column is omitted (excluding S.No)
                $dataCols = array_slice($row, 1);
                $rowKey = md5(json_encode(array_map(function ($c) {
                    return $this->cleanCellForExport($c);
                }, $dataCols)));
                if (isset($seenRowKeys[$rowKey])) {
                    continue;
                }
                $seenRowKeys[$rowKey] = true;

                $rows[] = $row;
                $itemSNo++;
            }

            // Apply dynamic rowspans so parent entities (Course, Assessment, Module, Video) never duplicate
            $rows = $this->applyDynamicRowspans($rows, $headers);
        }

        // Format chart data if requested
        $chartData = null;
        if (in_array($outputType, ['bar', 'line', 'pie', 'doughnut'])) {
            $labels = [];
            $dataPoints = [];
            $colors = [
                '#008080', '#20b2aa', '#3cb371', '#4682b4', '#4169e1',
                '#6a5acd', '#9370db', '#ba55d3', '#db7093', '#e9967a',
                '#f4a460', '#d2b48c', '#8fbc8f', '#00ced1', '#1e90ff'
            ];

            $hasSNo = !empty($headers) && ($headers[0] === 'S.No' || $headers[0] === '#');
            if (!empty($groupBy)) {
                $lblIdx = $hasSNo ? 1 : 0;
                $valIdx = $hasSNo ? 2 : 1;
                foreach ($rows as $r) {
                    $labels[] = $r[$lblIdx] ?? '';
                    $dataPoints[] = (float)($r[$valIdx] ?? 0);
                }
            } else {
                // If not grouped, group by first string/category column or take counts
                $labelColIndex = $hasSNo ? 1 : 0;
                $counts = [];
                foreach ($rows as $r) {
                    $key = isset($r[$labelColIndex]) ? (string)$r[$labelColIndex] : 'Other';
                    $counts[$key] = ($counts[$key] ?? 0) + 1;
                }
                // Top 15 categories for visual cleanliness
                $topCounts = array_slice($counts, 0, 15, true);
                $labels = array_keys($topCounts);
                $dataPoints = array_values($topCounts);
            }

            $dataset = [
                'label' => !empty($config['name']) ? $config['name'] : 'Report Data',
                'data' => $dataPoints,
            ];

            if ($outputType === 'pie' || $outputType === 'doughnut') {
                $bgColors = [];
                for ($i = 0; $i < count($dataPoints); $i++) {
                    $bgColors[] = $colors[$i % count($colors)];
                }
                $dataset['backgroundColor'] = $bgColors;
                $dataset['borderColor'] = '#ffffff';
                $dataset['borderWidth'] = 2;
            } elseif ($outputType === 'line') {
                $dataset['backgroundColor'] = 'rgba(0, 128, 128, 0.15)';
                $dataset['borderColor'] = '#008080';
                $dataset['borderWidth'] = 2;
                $dataset['fill'] = true;
                $dataset['tension'] = 0.3;
                $dataset['pointBackgroundColor'] = '#008080';
                $dataset['pointRadius'] = 4;
            } else { // bar
                $dataset['backgroundColor'] = '#008080';
                $dataset['borderColor'] = '#008080';
                $dataset['borderWidth'] = 1;
                $dataset['borderRadius'] = 4;
            }

            $chartData = [
                'type' => $outputType,
                'labels' => $labels,
                'datasets' => [$dataset],
            ];
        }

        return [
            'headers' => $headers,
            'rows' => $rows,
            'hierarchy' => $hierarchy ?? [],
            'total_count' => count($rows),
            'chart_data' => $chartData,
            'output_type' => $outputType,
        ];
    }

    /**
     * Post-process flat report rows to merge consecutive identical parent & child cells using rowspans.
     */
    public function applyDynamicRowspans(array $rows, array $headers): array
    {
        $rowCount = count($rows);
        if ($rowCount <= 0 || empty($headers)) {
            return $rows;
        }

        $colCount = count($headers);
        $hasSNo = !empty($headers) && ($headers[0] === 'S.No' || $headers[0] === '#');
        $rootColIdx = $hasSNo ? 1 : 0;

        if ($colCount <= $rootColIdx) {
            return $rows;
        }

        $rootHeader = trim(strtolower($headers[$rootColIdx] ?? ''));
        $isRootGroupable = str_contains($rootHeader, 'course') 
                        || str_contains($rootHeader, 'category') 
                        || str_contains($rootHeader, 'department') 
                        || str_contains($rootHeader, 'learner') 
                        || str_contains($rootHeader, 'user') 
                        || str_contains($rootHeader, 'name') 
                        || str_contains($rootHeader, 'email') 
                        || str_contains($rootHeader, 'team') 
                        || str_contains($rootHeader, 'trainer');

        if (!$isRootGroupable || $rowCount === 1) {
            for ($k = 0; $k < $rowCount; $k++) {
                if ($hasSNo) {
                    $rows[$k][0] = $k + 1;
                }
                for ($c = 0; $c < $colCount; $c++) {
                    $rows[$k]['_rowspans'][$c] = 1;
                }
            }
            return $rows;
        }

        $isLearnerRoot = !str_contains($rootHeader, 'course') && (
            str_contains($rootHeader, 'learner') || 
            str_contains($rootHeader, 'user') || 
            str_contains($rootHeader, 'name') ||
            str_contains($rootHeader, 'email')
        );

        $i = 0;
        $parentSNo = 1;
        while ($i < $rowCount) {
            $parentVal = $this->cleanCellForExport($rows[$i][$rootColIdx] ?? '');
            $j = $i;
            while ($j + 1 < $rowCount && $this->cleanCellForExport($rows[$j + 1][$rootColIdx] ?? '') === $parentVal) {
                $j++;
            }

            $parentSpan = $j - $i + 1;

            if ($hasSNo) {
                $rows[$i][0] = $parentSNo;
                $rows[$i]['_rowspans'][0] = $parentSpan;
                for ($k = $i + 1; $k <= $j; $k++) {
                    $rows[$k][0] = $parentSNo;
                    $rows[$k]['_rowspans'][0] = 0;
                }
            }

            if ($isLearnerRoot) {
                // CASE A: Learner is the root entity (Learners Progress Matrix)
                // 1. Learner profile columns (Name, Email, Dept, Designation, Status, Total Courses) -> Merged single time across all rows for this learner
                // 2. Course columns (Course Name, Course Code, Category, Progress Status) -> Merged single time per course under this learner
                // 3. Assessment / Exam / Result columns -> Row-level per assessment under that course
                for ($col = $rootColIdx; $col < $colCount; $col++) {
                    $hName = trim(strtolower($headers[$col] ?? ''));

                    // Root column: Learner Name
                    if ($col === $rootColIdx) {
                        $rows[$i]['_rowspans'][$rootColIdx] = $parentSpan;
                        for ($k = $i + 1; $k <= $j; $k++) {
                            $rows[$k]['_rowspans'][$rootColIdx] = 0;
                        }
                        continue;
                    }

                    // Learner profile fields
                    $isLearnerProperty = str_contains($hName, 'email') 
                                      || str_contains($hName, 'department') 
                                      || str_contains($hName, 'designation') 
                                      || str_contains($hName, 'employee') 
                                      || str_contains($hName, 'emp id') 
                                      || str_contains($hName, 'total assigned') 
                                      || str_contains($hName, 'completed courses') 
                                      || str_contains($hName, 'in progress courses') 
                                      || str_contains($hName, 'not started courses') 
                                      || str_contains($hName, 'completion rate') 
                                      || str_contains($hName, 'certificates') 
                                      || str_contains($hName, 'last login') 
                                      || str_contains($hName, 'registration date') 
                                      || ($hName === 'status');

                    if ($isLearnerProperty) {
                        $rows[$i]['_rowspans'][$col] = $parentSpan;
                        for ($k = $i + 1; $k <= $j; $k++) {
                            $rows[$k]['_rowspans'][$col] = 0;
                        }
                        continue;
                    }

                    // Course level fields under this learner (Course Name, Course Code, Category, Course Status)
                    $isCourseProperty = str_contains($hName, 'course name') 
                                     || str_contains($hName, 'course code') 
                                     || str_contains($hName, 'course category') 
                                     || str_contains($hName, 'category') 
                                     || str_contains($hName, 'course status') 
                                     || str_contains($hName, 'progress') 
                                     || str_contains($hName, 'course assigned date') 
                                     || str_contains($hName, 'due / expiration date') 
                                     || str_contains($hName, 'expiration date');

                    if ($isCourseProperty) {
                        // Find course name column index to ensure sub-grouping respects course boundaries
                        $courseColIdx = -1;
                        for ($cc = 0; $cc < $colCount; $cc++) {
                            $chkH = trim(strtolower($headers[$cc] ?? ''));
                            if ($chkH === 'course name' || str_contains($chkH, 'course name')) {
                                $courseColIdx = $cc;
                                break;
                            }
                        }
                        $subGroupCol = ($courseColIdx !== -1) ? $courseColIdx : $col;

                        $subI = $i;
                        while ($subI <= $j) {
                            $val = $this->cleanCellForExport($rows[$subI][$subGroupCol] ?? '');
                            $subJ = $subI;
                            while ($subJ + 1 <= $j && $this->cleanCellForExport($rows[$subJ + 1][$subGroupCol] ?? '') === $val) {
                                $subJ++;
                            }

                            $span = $subJ - $subI + 1;
                            $rows[$subI]['_rowspans'][$col] = $span;
                            for ($k = $subI + 1; $k <= $subJ; $k++) {
                                $rows[$k]['_rowspans'][$col] = 0;
                            }

                            $subI = $subJ + 1;
                        }
                        continue;
                    }

                    // All remaining columns: Assessment / Exam / Result / Score / Status
                    // Each row is an individual assessment attempt under the course
                    for ($k = $i; $k <= $j; $k++) {
                        $rows[$k]['_rowspans'][$col] = 1;
                    }
                }
            } else {
                // CASE B: Course is the root entity (Course / Assessment / Exam / Video / Enrollment sources)
                // 1. Course columns (Course Name, Course Code, Category, Due Date, Trainer) -> Merged single time across all rows for this course
                // 2. Assessment / Exam / Video columns -> Merged single time per item under this course
                // 3. Learner & Result columns -> Row-level per learner
                for ($col = $rootColIdx; $col < $colCount; $col++) {
                    $hName = trim(strtolower($headers[$col] ?? ''));

                    // Root column is always the parent entity (e.g. Course Name)
                    if ($col === $rootColIdx) {
                        $rows[$i]['_rowspans'][$rootColIdx] = $parentSpan;
                        for ($k = $i + 1; $k <= $j; $k++) {
                            $rows[$k]['_rowspans'][$rootColIdx] = 0;
                        }
                        continue;
                    }

                    // If column is a Course property (Course Code, Category, Due Date, Trainer)
                    $isCourseProperty = str_contains($rootHeader, 'course') && (
                        str_contains($hName, 'course code') || 
                        str_contains($hName, 'code') || 
                        str_contains($hName, 'category') || 
                        str_contains($hName, 'expiration') || 
                        str_contains($hName, 'due date') || 
                        str_contains($hName, 'trainer')
                    );

                    if ($isCourseProperty) {
                        $rows[$i]['_rowspans'][$col] = $parentSpan;
                        for ($k = $i + 1; $k <= $j; $k++) {
                            $rows[$k]['_rowspans'][$col] = 0;
                        }
                        continue;
                    }

                    // If column is Assessment / Exam / Video Title (Item level grouping under Course)
                    $isItemEntity = str_contains($hName, 'assessment name') || 
                                    str_contains($hName, 'assessment title') || 
                                    str_contains($hName, 'quiz') || 
                                    str_contains($hName, 'assignment name') || 
                                    str_contains($hName, 'assignment exam') || 
                                    str_contains($hName, 'video') || 
                                    str_contains($hName, 'content title');

                    if ($isItemEntity) {
                        $subI = $i;
                        while ($subI <= $j) {
                            $val = $this->cleanCellForExport($rows[$subI][$col] ?? '');
                            $subJ = $subI;
                            while ($subJ + 1 <= $j && $this->cleanCellForExport($rows[$subJ + 1][$col] ?? '') === $val) {
                                $subJ++;
                            }

                            $span = $subJ - $subI + 1;
                            $rows[$subI]['_rowspans'][$col] = $span;
                            for ($k = $subI + 1; $k <= $subJ; $k++) {
                                $rows[$k]['_rowspans'][$col] = 0;
                            }

                            $subI = $subJ + 1;
                        }
                        continue;
                    }

                    // For all other columns (Learner Name, Email, Emp ID, Department, Designation, Result, Score, Marks, Status, Date, Time, etc.):
                    for ($k = $i; $k <= $j; $k++) {
                        $rows[$k]['_rowspans'][$col] = 1;
                    }
                }
            }

            // Legacy backward-compatibility variables
            $rows[$i]['_course_rowspan'] = $parentSpan;
            for ($k = $i + 1; $k <= $j; $k++) {
                $rows[$k]['_course_rowspan'] = 0;
            }
            if (isset($rows[$i]['_rowspans'][$rootColIdx + 1])) {
                $rows[$i]['_item_rowspan'] = $rows[$i]['_rowspans'][$rootColIdx + 1];
            }

            $parentSNo++;
            $i = $j + 1;
        }

        return $rows;
    }

    /**
     * Clean cell content for exports (CSV, Excel, PDF).
     */
    public function cleanCellForExport($cell)
    {
        if ($cell === null || $cell === '') {
            return '-';
        }

        $str = (string)$cell;

        // If no HTML tags, return trimmed string
        if (strpos($str, '<') === false) {
            return trim($str);
        }

        // Add space between title and (Course ID: ...)
        $str = preg_replace('/([^\s])(\(Course ID:)/i', '$1 $2', $str);

        // Replace </li><li>, </div><div>, <br>, </p><p> with spaces or pipes
        $str = preg_replace('/<\/li>\s*<li[^>]*>/i', " | ", $str);
        $str = preg_replace('/<\/div>\s*<div[^>]*>/i', " ", $str);
        $str = preg_replace('/<br\s*\/?>/i', " ", $str);
        $str = preg_replace('/<\/p>\s*<p[^>]*>/i', " ", $str);

        // Strip all remaining HTML tags
        $str = strip_tags($str);

        // Decode HTML entities (e.g. &amp; -> &)
        $str = html_entity_decode($str, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // Normalize whitespace
        $str = preg_replace('/\s+/', ' ', $str);

        return trim($str) !== '' ? trim($str) : '-';
    }

    /**
     * Format cell content for PDF export (preserves vertical block line-item entries for multiple assessments).
     */
    public function formatCellForPdf($cell)
    {
        if ($cell === null || $cell === '') {
            return '-';
        }

        $str = (string)$cell;

        // If plain text with no tags
        if (strpos($str, '<') === false) {
            $decoded = html_entity_decode($str, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            return htmlspecialchars(trim($decoded));
        }

        // Remove fontawesome icon tags for PDF rendering
        $str = preg_replace('/<i\b[^>]*>(.*?)<\/i>/i', '', $str);

        // If simple <br> without line-item-entry wrapper, wrap each in .line-item-entry block
        if (strpos($str, '<div') === false && strpos($str, '<br') !== false) {
            $parts = preg_split('/<br\s*\/?>/i', $str);
            $formatted = [];
            foreach ($parts as $p) {
                $pTrim = trim($p);
                if ($pTrim !== '') {
                    $decoded = html_entity_decode(strip_tags($pTrim), ENT_QUOTES | ENT_HTML5, 'UTF-8');
                    $formatted[] = '<div class="line-item-entry">' . htmlspecialchars($decoded) . '</div>';
                }
            }
            return !empty($formatted) ? implode('', $formatted) : '-';
        }

        return $str;
    }

    /**
     * Stream CSV Export.
     */
    public function exportCsv(array $config, $reportName = 'Report')
    {
        @ini_set('memory_limit', '1024M');
        @set_time_limit(300);

        $executed = $this->executeReport($config, 10000);
        $slug = \Illuminate\Support\Str::slug($reportName);
        if (empty($slug)) {
            $slug = 'report';
        }
        $fileName = 'report_' . $slug . '_' . date('Ymd_His') . '.csv';
        $headersCount = count($executed['headers']);

        $cleanRows = [];
        foreach ($executed['rows'] as $row) {
            $rowArr = (array)$row;
            $cleanRow = [];
            for ($i = 0; $i < $headersCount; $i++) {
                $cleanRow[] = $this->cleanCellForExport($rowArr[$i] ?? '');
            }
            $cleanRows[] = $cleanRow;
        }

        $callback = function () use ($executed, $cleanRows) {
            $handle = fopen('php://output', 'w');
            // Write BOM for UTF-8 Excel compatibility
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));
            // Write Headers
            fputcsv($handle, $executed['headers']);
            // Write Rows
            foreach ($cleanRows as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        };

        return new StreamedResponse($callback, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }

    /**
     * Clean cell content for Excel export with vertical in-cell line breaks for multiple assessments.
     */
    public function cleanCellForExcel($cell)
    {
        if ($cell === null || $cell === '') {
            return '-';
        }

        $str = (string)$cell;

        if (strpos($str, '<') === false) {
            return htmlspecialchars(trim($str));
        }

        $str = preg_replace('/([^\s])(\(Course ID:)/i', '$1 $2', $str);
        $str = preg_replace('/<i\b[^>]*>(.*?)<\/i>/i', '', $str);
        $str = preg_replace('/<\/div>\s*<div[^>]*>/i', "<br style=\"mso-data-placement:same-cell;\">", $str);
        $str = preg_replace('/<\/li>\s*<li[^>]*>/i', "<br style=\"mso-data-placement:same-cell;\">", $str);
        $str = preg_replace('/<br\s*\/?>/i', "<br style=\"mso-data-placement:same-cell;\">", $str);
        $str = preg_replace('/<\/p>\s*<p[^>]*>/i', "<br style=\"mso-data-placement:same-cell;\">", $str);
        $str = strip_tags($str, '<br>');
        $str = html_entity_decode($str, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $lines = preg_split('/<br\b[^>]*>/i', $str);
        $cleanLines = [];
        foreach ($lines as $line) {
            $lTrim = trim(preg_replace('/\s+/', ' ', $line));
            if ($lTrim !== '') {
                $cleanLines[] = htmlspecialchars($lTrim);
            }
        }

        return !empty($cleanLines) ? implode('<br style="mso-data-placement:same-cell;"/>', $cleanLines) : '-';
    }

    /**
     * Excel Export (.xls / HTML-Excel format).
     */
    public function exportExcel(array $config, $reportName = 'Report')
    {
        @ini_set('memory_limit', '1024M');
        @set_time_limit(300);

        $executed = $this->executeReport($config, 10000);
        $slug = \Illuminate\Support\Str::slug($reportName) ?: 'report';
        $fileName = 'report_' . $slug . '_' . date('Ymd_His') . '.xls';
        $headers = $executed['headers'];
        $headersCount = count($headers);

        $content = "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><style>";
        $content .= "body{font-family:Calibri,Arial,sans-serif;color:#000000;font-size:11pt;}";
        $content .= "h3{color:#008080;font-size:14pt;margin:0 0 4px 0;}";
        $content .= "p{color:#475569;font-size:10pt;margin:0 0 10px 0;}";
        $content .= "table{border-collapse:collapse;color:#000000;width:100%;}";
        $content .= "th{background-color:#008080;color:#ffffff;font-weight:bold;padding:8px 8px;border:1px solid #006666;vertical-align:middle;text-align:left;}";
        $content .= "td{padding:6px 8px;border:1px solid #cbd5e1;vertical-align:top;color:#000000;mso-number-format:\"\\@\";font-size:10pt;white-space:normal;}";
        $content .= ".text-center{text-align:center;}";
        $content .= "</style></head><body>";
        $content .= "<h3>" . htmlspecialchars($reportName) . "</h3>";
        $content .= "<p>Generated On: " . date('d-M-Y h:i A') . "</p>";
        $content .= "<table border=\"1\" style=\"border-collapse:collapse;\"><thead><tr>";
        foreach ($headers as $h) {
            $thAlign = (str_contains($h, 'Attempts') || str_contains($h, 'Score') || str_contains($h, 'Marks') || str_contains($h, 'Result') || str_contains($h, 'Time') || str_contains($h, 'Status') || str_contains($h, 'Date')) ? 'text-align:center;' : '';
            $content .= "<th style=\"{$thAlign}\">" . htmlspecialchars($h) . "</th>";
        }
        $content .= "</tr></thead><tbody>";

        foreach ($executed['rows'] as $row) {
            $rowArr = (array)$row;
            $rowspans = $rowArr['_rowspans'] ?? null;

            $content .= "<tr>";
            if (!empty($rowspans) && is_array($rowspans)) {
                for ($i = 0; $i < $headersCount; $i++) {
                    $span = $rowspans[$i] ?? 1;
                    if ($span > 0) {
                        $hName = $headers[$i] ?? '';
                        $isCenter = str_contains($hName, 'Attempts') || str_contains($hName, 'Result') || str_contains($hName, 'Marks') || str_contains($hName, 'Score') || str_contains($hName, 'Time') || str_contains($hName, 'Status') || str_contains($hName, 'Date') || str_contains($hName, 'Completed') || str_contains($hName, 'Count') || str_contains($hName, 'Rate');
                        $alignStyle = $isCenter ? 'class="text-center"' : '';
                        $cleanText = $this->cleanCellForExcel($rowArr[$i] ?? '');
                        $spanAttr = $span > 1 ? "rowspan=\"{$span}\"" : '';
                        $boldStyle = ($i === 0 || $span > 1) ? 'font-weight:bold;background-color:#ffffff;' : '';
                        $content .= "<td {$spanAttr} {$alignStyle} style=\"vertical-align:top;color:#000000;{$boldStyle}\">" . $cleanText . "</td>";
                    }
                }
            } else {
                for ($i = 0; $i < $headersCount; $i++) {
                    $hName = $headers[$i] ?? '';
                    $isCenter = str_contains($hName, 'Attempts') || str_contains($hName, 'Result') || str_contains($hName, 'Marks') || str_contains($hName, 'Score') || str_contains($hName, 'Time') || str_contains($hName, 'Status') || str_contains($hName, 'Date') || str_contains($hName, 'Completed');
                    $alignStyle = $isCenter ? 'class="text-center"' : '';
                    $cleanText = $this->cleanCellForExcel($rowArr[$i] ?? '');
                    $content .= "<td {$alignStyle} style=\"color:#000000;\">" . $cleanText . "</td>";
                }
            }
            $content .= "</tr>";
        }

        $content .= "</tbody></table></body></html>";

        return response($content, 200, [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
            'Cache-Control' => 'max-age=0',
        ]);
    }

    /**
     * PDF Export via DomPDF with vertical block line-items for multiple assessments per course.
     */
    public function exportPdf(array $config, $reportName = 'Report')
    {
        @ini_set('memory_limit', '2048M');
        @set_time_limit(300);

        $executed = $this->executeReport($config, 10000);
        $site = DB::table('tbl_logo_application')->latest()->first();

        $headersCount = count($executed['headers']);

        // DomPDF memory consumption scales with (rows * columns).
        // Dynamically cap records safely to prevent server memory exhaustion.
        if ($headersCount > 25) {
            $maxPdfRows = 50;
        } elseif ($headersCount > 15) {
            $maxPdfRows = 80;
        } elseif ($headersCount > 8) {
            $maxPdfRows = 120;
        } else {
            $maxPdfRows = 200;
        }

        $pdfSourceRows = array_slice($executed['rows'], 0, $maxPdfRows);

        $pdfRows = [];
        foreach ($pdfSourceRows as $row) {
            $rowArr = (array)$row;
            $cleanRow = [];
            for ($i = 0; $i < $headersCount; $i++) {
                $cleanRow[$i] = $this->formatCellForPdf($rowArr[$i] ?? '');
            }
            $pdfRows[] = $cleanRow;
        }

        $paperSize = $headersCount > 12 ? 'a3' : 'a4';

        $pdf = Pdf::loadView('admin.reports.builder.pdf', [
            'reportName' => $reportName,
            'site' => $site,
            'headers' => $executed['headers'],
            'rows' => $pdfRows,
            'totalCount' => $executed['total_count'],
            'totalExported' => count($pdfRows),
            'config' => $config,
        ])
        ->setPaper($paperSize, 'landscape')
        ->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => false,
            'defaultFont' => 'sans-serif',
            'dpi' => 96,
        ]);

        $slug = \Illuminate\Support\Str::slug($reportName) ?: 'report';
        $fileName = 'report_' . $slug . '_' . date('Ymd_His') . '.pdf';
        return $pdf->download($fileName);
    }
}

