<?php

namespace Wod\Model;

class Participant
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $beginner;

    /**
     * @var ElementInterface[]
     */
    private $wod = [];

    /**
     * Participant constructor.
     * @param int $id
     * @param string $name
     * @param bool $beginner
     */
    public function __construct(int $id, string $name, bool $beginner)
    {
        $this->id = $id;
        $this->name = $name;
        $this->beginner = $beginner;
    }

    /**
     * @inheritDoc
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function isBeginner(): bool
    {
        return $this->beginner;
    }

    /**
     * @inheritDoc
     */
    public function getWod(): array
    {
        return $this->wod;
    }

    /**
     * @inheritDoc
     */
    public function setWod(array $wod): Participant
    {
        $this->wod = $wod;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setWorkout(int $index, ElementInterface $workout): Participant
    {
        $this->wod[$index] = $workout;

        return $this;
    }
}
