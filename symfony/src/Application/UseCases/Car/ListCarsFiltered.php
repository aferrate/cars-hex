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
        $filters = [];

        switch ($query->getField()) {
            case 'mark':
                if($query->getSearch() !== '') {
                    $filters[] = 'mark LIKE \'%' . $query->getSearch() . '%\'';
                }
                break;
            case 'model':
                if($query->getSearch() !== '') {
                    $filters[] = 'model LIKE \'%' . $query->getSearch() . '%\'';
                }
                break;
            case 'year':
                if($query->getSearch() !== '') {
                    $filters[] = 'year ='. $query->getSearch() .'';
                }
                break;
        }

        $criteria = new Criteria($filters, 'DESC');

        return $this->carRepository->searchByCriteria($criteria);
    }
}