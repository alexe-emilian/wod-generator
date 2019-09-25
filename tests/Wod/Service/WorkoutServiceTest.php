<?php

namespace Wod\Tests\Service;

use PHPUnit\Framework\TestCase;
use Wod\Model\Category;
use Wod\Model\Workout;
use Wod\Repository\WorkoutRepository;
use Wod\Service\WorkoutService;

class WorkoutServiceTest extends TestCase
{
    public function testThatRandomWorkoutIsRetrieved()
    {
        $repository = $this->getMockBuilder(WorkoutRepository::class)->getMock();
        $service = new WorkoutService($repository);

        $workouts = [
            new Workout(
                1,
                'Test Workout',
                new Category(1, 'Test Category')
            ),
        ];
        $repository->method('findAll')->willReturn($workouts);

        $result = $service->getRandomWorkout();
        $this->assertInstanceOf(Workout::class, $result);
    }
}
