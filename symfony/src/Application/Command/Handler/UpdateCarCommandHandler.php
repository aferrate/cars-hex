<?php

namespace App\Application\Command\Handler;

use App\Application\Command\UpdateCarCommand;
use App\Application\UseCases\Car\UpdateCar;

class UpdateCarCommandHandler
{
    private $updater;

    public function __construct(UpdateCar $updater)
    {
        $this->updater = $updater;
    }

    public function __invoke(UpdateCarCommand $command)
    {
        $this->updater->update($command);
    }
}