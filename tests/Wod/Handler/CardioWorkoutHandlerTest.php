<?php

namespace Wod\Tests\Handler;

use PHPUnit\Framework\TestCase;
use Wod\Handler\CardioWorkoutHandler;
use Wod\Handler\HandstandPracticeHandler;
use Wod\Model\Category;
use Wod\Model\Participant;
use Wod\Model\Workout;

class CardioWorkoutHandlerTest extends TestCase
{
    public function testWorkoutCanBeHandled()
    {
        $handstandPracticeHandler = $this->getMockBuilder(HandstandPracticeHandler::class)
            ->disableOriginalConstructor()
            ->getMock();
        $handler = new CardioWorkoutHandler($handstandPracticeHandler);

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
        $result = $handler->handle($workout, $participant);

        $this->assertIsBool($result);
    }
}
