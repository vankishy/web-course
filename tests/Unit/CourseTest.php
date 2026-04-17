<?php

namespace Tests\Unit;

use App\Http\Controllers\CourseController;
use Mockery;
use PHPUnit\Framework\TestCase;

/**
 * @runTestsInSeparateProcesses
 */
class CourseTest extends TestCase
{

    /** @test */
    public function it_returns_zero_when_no_courses()
    {
        $controller = new CourseController();

        $result = $controller->calculateProgress(1, []);

        $this->assertEquals(0, $result);
    }

    /** @test */
    public function it_calculates_progress_correctly()
    {
        // Arrange
        $controller = new CourseController();
        $detailCourses = [1, 2, 3];
        $userId = 1;

        // Mock model supaya gak query ke DB
        Mockery::mock('alias:App\Models\UserCourseProgress')
            ->shouldReceive('where')->andReturnSelf()
            ->shouldReceive('whereIn')->andReturnSelf()
            ->shouldReceive('where')->andReturnSelf()
            ->shouldReceive('count')->andReturn(2); // seolah ada 2 data done

        // Act
        $result = $controller->calculateProgress($userId, $detailCourses);

        // Assert
        $this->assertEquals(67, $result); // 2/3 * 100 = 66.66 → 67
    }
}