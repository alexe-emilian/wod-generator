<?php

namespace Wod\Tests\Service;

use PHPUnit\Framework\TestCase;
use Wod\Model\Category;
use Wod\Model\Participant;
use Wod\Model\Workout;
use Wod\Service\WodService;
use Wod\Service\WorkoutBreakService;
use Wod\Service\WorkoutChainService;
use Wod\Service\WorkoutService;

class WodServiceTest extends TestCase
{
    public function testThatTheWodIsGeneratedForTheParticipant()
    {
        $workoutChainService = $this->getMockBuilder(WorkoutChainService::class)
            ->disableOriginalConstructor()
            ->getMock();
        $workoutService = $this->getMockBuilder(WorkoutService::class)
            ->disableOriginalConstructor()
            ->getMock();
        $workoutBreakService = $this->getMockBuilder(WorkoutBreakService::class)
            ->disableOriginalConstructor()
            ->getMock();
        $wodService = new WodService(
            $workoutChainService,
            $workoutService,
            $workoutBreakService
        );

        $participant = new Participant(
            1,
            'Participant',
            false
        );
        $workout = new Workout(
            1,
            'Test Workout',
            new Category(1, 'Test Category')
        );

        $workoutService->method('getRandomWorkout')
            ->willReturn($workout);
        $workoutChainService->method('handle')
            ->willReturn(true);

        $wodService->generate($participant);
        $this->assertGreaterThan(0, count($participant->getWod()));
    }
}
