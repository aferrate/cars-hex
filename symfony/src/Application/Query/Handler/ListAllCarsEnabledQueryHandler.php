<?php

namespace App\Application\Query\Handler;

use App\Application\Query\ListAllCarsEnabledQuery;
use \App\Application\UseCases\Car\ListAllCarsEnabled;

class ListAllCarsEnabledQueryHandler
{
    private $listAllCarsEnabled;

    /**
     * ListAllCarsEnabledQueryHandler constructor.
     * @param $listAllCarsEnabled
     */
    public function __construct(ListAllCarsEnabled $listAllCarsEnabled)
    {
        $this->listAllCarsEnabled = $listAllCarsEnabled;
    }

    public function __invoke(ListAllCarsEnabledQuery $query)
    {
        return $this->listAllCarsEnabled->getCarsEnabled();
    }
}