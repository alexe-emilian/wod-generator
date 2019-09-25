<?php

namespace Wod\Model;

class Workout implements ElementInterface
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
     * @var Category
     */
    private $category;

    /**
     * Workout constructor.
     * @param int $id
     * @param string $name
     * @param Category $category
     */
    public function __construct(
        int $id,
        string $name,
        Category $category
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }
}
