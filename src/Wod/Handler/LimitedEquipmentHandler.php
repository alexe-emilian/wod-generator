<?php

namespace Wod\Handler;

use Wod\Enum\WorkoutEnum;
use Wod\Model\Participant;
use Wod\Model\Workout;
use Wod\Repository\ParticipantRepository;

class LimitedEquipmentHandler implements WorkoutHandlerInterface
{
    /**
     * @var WorkoutHandlerInterface|null
     */
    private $nextHandler;

    /**
     * @var ParticipantRepository
     */
    private $participantRepository;

    /**
     * CardioWorkoutHandler constructor.
     * @param ParticipantRepository $participantRepository
     */
    public function __construct(
        ParticipantRepository $participantRepository
    ) {
        $this->nextHandler = null;
        $this->participantRepository = $participantRepository;
    }

    /**
     * @inheritDoc
     */
    public function handle(Workout $workout, Participant $participant): bool
    {
        if ($this->isWorkoutForLimitedEquipment($workout)) {
            $participants = $this->participantRepository->findExcept($participant->getId());
            $timer = count($participant->getWod());
            $counter = $this->countLimitedEquipmentUses($participants, $timer);

            if ($counter > 1) {
                return false;
            }

            return true;
        }

        return true;
    }

    /**
     * @param Participant[] $participants
     * @param int $timer
     * @return int
     */
    private function countLimitedEquipmentUses(array $participants, int $timer): int
    {
        $counter = 0;
        foreach ($participants as $participant) {
            if (!isset($participant->getWod()[$timer])) {
                continue;
            }

            $workout = $participant->getWod()[$timer];
            if (!$workout instanceof Workout) {
                continue;
            }

            if ($this->isWorkoutForLimitedEquipment($workout)) {
                $counter++;
            }
        }

        return $counter;
    }

    private function isWorkoutForLimitedEquipment(Workout $workout): bool
    {
        return WorkoutEnum::PULL_UPS === $workout->getName()
            || WorkoutEnum::RINGS === $workout->getName();
    }
}