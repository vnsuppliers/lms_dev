<?php

namespace App\Http\Controllers;
use App\Models\FeedbackRatingsSetting;
use App\Models\EmployeeFeedbackRating;
use App\Models\Asigneduser;
use App\Models\Course_documents;
use App\Models\AssessmentVideoAccess;
use App\Models\Courses;

use Illuminate\Http\Request;

class FeedBackRatingsSettingsController extends Controller
{
    public function updateOrCreateRatingsFeedback(Request $request)
    {
    
    // dd($request->all());

        $request->validate([
            'name' => 'required',
            'is_active' => 'required',
            'rating_enabled' => 'required',
            'feedback_enabled' => 'required',
            'type' => 'required',
            'category_id' => 'nullable|required_if:type,2|exists:tbl_categories,id',
            'course_id' => 'nullable|required_if:type,2|exists:tbl_courses,id'
        ]);

        if ((int) $request->type === 2) {
            $courseBelongsToCategory = Courses::where('id', $request->course_id)
                ->where('category_id', $request->category_id)
                ->exists();

            if (!$courseBelongsToCategory) {
                return redirect('masters?tab=8')->withInput()
                    ->with('error', 'Please select a course that belongs to the selected category.');
            }
        }

        $data = [
            'type' => $request->type,
            'category_id' => (int) $request->type === 2 ? $request->category_id : null,
            'name' => $request->name,
            'is_active' => $request->is_active,
            'rating_enabled' => $request->rating_enabled,
            'feedback_enabled' => $request->feedback_enabled,
            'course_id' => (int) $request->type === 2 ? $request->course_id : null,
        ];

        $exists = FeedbackRatingsSetting::where('name', $request->name)
            ->when($request->id, function ($query) use ($request) {
                $query->where('id', '!=', $request->id);
            })
            ->exists();

        if ($exists) {
            return redirect('masters?tab=8')->withInput()
                ->with('error', 'Feedback Ratings Settings with this name already exists.');
        }

        $feedbackRatingsSetting = FeedbackRatingsSetting::where('id', $request->id)->first();

        if ($feedbackRatingsSetting) {
            $feedbackRatingsSetting->update($data);
            $message = 'Feedback Ratings Settings Updated Successfully';
        } else {
            FeedbackRatingsSetting::create($data);
            $message = 'Feedback Ratings Settings Created Successfully';
        }

        return redirect('masters?tab=8')->with('success', $message);
    }


    public function viewRatingsFeedback()
    {
        return redirect('masters?tab=8');
    }

    public function deleteRatingsFeedback($id)
    {
        FeedbackRatingsSetting::findOrFail($id)->delete();

        return redirect('masters?tab=8')
            ->with('success', 'Feedback Ratings Settings Deleted Successfully');
    }

