<?php

namespace Wod\Repository;

use Symfony\Component\Yaml\Yaml;
use Wod\Model\Category;
use Wod\Model\Workout;

class WorkoutRepository
{
    /**
     * @var Workout[]
     */
    private $workouts;

    /**
     * WorkoutRepository constructor.
     */
    public function __construct()
    {
        $config = Yaml::parseFile('config/workouts.yaml');

        foreach ($config as $workout) {
            $this->workouts[] = new Workout(
                $workout['id'],
                $workout['name'],
                new Category(
                    $workout['category']['id'],
                    $workout['category']['name']
                )
            );
        }
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->workouts;
    }
}
