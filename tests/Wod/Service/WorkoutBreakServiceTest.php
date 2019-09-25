<?php

namespace Wod\Tests\Service;

use PHPUnit\Framework\TestCase;
use Wod\Model\Participant;
use Wod\Service\WorkoutBreakService;

class WorkoutBreakServiceTest extends TestCase
{
    public function testThatWorkoutBreaksAreSet()
    {
        $service = new WorkoutBreakService();

        $participant = new Participant(
            1,
            'Participant',
            false
        );

        $service->setWorkoutBreaks($participant, 4);
        $this->assertEquals(4, count($participant->getWod()));
    }
}