    public function feedbackRatingsIndex()
    {
        //  Fetch ALL active settings (Removed the 'whereNotIn' so it stops hiding them)
        $feedbackRatings = FeedbackRatingsSetting::where('is_active', 1)
            ->where('type', 1)
            ->where(function ($query) {
                $query->where('rating_enabled', 1)
                    ->orWhere('feedback_enabled', 1);
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
            // ->get();
            

        //  Fetch existing ratings so we can pass them to the UI to pre-fill the stars & text
        $employeeFeedbackRatings = EmployeeFeedbackRating::where('employee_id', auth()->id())
            ->whereNull('course_id')
            ->where('type', 1)
            ->get()
            ->keyBy('feedback_rating_setting_id');

        return view('user.view_ratings_feedback', compact('feedbackRatings', 'employeeFeedbackRatings'));
    }

    public function submitFeedback(Request $request)
    {
        //  validate that we have a valid setting ID
        $request->validate([
            'feedback_rating_setting_id' => 'required|exists:tbl_feedback_ratings_settings,id',
        ], [
            'feedback_rating_setting_id.required' => 'The feedback rating setting ID is required.'
        ]);

        //  Fetch the setting to see what the Admin actually enabled
        $setting = FeedbackRatingsSetting::where('id', $request->feedback_rating_setting_id)
            ->where('is_active', 1)
            ->where(function ($query) {
                $query->where('type', 1)
                    ->orWhere(function ($q) {
                        $q->where('type', 2)
                            ->whereHas('category', function ($catQuery) {
                                $catQuery->where('status', 1);
                            })
                            ->whereHas('course', function ($courseQuery) {
                                $courseQuery->where('active', 1);
                            });
                    });
            })
            ->firstOrFail();

        $courseId = null;
        $categoryId = null;

        if ((int) $setting->type === 2) {
            $request->validate([
                'assign_id' => 'required|integer',
            ]);

            $assignment = Asigneduser::where('id', $request->assign_id)
                ->where('user_id', auth()->id())
                ->firstOrFail();
            $courseId = $assignment->course_id;
            $categoryId = $assignment->category_id;

            abort_unless(
                (int) $setting->category_id === (int) $assignment->category_id,
                422,
                'This feedback setting does not belong to the selected course category.'
            );

            abort_unless(
                (int) $setting->course_id === (int) $assignment->course_id,
                422,
                'This feedback setting does not belong to the selected course.'
            );
        }

        // Check if an existing rating exists to determine create or update
        $existingRating = EmployeeFeedbackRating::where('employee_id', auth()->id())
            ->where('feedback_rating_setting_id', $setting->id)
            ->where('course_id', $courseId)
            ->where('category_id', $categoryId)
            ->where('type', $setting->type)
            ->first();

        if ((int) $setting->type === 2 && !$existingRating) {
            $requiredVideoIds = Course_documents::where('course_id', $assignment->course_id)
                ->where('is_active', 1)
                ->where('is_delete', 0)
                ->where(function ($query) {
                    $query->where('type', 4)
                        ->orWhereNotIn('type', [4, 5, 6, 7]);
                })
                ->pluck('id')
                ->map(fn ($id) => (int) $id);

            if ($requiredVideoIds->isNotEmpty()) {
                $videoAccess = AssessmentVideoAccess::where('user_id', auth()->id())
                    ->where('assign_id', $assignment->id)
                    ->latest('id')
                    ->first();
                $completedVideoIds = collect(optional($videoAccess)->completed_video_ids ?: [])
                    ->map(fn ($id) => (int) $id)
                    ->unique();

                abort_if(
                    $requiredVideoIds->diff($completedVideoIds)->isNotEmpty(),
                    422,
                    'Please watch every course video completely before submitting feedback and ratings.'
                );
            }
        }

        //  Dynamically build the validation rules based on admin settings
        $dynamicRules = [];
        
        if ($setting->rating_enabled == 1) {
            $dynamicRules['rating'] = 'required|integer|min:1|max:5';
        }
        
        if ($setting->feedback_enabled == 1) {
            $dynamicRules['feedback'] = 'required|string';
            $dynamicRules['suggestions'] = 'nullable|string';
        }

        //  Run the dynamic validation
        $request->validate($dynamicRules);


        // Update or Create the feedback and rating record
        $ratingRecord = EmployeeFeedbackRating::updateOrCreate(
            [
                'employee_id' => auth()->id(),
                'feedback_rating_setting_id' => $setting->id,
                'course_id' => $courseId,
                'category_id' => $categoryId,
                'type' => $setting->type,
            ],
            [
                'rating' => $setting->rating_enabled == 1 ? $request->rating : null,
                'feedback' => $setting->feedback_enabled == 1 ? $request->feedback : null,
                'suggestions' => $setting->feedback_enabled == 1 ? $request->suggestions : null,
            ]
        );

        $message = $existingRating
            ? 'Thank you! Your feedback and rating have been updated successfully.'
            : 'Thank you! Your feedback and rating have been saved successfully.';

        if ($request->expectsJson()) {
            return response()->json([
                'message' => $message,
                'updated' => (bool) $existingRating,
                'rating' => $ratingRecord->rating,
                'feedback' => $ratingRecord->feedback,
                'suggestions' => $ratingRecord->suggestions,
            ]);
        }

        return redirect()->back()->with('success', $message);
    }


    public function feedback_overview(Request $request, $id = null)
    {
        $feedbackId = $id ?? $request->id ?? $request->route('id');
        $feedbackOverview = FeedbackRatingsSetting::with([
            'employeeRatings.user',
            'category',
            'course'
        ])
        ->where('id', $feedbackId)
        ->firstOrFail();

        return view(
            'admin.masters.feedback_overview_list',
            compact('feedbackOverview')
        );
    }

}
