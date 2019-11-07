<?php

namespace App\Application\Query\Handler;

use App\Application\Query\ListAllCarsQuery;
use \App\Application\UseCases\Car\ListAllCars;

class ListAllCarsQueryHandler
{
    private $listAllCars;

    /**
     * ListAllCarsQueryHandler constructor.
     * @param $listAllCars
     */
    public function __construct(ListAllCars $listAllCars)
    {
        $this->listAllCars = $listAllCars;
    }

    public function __invoke(ListAllCarsQuery $query)
    {
        return $this->listAllCars->findAllCars();
    }
}