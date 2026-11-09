<?php

namespace App\Http\Controllers;

use App\Models\Assessment_results;
use App\Models\Course_documents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Courses;

class CourseSettingsController extends Controller
{

    public function course_settings(Request $request)
    {
        $courseId = $request->query('course_id');

        $coursesQuery = Courses::orderBy('id', 'desc');

        if (!empty($courseId)) {
            $coursesQuery->where('id', $courseId);
        }

        $courses = $coursesQuery->get();

        $courseIds = $courses->pluck('id');

        $assessments = DB::table('tbl_course_documents_list')
            ->whereIn('course_id', $courseIds)
            ->where('type', 6)
            ->where('is_delete', 0)
            ->where('is_active', 1)
            ->get()
            ->groupBy('course_id');

        $html = view('admin.coursecatalog.courses_settings', compact('courses', 'assessments'))->render();

        return response()->json(['html' => $html]);
    }


    public function update_due_date(Request $request)
    {
        $request->validate([
            'type'     => 'required|in:course,assessment',
            'id'       => 'required|integer',
            'due_date' => 'required|date',
        ]);

        $uniqueCode = null;
        $queryRan   = false; // Tracks whether we actually attempted an update (not row-count based)

        if ($request->type === 'course') {
            // Fetch the course to get its unique code (e.g., 'course_code')
            $course = DB::table('tbl_courses')->where('id', $request->id)->first();

            if ($course) {
                $uniqueCode = $course->course_code ?? null;

                if ($uniqueCode) {
                    Log::info("update_due_date: unique_code FOUND for course id {$request->id} -> {$uniqueCode}");
                } else {
                    Log::warning("update_due_date: unique_code NOT FOUND (course_code column empty/null) for course id {$request->id}");
                }

                DB::table('tbl_courses')
                    ->where('id', $request->id)
                    ->update(['expiration_date' => $request->due_date]);

                $queryRan = true;
            } else {
                Log::warning("update_due_date: course id {$request->id} not found.");
            }

        } else {
            // Assessment (course document) branch
            $document = DB::table('tbl_course_documents_list')->where('id', $request->id)->first();

            if ($document) {
                DB::table('tbl_course_documents_list')
                    ->where('id', $request->id)
                    ->update(['expiration_date' => $request->due_date]);

                $queryRan = true;

                // The real match key for the external system lives inside file_path,
                // e.g. quiz/ceco-dr-m1-flowchart-assessment/qsd_EiLw5fXc0hk/instructions
                // Extract the "qsd_XXXXXXXXXX" segment — this is the exact value stored
                // in the external `quiz_schedules`.`code` column.
                if (!empty($document->file_path) && preg_match('/qsd_[A-Za-z0-9]+/', $document->file_path, $matches)) {
                    $uniqueCode = $matches[0];
                } else {
                    $uniqueCode = null;
                }

                if ($uniqueCode) {
                    //Log::info("update_due_date: unique_code (qsd code) FOUND for assessment id {$request->id} in file_path -> {$uniqueCode}");
                } else {
                    Log::warning("update_due_date: unique_code NOT FOUND — no 'qsd_...' pattern in file_path for assessment id {$request->id}. file_path: " . ($document->file_path ?? 'NULL'));
                }
            } else {
                Log::warning("update_due_date: assessment/document id {$request->id} not found.");
            }
        }

        // ==========================================
        // HIT EXTERNAL API AT 
        // ==========================================
        if ($uniqueCode && $queryRan) {
            try {
                $apiResponse = Http::withHeaders([
                    'Accept' => 'application/json',
                ])->post('https://assessment.digicat.ai/api/update-due-date', [
                    'unique_code' => $uniqueCode,
                    'due_date'    => $request->due_date,
                    'type'        => $request->type,
                ]);

                //  Log::info('assessment.digicat.ai update-due-date response: '
                //      . $apiResponse->status() . ' - ' . $apiResponse->body());

                if ($apiResponse->failed()) {
                    Log::error('Failed to update due date on assessment.digicat.ai: ' . $apiResponse->body());
                }
            } catch (\Exception $e) {
                Log::error('API Connection Error to assessment.digicat.ai: ' . $e->getMessage());
            }
        } else {
            // Helps you see WHY the external call was skipped
            Log::info('update_due_date: external API call skipped.', [
                'type'        => $request->type,
                'id'          => $request->id,
                'uniqueCode'  => $uniqueCode,
                'queryRan'    => $queryRan,
            ]);
        }

        return response()->json(['success' => $queryRan]);
    }






}