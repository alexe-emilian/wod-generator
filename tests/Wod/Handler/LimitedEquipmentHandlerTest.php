<?php

namespace Wod\Tests\Handler;

use PHPUnit\Framework\TestCase;
use Wod\Handler\LimitedEquipmentHandler;
use Wod\Model\Category;
use Wod\Model\Participant;
use Wod\Model\Workout;
use Wod\Repository\ParticipantRepository;

class LimitedEquipmentHandlerTest extends TestCase
{
    public function testWorkoutCanBeHandled()
    {
        $participantRepository = $this->getMockBuilder(ParticipantRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $handler = new LimitedEquipmentHandler($participantRepository);

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
