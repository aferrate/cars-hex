<?php

namespace App\Application\Command\Handler;

use App\Application\Command\CreateCarCommand;
use App\Application\UseCases\Car\InsertCar;
use App\Domain\Model\Car;

class CreateCarCommandHandler
{
    private $creator;

    public function __construct(InsertCar $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreateCarCommand $command)
    {
        $newCar = new Car();
        $newCar->setMark($command->getMark());
        $newCar->setModel($command->getModel());
        $newCar->setCountry($command->getCountry());
        $newCar->setCity($command->getCity());
        $newCar->setDescription($command->getDescription());
        $newCar->setYear($command->getYear());
        $newCar->setEnabled($command->getEnabled());
        $newCar->setImageFilename($command->getImageName());

        $this->creator->insert($newCar);
    }
}