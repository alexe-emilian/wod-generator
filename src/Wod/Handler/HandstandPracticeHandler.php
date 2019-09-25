<?php

namespace Wod\Handler;

use Wod\Enum\CategoryEnum;
use Wod\Enum\WorkoutEnum;
use Wod\Model\Participant;
use Wod\Model\Workout;

class HandstandPracticeHandler implements WorkoutHandlerInterface
{
    /**
     * @var WorkoutHandlerInterface|null
     */
    private $nextHandler;

    /**
     * CardioWorkoutHandler constructor.
     * @param LimitedEquipmentHandler $handler
     */
    public function __construct(LimitedEquipmentHandler $handler)
    {
        $this->nextHandler = $handler;
    }

    /**
     * @inheritDoc
     */
    public function handle(Workout $workout, Participant $participant): bool
    {
        if (WorkoutEnum::HANDSTAND_PRACTICE === $workout->getName()) {
            if ($participant->isBeginner()) {
                foreach ($participant->getWod() as $workout) {
                    if (WorkoutEnum::HANDSTAND_PRACTICE === $workout->getName()) {
                        return false;
                    }
                }
            }
        }

        return $this->nextHandler->handle($workout, $participant);
    }
}