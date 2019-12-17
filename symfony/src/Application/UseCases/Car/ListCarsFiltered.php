<?php

namespace App\Application\UseCases\Car;

use App\Domain\Criteria\Criteria;
use App\Domain\Model\CarRepositoryInterface;

class ListCarsFiltered
{
    private $carRepository;

    /**
     * GetCarInfo constructor.
     * @param $carRepository
     */
    public function __construct(CarRepositoryInterface $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    /**
     * @return array
     */
    public function getCarsFiltered($query): array
    {
        $criteria = new Criteria($this->carRepository->translateFilter(
            $query->getField(), $query->getSearch()), 'DESC');

        return $this->carRepository->searchByCriteria($criteria);
    }
}