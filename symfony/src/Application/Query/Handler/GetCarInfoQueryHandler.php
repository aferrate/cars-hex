<?php

namespace App\Application\Query\Handler;

use App\Application\UseCases\Car\GetCarInfo;
use App\Application\Query\GetCarInfoQuery;

class GetCarInfoQueryHandler
{
    private $getCarInfo;

    /**
     * GetCarInfoQueryHandler constructor.
     * @param $getCarInfo
     */
    public function __construct(GetCarInfo $getCarInfo)
    {
        $this->getCarInfo = $getCarInfo;
    }

    public function __invoke(GetCarInfoQuery $query)
    {
        return $this->getCarInfo->getCarDetails($query->getSlug());
    }
}