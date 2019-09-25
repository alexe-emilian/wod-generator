<?php

namespace Wod\Repository;

use Symfony\Component\Yaml\Yaml;
use Wod\Model\Participant;

class ParticipantRepository
{
    /**
     * @var Participant[]
     */
    private $participants;

    /**
     * ParticipantRepository constructor.
     */
    public function __construct()
    {
        $config = Yaml::parseFile('config/participants.yaml');

        foreach ($config as $participant) {
            $this->participants[] = new Participant(
                $participant['id'],
                $participant['name'],
                $participant['beginner']
            );
        }
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->participants;
    }

    /**
     * @param int $index
     * @return Participant
     */
    public function find(int $index): Participant
    {
        return $this->participants[$index];
    }

    /**
     * @param int $index
     * @return array
     */
    public function findExcept(int $index): array
    {
        $participants = $this->participants;
        unset($participants[$index]);

        return $participants;
    }
}
