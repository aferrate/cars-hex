<?php

namespace App\Application\Command\Handler;

use App\Application\Command\DeleteCarCommand;
use App\Application\UseCases\Car\DeleteCar;

class DeleteCarCommandHandler
{
    private $deleter;

    /**
     * DeleteCarCommandHandler constructor.
     * @param DeleteCar $deleter
     */
    public function __construct(DeleteCar $deleter)
    {
        $this->deleter = $deleter;
    }

    public function __invoke(DeleteCarCommand $command)
    {
        $this->deleter->delete($command->getId());
    }
}