<?php

namespace Tests\Feature;

use App\Models\Assessment_results;
use App\Models\Asigneduser;
use App\Models\Course_documents;
use App\Models\User;
use Tests\TestCase;

class AssessmentActionTest extends TestCase
{
    /** @dataProvider assessmentStates */
    public function test_saved_results_control_the_action($rows, $expired, $expected, $unexpected)
    {
        $user = new User();
        $user->forceFill(['id' => 7, 'email' => 'learner@example.test', 'username' => 'learner']);
        $this->actingAs($user);
        $assessment = new Course_documents();
        $assessment->forceFill([
            'id' => 10,
            'file_path' => 'quiz/sample/instructions',
            'expiration_date' => $expired ? '2000-01-01' : null,
        ]);
        $assessment->setRelation('assessment_all_results', collect($rows)->map(function ($row) {
            $result = new Assessment_results();
            $result->forceFill($row);
            return $result;
        }));
        $assignment = new Asigneduser();
        $assignment->forceFill(['id' => 42]);

        $html = view('user.courses.assessment_action', [
            'assessment' => $assessment,
            'courses_data' => $assignment,
            'assessmentVideoAccessGranted' => false,
            'actionClass' => 'btn',
            'reportLabel' => 'View Completed Report',
        ])->render();

        $this->assertStringContainsString($expected, $html);
        $this->assertStringNotContainsString($unexpected, $html);
    }

    public function assessmentStates(): array
    {
        $pass = ['id' => 1, 'assign_id' => 42, 'code' => 'passed-code', 'result_data' => '{"results":{"pass_or_fail":"Passed"}}'];
        $fail = ['id' => 2, 'assign_id' => 42, 'result_data' => '{"results":{"pass_or_fail":"Failed"}}'];
        return [
            'first attempt passed and no video record' => [[$pass], false, 'View Completed Report', 'take_exam'],
            'pass survives newer failure and expiry' => [[$pass, $fail, array_merge($fail, ['id' => 3])], true, 'View Completed Report', 'Maximum attempts'],
            'legacy passing score' => [[['id' => 1, 'assign_id' => 42, 'results' => '{"percentage":80,"cutoff":70}']], false, 'View Completed Report', 'assessment-locked'],
            'another assignment pass does not unlock reassignment' => [[array_merge($pass, ['assign_id' => 41])], false, 'Take Exam', 'take_result'],
            'failed attempt allows gated retake' => [[$fail], false, 'Retake Exam', 'take_result'],
            'no attempt remains gated' => [[], false, 'assessment-locked', 'take_result'],
        ];
    }
}
