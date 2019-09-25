<?php

namespace Wod\Model;

class Category
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
     * Category constructor.
     * @param int $id
     * @param string $name
     */
    public function __construct(
        int $id,
        string $name
    ) {
        $this->name = $name;
        $this->id = $id;
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
}
