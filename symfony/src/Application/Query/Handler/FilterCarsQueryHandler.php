<?php

namespace App\Application\Query\Handler;

use App\Application\Query\FilterCarsQuery;
use App\Application\UseCases\Car\ListCarsFiltered;

class FilterCarsQueryHandler
{
    private $listCarsFiltered;

    /**
     * FilterCarsQueryHandler constructor.
     * @param $listCarsFiltered
     */
    public function __construct(ListCarsFiltered $listCarsFiltered)
    {
        $this->listCarsFiltered = $listCarsFiltered;
    }

    public function __invoke(FilterCarsQuery $query)
    {
        return $this->listCarsFiltered->getCarsFiltered($query);
    }
}