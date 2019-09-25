<?php

namespace Wod\Service;

use Wod\Model\Workout;
use Wod\Repository\WorkoutRepository;

class WorkoutService
{
    /**
     * @var WorkoutRepository
     */
    private $workoutRepository;

    /**
     * WodService constructor.
     * @param WorkoutRepository $workoutRepository
     */
    public function __construct(WorkoutRepository $workoutRepository)
    {
        $this->workoutRepository = $workoutRepository;
    }

    public function getRandomWorkout(): Workout
    {
        $workouts = $this->workoutRepository->findAll();

        return $workouts[rand(0, count($workouts) - 1)];
    }
}
