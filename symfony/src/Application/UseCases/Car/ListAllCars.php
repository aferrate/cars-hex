<?php

namespace App\Application\UseCases\Car;

use App\Infrastructure\Factory\CarRepoFactory;

class ListAllCars
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
    public function findAllCars(): array
    {
        return $this->carRepository->findAll();
    }
}