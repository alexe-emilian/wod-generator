<?php

namespace Wod\Tests\Handler;

use PHPUnit\Framework\TestCase;
use Wod\Handler\HandstandPracticeHandler;
use Wod\Handler\LimitedEquipmentHandler;
use Wod\Model\Category;
use Wod\Model\Participant;
use Wod\Model\Workout;

class HandstandPracticeHandlerTest extends TestCase
{
    public function testWorkoutCanBeHandled()
    {
        $limitedEquipmentHandler = $this->getMockBuilder(LimitedEquipmentHandler::class)
            ->disableOriginalConstructor()
            ->getMock();
        $handler = new HandstandPracticeHandler($limitedEquipmentHandler);

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
