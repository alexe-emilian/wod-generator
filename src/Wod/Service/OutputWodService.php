<?php

namespace Wod\Service;

use Wod\Enum\WorkoutEnum;
use Wod\Model\Participant;
use Wod\Model\Workout;
use Wod\Model\WorkoutBreak;

class OutputWodService
{
    /**
     * @param Participant[] $participants
     */
    public function output(array $participants): void
    {
        $schedule = [];

        for ($timer = 0; $timer < WorkoutEnum::MAX_TIMER; $timer++) {
            foreach ($participants as $participant) {
                $element = $participant->getWod()[$timer];

                if ($element instanceof Workout) {
                    $output = sprintf(
                        "%s will do %s",
                        $participant->getName(),
                        $element->getName()
                    );
                    $schedule[$timer][] = $this->padElement($output);
                }

                if ($element instanceof WorkoutBreak) {
                    $output = sprintf(
                        "%s will take a break",
                        $participant->getName()
                    );
                    $schedule[$timer][] = $this->padElement($output);
                }
            }
        }

        foreach ($schedule as $timer => $item) {
            echo sprintf(
                "%s:00-%s:00 (%s) => ",
                $this->padCounter($timer),
                $this->padCounter($timer + 1),
                $this->padCounter($timer + 1)
            );
            echo implode('', $item);
            echo PHP_EOL;
        }
    }

    /**
     * @param $data
     * @return string
     */
    private function padCounter($data): string
    {
        return str_pad($data, 2, "0", STR_PAD_LEFT);
    }

    /**
     * @param $data
     * @return string
     */
    private function padElement($data): string
    {
        return str_pad($data, 36);
    }
}