<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use App\Models\Answer; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Asigneduser;
use App\Models\ExamAttempt;
use App\Models\Course_documents;
use Carbon\Carbon;
use Illuminate\Support\Str; // Import the Str class
 use App\Helpers\ActivityLog;
  use App\Models\Activity;

class UserExamController extends Controller
{
    public function showExamForm(Request $request)
    {
        //dd($request->all());
        $course_document = Course_documents::where('file_path', $request->query('exam_name'))->where('is_active','=',1)->where('course_id',$request->course_id)->first();
        if (!$course_document) {
        //abort(404, 'Exam not found');
          return redirect()->back()->with('error', 'Exam not found or inactive');
        }
          

        $exam = Exam::where('exam_code', $request->query('exam_name'))->first();
        if (!$exam) {
            // abort(404, 'Exam not found');
            return redirect()->back()->with('error', 'Exam not found');
        }
        $questions = Question::where('exam_id', $exam->id)->get();

        return view('user.exams.take', compact('exam', 'questions'));
    }


    public function submitAnswers(Request $request, Exam $exam)
    {
        //dd($exam);
        $request->validate([
            'course_id' => 'required|integer|min:1',
            'questions' => 'required|array|min:1',
            'questions.*' => 'array',
            'questions.*.answer_text' => 'nullable|string',
            'questions.*.answer_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $userId = Auth::id();
        $courseId = $request->input('course_id');

        // Retrieve the assigned user record
        $assignedUser = Asigneduser::where('user_id', $userId)
                                   ->where('course_id', $courseId)
                                   ->orderByDesc('id')
                                   ->first();

        if (!$assignedUser) {
            return redirect()->back()->with('error', 'User is not assigned to this course.');
        }

        abort_unless(Course_documents::where('course_id', $courseId)
            ->where('type', 7)->where('file_path', $exam->exam_code)
            ->where('is_active', 1)->where('is_delete', 0)->exists(), 404, 'Exam not available for this course.');

        // Include uploaded files as well as text inputs, including file-only answers.
        $submittedQuestions = $request->all('questions')['questions'];
        $questionIds = $exam->questions()->pluck('id')->map(function ($id) { return (string) $id; })->all();
        $submittedIds = array_map('strval', array_keys($submittedQuestions));
        if (!$questionIds || array_diff($questionIds, $submittedIds) || array_diff($submittedIds, $questionIds)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'questions' => 'Submit answers for the current questions in this exam. Please reload the exam form.',
            ]);
        }

        $uploadedPaths = [];
        try {
            DB::transaction(function () use ($request, $exam, $assignedUser, $userId, $courseId, $submittedQuestions, &$uploadedPaths) {

                // Create the exam attempt record
                $examAttendance = ExamAttempt::create([
                    'exam_id' => $exam->id,
                    'assigned_id' => $assignedUser->id,
                    'user_id' => $userId,
                    'course_id' => $courseId,
                    'exam_attend_date' => Carbon::now(),
                    'exam_result' => 'Pending',
                ]);

                $directoryPath = "answers/{$exam->exam_code}/{$userId}";

                // Process each question's answer
                foreach ($submittedQuestions as $questionId => $data) {
                    $answerFilePath = null;

                    if ($request->hasFile("questions.$questionId.answer_file")) {
                        $file = $request->file("questions.$questionId.answer_file");
                        $fileName = Str::random(10) . '.' . $file->getClientOriginalExtension();
                        $answerFilePath = $file->storeAs($directoryPath, $fileName, 'public');
                        if (!$answerFilePath) {
                            throw new \RuntimeException('The answer file could not be stored.');
                        }
                        $uploadedPaths[] = $answerFilePath;
                    }

                    Answer::create([
                        'exam_attendance_id' => $examAttendance->id,
                        'question_id' => $questionId,
                        'answer_text' => $data['answer_text'] ?? null,
                        'answer_file' => $answerFilePath,
                        'answer_result' => 'Pending',
                    ]);
                }

                ActivityLog::log(auth()->user(), 'Attempted Assignment Exam: ' . ($exam->name ?? ''), 0);
            });
        } catch (\Throwable $exception) {
            Storage::disk('public')->delete($uploadedPaths);
            throw $exception;
        }


        // Generate dynamic URL with query parameters
        $redirectUrl = route('user.start_course', [
            'id' => $assignedUser->id
        ]);

        // Redirect with success message
        return redirect()->to($redirectUrl)->with('success', 'Answers submitted successfully.');
    }

