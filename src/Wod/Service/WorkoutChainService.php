<?php

namespace Wod\Service;

use Wod\Handler\CardioWorkoutHandler;
use Wod\Handler\WorkoutHandlerInterface;
use Wod\Model\Participant;
use Wod\Model\Workout;

class WorkoutChainService
{
    /**
     * @var WorkoutHandlerInterface
     */
    private $handler;

    /**
     * WorkoutChainService constructor.
     * @param CardioWorkoutHandler $handler
     */
    public function __construct(CardioWorkoutHandler $handler)
    {
        $this->handler = $handler;
    }

    public function handle(Workout $workout, Participant $participant): bool
    {
        return $this->handler->handle($workout, $participant);
    }
}