<?php
namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ExamAttempt;
use App\Models\Answer;
use App\Models\Asigneduser;
use App\Models\Course_documents;
use App\Models\Courses;




use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class ExamController extends Controller
{
    public function create()
    {
        return view('admin.exams.create');
    }

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'due_date' => 'required|date',
        'questions.*.name' => 'required|string|max:255',
        'questions.*.mark' => 'required|string|max:5',
        'questions.*.file' => 'nullable|file|mimes:pdf,doc,jpg,jpeg,png,docx',
    ]);

    $examCode = strtoupper(substr($request->name, 0, 3)) . '-' . Str::random(5);

    $exam = Exam::create([
        'name' => $request->name,
        'due_date' => $request->due_date,
        'exam_code' => $examCode,
        'pass_percentage' => $request->pass_percentage??'70',
    ]);

    foreach ($request->questions as $question) {
        $filePath = null;
        if (isset($question['file']) && $question['file']) {

            $fileName = Str::random(10) . '-' . $examCode . '.' . $question['file']->getClientOriginalExtension();

            $filePath = $question['file']->storeAs(
                'questions/' . $examCode,
                $fileName,
                'public'
            );
        }

        Question::create([
            'exam_id' => $exam->id,
            'question_name' => $question['name'],
             'question_mark' => $question['mark'],
            'question_file' => $filePath,
        ]);
    }

    return redirect()->route('admin.exams.create')->with('success', 'Exam created successfully.');
}


  



    public function view(Request $request)
{
    $searchTerm = $request->search_name;
    $exam = Exam::where(function($q) use($searchTerm) {
        if (!empty($searchTerm)) {
            $q->where('name', 'LIKE', '%' . $searchTerm . '%')
              ->orWhere('exam_code', 'LIKE', '%' . $searchTerm . '%');
        }
    })->get();

    return view('admin.exams.view', compact('exam'));
}
public function viewAttemptedExam(Request $request)
{
    $criteria = $request->validate([
        'assigned_id' => 'required|integer|min:1',
        'course_id' => 'required|integer|min:1',
        'user_id' => 'required|integer|min:1',
        'exam_id' => 'required|integer|min:1',
    ]);

    $attemptId = $request->input('attempt_id') ?: $request->input('id');
    $examAttempt = null;

    if ($attemptId) {
        $examAttempt = ExamAttempt::find($attemptId);
    }

    if (!$examAttempt) {
        // Direct match with assigned_id + exam_id (uniquely identifies user enrollment and exam attempt)
        $examAttempt = ExamAttempt::where('assigned_id', $request->assigned_id)
            ->where('exam_id', $request->exam_id)
            ->orderByDesc('id')
            ->first();
    }

    if (!$examAttempt) {
        $examAttempt = ExamAttempt::where($criteria)->orderByDesc('id')->first();
    }

    if (!$examAttempt) {
        $examAttempt = ExamAttempt::where('user_id', $request->user_id)
            ->where('exam_id', $request->exam_id)
            ->orderByDesc('id')
            ->first();
    }

    if (!$examAttempt) {
        return redirect()->back()->with('error', 'Exam attempt record not found.');
    }

    $exam = Exam::find($examAttempt->exam_id);
    if (!$exam) {
        return response()->view('admin.exams.exam_unavailable', compact('examAttempt'), 410);
    }
    $questions = Question::where('exam_id', $exam->id)->get();
    $answers = Answer::where('exam_attendance_id', $examAttempt->id)->get()->keyBy('question_id');

    return view('admin.exams.examattempt_view', compact('exam', 'questions', 'answers', 'examAttempt'));
}


