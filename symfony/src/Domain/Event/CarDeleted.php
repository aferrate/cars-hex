<?php

namespace App\Domain\Event;

use App\Domain\Model\Car;

final class CarDeleted extends DomainEvent
{
    /**
     * CarCreated constructor.
     */
    public function __construct(Car $car)
    {
        $data = [];
        $data[] = $car->getId();
        $data[] = $car->getMark();
        $data[] = $car->getModel();
        $data[] = $car->getDescription();
        $data[] = $car->getCountry();
        $data[] = $car->getCity();

        parent::__construct($data);
    }

    public function eventName(): string
    {
        return 'car_deleted';
    }
}