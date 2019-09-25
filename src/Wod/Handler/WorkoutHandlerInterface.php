<?php

namespace Wod\Handler;

use Wod\Model\Participant;
use Wod\Model\Workout;

interface WorkoutHandlerInterface
{
    /**
     * @param Workout $workout
     * @param Participant $participant
     * @return bool
     */
    public function handle(Workout $workout, Participant $participant): bool;
}