<?php

namespace Wod\Service;

use Wod\Enum\WorkoutEnum;
use Wod\Model\Participant;
use Wod\Model\WorkoutBreak;

class WorkoutBreakService
{
    /**
     * @param Participant $participant
     * @param int $count
     * @return void
     */
    public function setWorkoutBreaks(Participant $participant, int $count)
    {
        if (0 === $count) {
            return;
        }

        $newWorkoutBreak = $this->getNewWorkoutBreak();
        if(isset($participant->getWod()[$newWorkoutBreak])
            && $participant->getWod()[$newWorkoutBreak] instanceof WorkoutBreak) {
            $this->setWorkoutBreaks($participant, $count);
        }

        $participant->setWorkout($newWorkoutBreak, new WorkoutBreak());
        $this->setWorkoutBreaks($participant, $count - 1);
    }

    /**
     * @return int
     */
    private function getNewWorkoutBreak(): int
    {
        return rand(1, WorkoutEnum::MAX_TIMER - 2);
    }
}