public function saveResults(Request $request)
{
    $request->validate([
        'exam_attempt_id' => 'required|integer|min:1',
        'assigned_id' => 'required|integer|min:1',
        'exam_user_id' => 'required|integer|min:1',
        'exam_course_id' => 'required|integer|min:1',
        'exam_code' => 'required|string',
        'answers' => 'required|array|min:1',
        'answers.*.result' => 'required|in:pass,fail',
        'answers.*.marks' => 'required|numeric|min:0',
        'answers.*.correct_answer_text' => 'nullable|string',
        'answers.*.correct_answer_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);
    $attempt = ExamAttempt::whereKey($request->exam_attempt_id)
        ->where('assigned_id', $request->assigned_id)
        ->where('user_id', $request->exam_user_id)
        ->first();
    if (!$attempt) {
        $attempt = ExamAttempt::whereKey($request->exam_attempt_id)->firstOrFail();
    }
    $examRecord = Exam::whereKey($attempt->exam_id)->where('exam_code', $request->exam_code)->first();
    abort_unless($examRecord, 410, 'The original exam record is unavailable.');
    $examQuestions = Question::where('exam_id', $attempt->exam_id)->get()->keyBy('id');
    $availableMarks = 0;
    foreach ($request->answers as $questionId => $data) {
        $question = $examQuestions->get($questionId);
        if (!$question) {
            throw \Illuminate\Validation\ValidationException::withMessages(['answers' => 'Each evaluated answer must belong to this exam and its marks cannot exceed the question marks.']);
        }

        $maxMark = (isset($question->question_mark) && is_numeric($question->question_mark) && (float)$question->question_mark > 0)
            ? (float)$question->question_mark
            : null;

        if ($maxMark !== null && (float)$data['marks'] > $maxMark) {
            throw \Illuminate\Validation\ValidationException::withMessages(['answers' => 'Each evaluated answer must belong to this exam and its marks cannot exceed the question marks.']);
        }
        $availableMarks += ($maxMark !== null ? $maxMark : (float)$data['marks']);
    }
    if ($availableMarks <= 0) {
        throw \Illuminate\Validation\ValidationException::withMessages(['answers' => 'The exam must have a positive total mark.']);
    }

    // Initialize counters for correct and total marks
    $totalMarks = 0;
    $obtainedMarks = 0;

    $examAttemptId = $request->exam_attempt_id;
    $answers = $request->answers;
    $assignedId = $request->assigned_id;
    $exam_user_id = $request->exam_user_id;
    $exam_code = $request->exam_code;
    $exam_courseId = $request->exam_course_id;

    $exam_code_details = $examRecord;

    foreach ($answers as $questionId => $data) {
        $question = $examQuestions->get($questionId);
        if (!$question) continue;

        $maxMark = (isset($question->question_mark) && is_numeric($question->question_mark) && (float)$question->question_mark > 0)
            ? (float)$question->question_mark
            : (float)$data['marks'];

        $answer = Answer::where('exam_attendance_id', $examAttemptId)
                        ->where('question_id', $questionId)
                        ->first();

        // Update the answer result
        $dataToUpdate = [
            'answer_result' => $data['result'] ?? 'Pending',
            'answer_marks' => $data['marks'], // Store the marks for the answer
        ];

        // Add the marks to the total marks
        $totalMarks += $maxMark > 0 ? $maxMark : (float)$data['marks']; // Get the total marks for the question
        $obtainedMarks += (float)$data['marks']; // Add obtained marks

        // Handle the correct answer file upload if present
        if (isset($data['correct_answer_file']) && $data['correct_answer_file']) {
            $fileExtension = $data['correct_answer_file']->getClientOriginalExtension();
            $uniqueFileName = uniqid('correct_answer_', true) . '.' . $fileExtension;
            $filePath = $data['correct_answer_file']->storeAs("answers/{$exam_code}/{$exam_user_id}", $uniqueFileName, 'public');

            $dataToUpdate['correct_answer_file'] = $filePath;
        }

        // Optionally store correct answer text
        if (isset($data['correct_answer_text']) && $data['correct_answer_text']) {
            $dataToUpdate['correct_answer_text'] = $data['correct_answer_text'];
        }

        // Update or create the answer record
        if ($answer) {
            $answer->update($dataToUpdate);
        } else {
            Answer::create(array_merge($dataToUpdate, [
                'exam_attendance_id' => $examAttemptId,
                'question_id' => $questionId,
            ]));
        }
    }

    // Get the pass percentage from the ExamAttempt record, default to 70 if null or empty
    $exam_passpercentage = $exam_code_details->pass_percentage;
    $exam_passpercentage = !empty($exam_passpercentage) ? $exam_passpercentage : 70;

    // Calculate the pass percentage
    $passPercentage = $totalMarks > 0 ? ($obtainedMarks / $totalMarks) * 100 : 0;


    // Determine the result based on the pass percentage from the ExamAttempt record
    $examResult = $passPercentage >= $exam_passpercentage ? 'Passed' : 'Failed';

    $evaluationCompletedDate = now();

    // Update the exam attempt result
    ExamAttempt::where('id', $examAttemptId)->update([
        'exam_result' => $examResult,
        'evaluation_completed_date' => $evaluationCompletedDate,
    ]);

    // Check if the user has completed and passed all course requirements (assessments and assignments)
    $assignedRecord = Asigneduser::find($assignedId);
    if ($assignedRecord) {
        if ($assignedRecord->isCompletedAndPassed()) {
            $assignedRecord->update([
                'status' => 3,
                'completed_on' => now(),
            ]);
        } else {
            $assignedRecord->update([
                'status' => 1,
            ]);
        }
    }
    

    // Redirect with success message
    return redirect()->route('view_attempted_exam', [
        'assigned_id' => $assignedId,
        'course_id' => $exam_courseId,
        'type' => $request->user_type,
        'exam_id' => $exam_code_details->id,
        'user_id' => $exam_user_id
    ])->with('success', 'Results updated successfully.');
}

    
       
      


// public function saveResults(Request $request)
// {
//     // dd($request->all());
//     $request->validate([
//         'exam_attempt_id' => 'required|exists:tbl_assigned_answers,id',
//         'answers.*.answer_text' => 'nullable|string',
//         'answers.*.result' => 'required|in:pass,fail',
//          'answers.*.marks' => 'required',
//         'answers.*.correct_answer_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:2048',
//     ]);

//     dd($request->all());

//     // Initialize counters for correct and total questions
//     $totalQuestions = count($request->answers);
//     $correctAnswers = 0;

//     $examAttemptId = $request->exam_attempt_id;
//     $answers = $request->answers;
//     $assignedId = $request->assigned_id;
//     $exam_user_id = $request->exam_user_id;
//     $exam_code = $request->exam_code;
//     $exam_courseId = $request->exam_course_id;

//      $exam_code_details = Exam::where('exam_code',$exam_code)->first();

//     foreach ($answers as $questionId => $data) {
//     $answer = Answer::where('exam_attendance_id', $examAttemptId)
//                     ->where('question_id', $questionId)
//                     ->first();

//     if ($answer) {
//         $dataToUpdate = [
//             'answer_result' => $data['result'] ?? 'Pending',
//         ];

//         if (isset($data['result']) && $data['result'] === 'pass') {
//             $correctAnswers++;
//         }

//         if (isset($data['correct_answer_file']) && $data['correct_answer_file']) {
//             $fileExtension = $data['correct_answer_file']->getClientOriginalExtension();
//             $uniqueFileName = uniqid('correct_answer_', true) . '.' . $fileExtension;
//             $filePath = $data['correct_answer_file']->storeAs("answers/{$examCode}/{$exam_user_id}", $uniqueFileName, 'public');

//             $dataToUpdate['correct_answer_file'] = $filePath;
//         }

//         if (isset($data['correct_answer_text']) && $data['correct_answer_text']) {
//             $dataToUpdate['correct_answer_text'] = $data['correct_answer_text'];
//         }

//         $answer->update($dataToUpdate);
//     }
//   }

//     $passPercentage = ($correctAnswers / $totalQuestions) * 100;

//     $examResult = $passPercentage >= 70 ? 'Passed' : 'Failed';
//      $evaluationCompletedDate = now();
//     ExamAttempt::where('id', $examAttemptId)->update(['exam_result' => $examResult,'evaluation_completed_date' => $evaluationCompletedDate]);

//     return redirect()->route('view_attempted_exam', ['assigned_id' =>$assignedId,'course_id' =>$exam_courseId,'type'=>$request->user_type,'exam_id'=>$exam_code_details->id,'user_id'=>$exam_user_id])->with('success', 'Results updated successfully.');
// }







public function fetch_exam_details(Request $request) {
    
   $exam_details = Exam::findOrFail($request->exam_id);
   $questions = Question::where('exam_id', $exam_details->id)->get();


    $course_withCourses = Courses::with('Assigned_usersdetails')->whereHas('assignment_exam', function($subquery) use ($exam_details) {
            $subquery->where('file_path', $exam_details->exam_code);
        })->get();




 $html = view('admin.exams.exam_view_ajax',compact('exam_details','questions','course_withCourses'))->render();
    return $html;
}

public function deleteQuestion(Request $request)
{
    $questionId = $request->input('question_id');

    // Find and delete the question
    $question = Question::find($questionId);

    $attemptExists = ExamAttempt::where('exam_id', $question->exam_id)->exists();

    if ($attemptExists) {
       return response()->json(['success' => false, 'message' => 'Already member attempted exam so cannot delete question']);
    }



    if ($question) {
        // Delete the question (and its associated file if needed)
        // if ($question->question_file) {
        //     Storage::delete('public/' . $question->question_file);
        // }
        $question->delete();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false, 'message' => 'Question not found']);
}


// public function edit_store(Request $request)
// {
//     $request->validate([
//         'name' => 'required|string|max:255',
//         'due_date' => 'required|date',
//         'questions.*.name' => 'required|string|max:255',
//         'questions.*.file' => 'nullable|file|mimes:pdf,doc,jpg,jpeg,png,docx',
//         'exam_id' => 'required|string',
//     ]);

//     // Update Exam Details
//     $exam = Exam::find($request->exam_id);
//     $exam->name = $request->name;
//     $exam->due_date = $request->due_date;
//     $exam->save();

//     $examCode = strtoupper(substr($request->name, 0, 3)) . '-' . Str::random(5);

//     foreach ($request->questions as $questionData) {
//         $filePath = null;

//         // Handle file upload if present
//         if (isset($questionData['file']) && $questionData['file']) {
//             // Generate a new file name and store the file
//             $fileName = Str::random(10) . '-' . $examCode . '.' . $questionData['file']->getClientOriginalExtension();
//             $filePath = $questionData['file']->storeAs('questions/' . $examCode, $fileName, 'public');
//         }

//         // Check if the question is new or existing
//         if (!isset($questionData['existing'])) {
//             // New question: create it
//             Question::create([
//                 'exam_id' => $exam->id,
//                 'question_name' => $questionData['name'],
//                 'question_file' => $filePath,
//             ]);
//         } else {
//             // Existing question: update it
//             $question = Question::find($questionData['id']);
//             if ($question) {
//                 $question->question_name = $questionData['name'];
//                 // If a new file is uploaded, update it; otherwise, keep the old file
//                 $question->question_file = $filePath ?: $question->question_file;
//                 $question->save();
//             }
//         }
//     }

//     // Optional: Remove any questions that were removed by the user (if you send a `removed` flag in the frontend)
//     if (isset($request->removed_questions)) {
//         foreach ($request->removed_questions as $removedQuestionId) {
//             $question = Question::find($removedQuestionId);

//                       if ($question) {
//                 $question->delete();
//             }
//         }
//     }

//     return redirect()->route('admin.exams.create')->with('success', 'Exam updated successfully.');
// }


public function edit_store(Request $request)
{

    $attemptExists = ExamAttempt::where('exam_id', $request->exam_id)->exists();

    if ($attemptExists) {
        return redirect()->route('admin.exams.create')->with('error', 'This exam has already been attempted by some members and cannot be edited.');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'due_date' => 'required|date',
        'questions.*.name' => 'required|string|max:255',
        'questions.*.mark' => 'required|string|max:5',
        'questions.*.file' => 'nullable|file|mimes:pdf,doc,jpg,jpeg,png,docx',
        'exam_id' => 'required|string',
    ]);

    // Update Exam Details
    $exam = Exam::find($request->exam_id);
    $exam->name = $request->name;
    $exam->due_date = $request->due_date;
    $exam->pass_percentage = $request->pass_percentage;
    $exam->save();

    $examCode = strtoupper(substr($request->name, 0, 3)) . '-' . Str::random(5);

    foreach ($request->questions as $questionData) {
        $filePath = null;

        // Handle file upload if present (for new files)
        if (isset($questionData['file']) && $questionData['file']) {
            $fileName = Str::random(10) . '-' . $examCode . '.' . $questionData['file']->getClientOriginalExtension();
            $filePath = $questionData['file']->storeAs('questions/' . $examCode, $fileName, 'public');
        }

        // Check if the question is new or existing
        if (!isset($questionData['existing'])) {
            // New question: create it
            Question::create([
                'exam_id' => $exam->id,
                'question_name' => $questionData['name'],
                'question_mark' => $questionData['mark'],
                'question_file' => $filePath,
            ]);
        } else {
            // Existing question: update it
            $question = Question::find($questionData['id']);
            if ($question) {
                $question->question_name = $questionData['name'];
                $question->question_mark = $questionData['mark'];

                // If a new file is uploaded, update it; otherwise, keep the old file
                $question->question_file = $filePath ?: $question->question_file;
                $question->save();
            }
        }
    }

    // Optional: Remove any questions that were removed by the user (if you send a `removed` flag in the frontend)
    if (isset($request->removed_questions)) {
        foreach ($request->removed_questions as $removedQuestionId) {
            $question = Question::find($removedQuestionId);

            if ($question) {
                $question->delete();
            }
        }
    }

    return redirect()->route('admin.exams.create')->with('success', 'Exam updated successfully.');
}

    public function admin_view_result_exam(Request $request)
    {
        $userId = $request->input('user_id');
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

        // 1. Find by direct attempt_id if provided
        if (!empty($attemptId)) {
            $examAttempt = ExamAttempt::find($attemptId);
        }

        // 2. Find by assigned_id + exam_id
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

        // 3. Fallback by user_id + exam_id
        if (!$examAttempt && $userId) {
            $examAttempt = ExamAttempt::where('user_id', $userId)
                ->when($exam_id, function($q) use ($exam_id) {
                    $q->where('exam_id', $exam_id);
                })
                ->latest('id')
                ->first();
        }

        // 4. Fallback by course_id + exam_id
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