    public function view_result_exam(Request $request)
    {
        $userId = Auth::id();
        $courseId = $request->input('course_id');
        $exam_id = $request->input('ex_c') ?: $request->input('exam_id');
        $attemptId = $request->input('attempt_id') ?: $request->input('id');

        if (empty($exam_id) && $request->filled('exam_name')) {
            $examObj = Exam::where('exam_code', $request->input('exam_name'))->first();
            if ($examObj) {
                $exam_id = $examObj->id;
            }
        }

        $examAttempt = null;

        if (!empty($attemptId)) {
            $examAttempt = ExamAttempt::where('user_id', $userId)->find($attemptId);
        }

        if (!$examAttempt && $courseId) {
            $assignedUser = Asigneduser::where('user_id', $userId)
                                       ->where('course_id', $courseId)
                                       ->latest('id')
                                       ->first();
            if ($assignedUser) {
                $examAttempt = ExamAttempt::where('assigned_id', $assignedUser->id)
                    ->when($exam_id, function($q) use ($exam_id) {
                        $q->where('exam_id', $exam_id);
                    })
                    ->latest('id')
                    ->first();
            }
        }

        if (!$examAttempt) {
            $examAttempt = ExamAttempt::where('user_id', $userId)
                ->when($exam_id, function($q) use ($exam_id) {
                    $q->where('exam_id', $exam_id);
                })
                ->latest('id')
                ->first();
        }

        if (!$examAttempt && $courseId) {
            $examAttempt = ExamAttempt::where('course_id', $courseId)
                ->when($exam_id, function($q) use ($exam_id) {
                    $q->where('exam_id', $exam_id);
                })
                ->latest('id')
                ->first();
        }

        if (!$examAttempt) {
            return redirect()->back()->with('error', 'Exam attempt record not found.');
        }

        $exam = Exam::find($examAttempt->exam_id);
        if (!$exam && $exam_id) {
            $exam = Exam::find($exam_id);
        }

        if (!$exam) {
            return redirect()->back()->with('error', 'Exam details not found.');
        }

        $questions = Question::where('exam_id', $exam->id)->get();
        $answers = Answer::where('exam_attendance_id', $examAttempt->id)->get()->keyBy('question_id');                      

        return view('user.exams.exam_result', compact('exam', 'questions', 'answers', 'examAttempt'));
    }

    public function view_result_exam_by_leads(Request $request)
    {
        $courseId = $request->input('course_id');
        $exam_id = $request->input('ex_c') ?: $request->input('exam_id');
        $userId = $request->input('user_id');
        $attemptId = $request->input('attempt_id') ?: $request->input('id');

        if (empty($exam_id) && $request->filled('exam_name')) {
            $examObj = Exam::where('exam_code', $request->input('exam_name'))->first();
            if ($examObj) {
                $exam_id = $examObj->id;
            }
        }

        $examAttempt = null;

        if (!empty($attemptId)) {
            $examAttempt = ExamAttempt::find($attemptId);
        }

        if (!$examAttempt && $userId && $courseId) {
            $assignedUser = Asigneduser::where('user_id', $userId)
                                       ->where('course_id', $courseId)
                                       ->latest('id')
                                       ->first();
            if ($assignedUser) {
                $examAttempt = ExamAttempt::where('assigned_id', $assignedUser->id)
                    ->when($exam_id, function($q) use ($exam_id) {
                        $q->where('exam_id', $exam_id);
                    })
                    ->latest('id')
                    ->first();
            }
        }

        if (!$examAttempt && $userId) {
            $examAttempt = ExamAttempt::where('user_id', $userId)
                ->when($exam_id, function($q) use ($exam_id) {
                    $q->where('exam_id', $exam_id);
                })
                ->latest('id')
                ->first();
        }

        if (!$examAttempt && $courseId) {
            $examAttempt = ExamAttempt::where('course_id', $courseId)
                ->when($exam_id, function($q) use ($exam_id) {
                    $q->where('exam_id', $exam_id);
                })
                ->latest('id')
                ->first();
        }

        if (!$examAttempt) {
            return redirect()->back()->with('error', 'Exam attempt record not found.');
        }

        $exam = Exam::find($examAttempt->exam_id);
        if (!$exam && $exam_id) {
            $exam = Exam::find($exam_id);
        }

        if (!$exam) {
            return redirect()->back()->with('error', 'Exam details not found.');
        }

        $questions = Question::where('exam_id', $exam->id)->get();
        $answers = Answer::where('exam_attendance_id', $examAttempt->id)->get()->keyBy('question_id');                      

        return view('user.exams.exam_result', compact('exam', 'questions', 'answers', 'examAttempt'));
    }

}
