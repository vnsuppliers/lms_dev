<?php

namespace Tests\Feature;

use App\Http\Controllers\UserExamController;
use App\Models\Exam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class AssignmentSubmissionTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'submission_test', 'database.connections.submission_test' => [
            'driver' => 'sqlite', 'database' => ':memory:', 'prefix' => '',
        ]]);
        DB::statement('CREATE TABLE tbl_assignment_exams (id INTEGER PRIMARY KEY, name TEXT, exam_code TEXT)');
        DB::statement('CREATE TABLE tbl_assignment_questions (id INTEGER PRIMARY KEY, exam_id INTEGER)');
        DB::statement('CREATE TABLE tbl_assignedusers (id INTEGER PRIMARY KEY, user_id INTEGER, course_id INTEGER, deleted_at TEXT)');
        DB::statement('CREATE TABLE tbl_course_documents_list (id INTEGER PRIMARY KEY, course_id INTEGER, type INTEGER, file_path TEXT, is_active INTEGER, is_delete INTEGER)');
        DB::statement('CREATE TABLE tbl_exam_attempts (id INTEGER PRIMARY KEY, exam_id INTEGER, assigned_id INTEGER, user_id INTEGER, course_id INTEGER, exam_attend_date TEXT, exam_result TEXT, created_at TEXT, updated_at TEXT, deleted_at TEXT)');
        DB::statement('CREATE TABLE tbl_assigned_answers (id INTEGER PRIMARY KEY, exam_attendance_id INTEGER, question_id INTEGER, answer_text TEXT, answer_file TEXT, answer_result TEXT, created_at TEXT, updated_at TEXT)');
        DB::statement('CREATE TABLE tbl_activities (id INTEGER PRIMARY KEY, user_id INTEGER, activity TEXT, type INTEGER, created_at TEXT, updated_at TEXT)');
        DB::table('tbl_assignment_exams')->insert(['id' => 17, 'name' => 'Assignment', 'exam_code' => 'LOCAL17']);
        DB::table('tbl_assignment_questions')->insert([['id' => 1, 'exam_id' => 17], ['id' => 2, 'exam_id' => 17]]);
        DB::table('tbl_assignedusers')->insert(['id' => 191, 'user_id' => 1, 'course_id' => 11]);
        DB::table('tbl_course_documents_list')->insert(['id' => 254, 'course_id' => 11, 'type' => 7, 'file_path' => 'LOCAL17', 'is_active' => 1, 'is_delete' => 0]);
        $user = new User();
        $user->forceFill(['id' => 1]);
        $this->actingAs($user);
    }

    private function submit(array $questions)
    {
        $request = Request::create('/exams/17/submit', 'POST', ['course_id' => 11, 'questions' => $questions]);
        return (new UserExamController())->submitAnswers($request, Exam::findOrFail(17));
    }

    public function test_attempt_and_all_answers_are_stored(): void
    {
        $response = $this->submit([1 => ['answer_text' => 'First'], 2 => ['answer_text' => 'Second']]);
        $this->assertSame(302, $response->getStatusCode());
        $attempt = DB::table('tbl_exam_attempts')->first();
        $this->assertEquals(17, $attempt->exam_id);
        $this->assertEquals(11, $attempt->course_id);
        $this->assertEquals(191, $attempt->assigned_id);
        $this->assertSame('Pending', $attempt->exam_result);
        $this->assertSame(2, DB::table('tbl_assigned_answers')->where('exam_attendance_id', $attempt->id)->count());
    }

    public function test_partial_submission_is_rejected_without_saving_an_attempt(): void
    {
        try {
            $this->submit([1 => ['answer_text' => 'First']]);
            $this->fail('Incomplete form should be rejected.');
        } catch (ValidationException $exception) {
            $this->assertArrayHasKey('questions', $exception->errors());
            $this->assertSame(0, DB::table('tbl_exam_attempts')->count());
        }
    }

    public function test_answer_write_failure_rolls_back_attempt_and_previous_answer(): void
    {
        DB::statement("CREATE TRIGGER reject_second_answer BEFORE INSERT ON tbl_assigned_answers WHEN NEW.question_id = 2 BEGIN SELECT RAISE(ABORT, 'Simulated storage failure'); END");
        try {
            $this->submit([1 => ['answer_text' => 'First'], 2 => ['answer_text' => 'Second']]);
            $this->fail('Storage failure should propagate.');
        } catch (\Illuminate\Database\QueryException $exception) {
            $this->assertSame(0, DB::table('tbl_exam_attempts')->count());
            $this->assertSame(0, DB::table('tbl_assigned_answers')->count());
        }
    }
}
