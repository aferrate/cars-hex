<?php

namespace App\Application\UseCases\Car;

use App\Domain\Model\CarRepositoryInterface;

class ListAllCars
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
    public function findAllCars(): array
    {
        return $this->carRepository->findAll();
    }
}