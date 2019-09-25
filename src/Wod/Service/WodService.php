<?php

namespace Wod\Service;

use Wod\Enum\WorkoutBreakEnum;
use Wod\Enum\WorkoutEnum;
use Wod\Model\Participant;
use Wod\Model\Workout;

class WodService
{
    /**
     * @var WorkoutChainService
     */
    private $workoutChainService;

    /**
     * @var WorkoutService
     */
    private $workoutService;

    /**
     * @var WorkoutBreakService
     */
    private $workoutBreakService;

    /**
     * WodService constructor.
     * @param WorkoutChainService $workoutChainService
     * @param WorkoutService $workoutService
     * @param WorkoutBreakService $workoutBreakService
     */
    public function __construct(
        WorkoutChainService $workoutChainService,
        WorkoutService $workoutService,
        WorkoutBreakService $workoutBreakService
    ) {
        $this->workoutChainService = $workoutChainService;
        $this->workoutService = $workoutService;
        $this->workoutBreakService = $workoutBreakService;
    }

    /**
     * @param Participant $participant
     */
    public function generate(Participant $participant): void
    {
        for ($timer = 0; $timer < WorkoutEnum::MAX_TIMER; $timer++) {
            $participant->setWorkout($timer, $this->getNewWorkout($timer, $participant));
        }

        $this->workoutBreakService->setWorkoutBreaks(
            $participant,
            $participant->isBeginner() ? WorkoutBreakEnum::BEGINNER : WorkoutBreakEnum::DEFAULT
        );
    }

    /**
     * @param int $timer
     * @param Participant $participant
     * @return Workout
     */
    private function getNewWorkout(int $timer, Participant $participant): Workout
    {
        $workout = $this->workoutService->getRandomWorkout();
        if (false === $this->workoutChainService->handle($workout, $participant)) {
            return $this->getNewWorkout($timer, $participant);
        }

        return $workout;
    }
}
