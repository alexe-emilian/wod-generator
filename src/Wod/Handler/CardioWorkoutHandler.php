<?php

namespace Wod\Handler;

use Wod\Enum\CategoryEnum;
use Wod\Model\Participant;
use Wod\Model\Workout;

class CardioWorkoutHandler implements WorkoutHandlerInterface
{
    /**
     * @var WorkoutHandlerInterface|null
     */
    private $nextHandler;

    /**
     * CardioWorkoutHandler constructor.
     * @param HandstandPracticeHandler $handler
     */
    public function __construct(HandstandPracticeHandler $handler)
    {
        $this->nextHandler = $handler;
    }

    /**
     * @inheritDoc
     */
    public function handle(Workout $workout, Participant $participant): bool
    {
        if (CategoryEnum::CARDIO === $workout->getCategory()->getName()) {
            $wod = $participant->getWod();
            /** @var Workout $lastWorkout */
            $lastWorkout = end($wod);
            if (false === $lastWorkout) {
                return $this->nextHandler->handle($workout, $participant);
            }

            if (CategoryEnum::CARDIO === $lastWorkout->getCategory()->getName()) {
                return false;
            }
        }

        return $this->nextHandler->handle($workout, $participant);
    }
}