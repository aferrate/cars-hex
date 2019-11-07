<?php

namespace App\Application\Command;

class DeleteCarCommand
{
    private $id;

    /**
     * DeleteCarCommand constructor.
     * @param $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}