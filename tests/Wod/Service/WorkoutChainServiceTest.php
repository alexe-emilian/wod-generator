<?php

namespace Wod\Tests\Service;

use PHPUnit\Framework\TestCase;
use Wod\Handler\CardioWorkoutHandler;
use Wod\Model\Category;
use Wod\Model\Participant;
use Wod\Model\Workout;
use Wod\Service\WorkoutChainService;

class WorkoutChainServiceTest extends TestCase
{
    public function testThatWorkoutCanBeHandledByChain()
    {
        $workout = new Workout(
            1,
            'Test Workout',
            new Category(1, 'Test Category')
        );
        $participant = new Participant(
            1,
            'Participant',
            false
        );

        $handler = $this->getMockBuilder(CardioWorkoutHandler::class)
            ->disableOriginalConstructor()
            ->getMock();
        $handler->method('handle')->willReturn(true);

        $service = new WorkoutChainService($handler);
        $result = $service->handle($workout, $participant);

        $this->assertEquals(true, $result);
    }
}
