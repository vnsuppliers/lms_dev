<?php

namespace Tests\Feature;

use App\Http\Controllers\ExamController;
use App\Models\ExamAttempt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class AttemptedExamTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'exam_test', 'database.connections.exam_test' => [
            'driver' => 'sqlite', 'database' => ':memory:', 'prefix' => '',
        ]]);
        DB::statement('CREATE TABLE tbl_exam_attempts (id INTEGER PRIMARY KEY, assigned_id INTEGER, course_id INTEGER, user_id INTEGER, exam_id INTEGER, exam_result TEXT, deleted_at TEXT)');
        DB::statement('CREATE TABLE tbl_assignment_exams (id INTEGER PRIMARY KEY, name TEXT, exam_code TEXT)');
        DB::statement('CREATE TABLE tbl_assignment_questions (id INTEGER PRIMARY KEY, exam_id INTEGER, question_mark INTEGER)');
        DB::statement('CREATE TABLE tbl_assigned_answers (id INTEGER PRIMARY KEY, exam_attendance_id INTEGER, question_id INTEGER, answer_marks REAL)');
        DB::table('tbl_exam_attempts')->insert(['id' => 20, 'assigned_id' => 191, 'course_id' => 254, 'user_id' => 1, 'exam_id' => 17, 'exam_result' => 'Passed']);
    }

    private function examRequest(array $overrides = []): Request
    {
        return Request::create('/view_attempted_exam', 'GET', array_merge([
            'assigned_id' => 191, 'course_id' => 254, 'user_id' => 1, 'exam_id' => 17,
        ], $overrides));
    }

    public function test_missing_exam_preserves_the_historical_result(): void
    {
        $factory = new class(app('view'), app('redirect')) extends \Illuminate\Routing\ResponseFactory {
            public $viewName;
            public function view($view, $data = [], $status = 200, array $headers = [])
            {
                $this->viewName = $view;
                return new \Illuminate\Http\Response($data['examAttempt']->exam_result, $status);
            }
        };
        $this->app->instance(\Illuminate\Contracts\Routing\ResponseFactory::class, $factory);
        $response = (new ExamController())->viewAttemptedExam($this->examRequest());
        $this->assertSame(410, $response->getStatusCode());
        $this->assertSame('admin.exams.exam_unavailable', $factory->viewName);
        $this->assertSame('Passed', ExamAttempt::find(20)->exam_result);
    }

    public function test_another_users_attempt_is_not_used_as_a_fallback(): void
    {
        $this->expectException(ModelNotFoundException::class);
        (new ExamController())->viewAttemptedExam($this->examRequest(['user_id' => 2]));
    }

    public function test_invalid_identifiers_are_rejected(): void
    {
        $this->expectException(ValidationException::class);
        (new ExamController())->viewAttemptedExam($this->examRequest(['exam_id' => 'invalid']));
    }

    public function test_existing_exam_loads_only_its_attempt_answers(): void
    {
        DB::table('tbl_assignment_exams')->insert(['id' => 17, 'name' => 'Sample', 'exam_code' => 'SAMPLE']);
        DB::table('tbl_assigned_answers')->insert([
            ['id' => 1, 'exam_attendance_id' => 20, 'question_id' => 5, 'answer_marks' => 2.5],
            ['id' => 2, 'exam_attendance_id' => 21, 'question_id' => 5, 'answer_marks' => 5],
        ]);
        $view = (new ExamController())->viewAttemptedExam($this->examRequest());
        $this->assertSame('admin.exams.examattempt_view', $view->name());
        $this->assertEquals(2.5, $view->getData()['answers']->get(5)->answer_marks);
        $this->assertCount(1, ExamAttempt::find(20)->answers);
    }

    public function test_guests_cannot_view_or_evaluate_exams(): void
    {
        $this->get('/view_attempted_exam?assigned_id=191&course_id=254&exam_id=17&user_id=1')->assertRedirect(route('login'));
        $this->post('/save_results', [])->assertRedirect(route('login'));
    }

    /** @dataProvider invalidMarks */
    public function test_invalid_evaluation_does_not_change_saved_results($maximum, $marks): void
    {
        DB::table('tbl_assignment_exams')->insert(['id' => 17, 'exam_code' => 'SAMPLE']);
        DB::table('tbl_assignment_questions')->insert(['id' => 5, 'exam_id' => 17, 'question_mark' => $maximum]);
        DB::table('tbl_assigned_answers')->insert(['id' => 1, 'exam_attendance_id' => 20, 'question_id' => 5, 'answer_marks' => 0]);
        $request = Request::create('/save_results', 'POST', [
            'exam_attempt_id' => 20, 'assigned_id' => 191, 'exam_user_id' => 1,
            'exam_course_id' => 254, 'exam_code' => 'SAMPLE',
            'answers' => [5 => ['result' => 'pass', 'marks' => $marks]],
        ]);
        try {
            (new ExamController())->saveResults($request);
            $this->fail('Invalid marks must be rejected.');
        } catch (ValidationException $exception) {
            $this->assertArrayHasKey('answers', $exception->errors());
            $this->assertSame('Passed', ExamAttempt::find(20)->exam_result);
            $this->assertEquals(0, DB::table('tbl_assigned_answers')->value('answer_marks'));
        }
    }

    public function invalidMarks(): array
    {
        return ['exceeds maximum' => [5, 6], 'zero total' => [0, 0]];
    }
}
