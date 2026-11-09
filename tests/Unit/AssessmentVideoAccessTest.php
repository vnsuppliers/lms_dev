<?php

namespace Tests\Unit;

use App\Http\Controllers\UserprofileController;
use Mockery;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class AssessmentVideoAccessTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /** @dataProvider accessStates */
    public function test_access_when_revisiting_a_course($completed, $videoIds, $expected)
    {
        $assignment = Mockery::mock('alias:App\\Models\\Asigneduser');
        $assignment->shouldReceive('where')->with('id', 42)->andReturnSelf();
        $assignment->shouldReceive('where')->with('user_id', 7)->andReturnSelf();
        $assignment->shouldReceive('where')->with('status', 3)->andReturnSelf();
        $assignment->shouldReceive('exists')->andReturn($completed);

        $access = Mockery::mock('alias:App\\Models\\AssessmentVideoAccess');
        if ($completed) {
            $access->shouldReceive('where')->andThrow(new \RuntimeException('Completed courses must not require video records.'));
        } else {
            $access->shouldReceive('where')->with('user_id', 7)->andReturnSelf();
            $access->shouldReceive('where')->with('assign_id', 42)->andReturnSelf();
            $access->shouldReceive('latest')->with('id')->andReturnSelf();
            $access->shouldReceive('first')->andReturn(
                $videoIds === null ? null : (object) ['completed_video_ids' => $videoIds]
            );
        }

        $method = new ReflectionMethod(UserprofileController::class, 'hasCompletedAllRequiredVideos');
        $method->setAccessible(true);
        $this->assertSame($expected, $method->invoke(new UserprofileController(), 42, 7, collect([10, 11])));
    }

    public function accessStates(): array
    {
        return [
            'completed course without video records' => [true, null, true],
            'new or reassigned course without video records' => [false, null, false],
            'incomplete video progress' => [false, [10], false],
            'all required videos watched' => [false, ['10', '11'], true],
        ];
    }
}
