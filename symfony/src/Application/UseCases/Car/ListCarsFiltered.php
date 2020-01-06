<?php

namespace App\Application\UseCases\Car;

use App\Domain\Criteria\Criteria;
use App\Infrastructure\Factory\CarRepoFactory;

class ListCarsFiltered
{
    private $carRepository;

    /**
     * GetCarInfo constructor.
     * @param $carRepository
     */
    public function __construct(string $carRepoData, CarRepoFactory $carRepoFactory)
    {
        $this->carRepository = $carRepoFactory->createCarRepo($carRepoData);
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