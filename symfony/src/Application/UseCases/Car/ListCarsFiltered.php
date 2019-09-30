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
    public function getCarsFiltered($request): array
    {
        $filters = [];

        switch ($request->request->get('field')) {
            case 'mark':
                if($request->request->get('search') !== '') {
                    $filters[] = 'mark LIKE \'%' . $request->request->get('search') . '%\'';
                }
                break;
            case 'model':
                if($request->request->get('search') !== '') {
                    $filters[] = 'model LIKE \'%' . $request->request->get('search') . '%\'';
                }
                break;
            case 'year':
                if($request->request->get('search') !== '') {
                    $filters[] = 'year ='. $request->request->get('search') .'';
                }
                break;
        }

        $criteria = new Criteria($filters, 'DESC');

        return $this->carRepository->searchByCriteria($criteria);
    }
}