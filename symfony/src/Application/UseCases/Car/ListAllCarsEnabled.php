<?php

namespace App\Application\UseCases\Car;

use App\Infrastructure\Factory\CarRepoFactory;

class ListAllCarsEnabled
{
    private $carRepository;

    /**
     * ListAllCarsEnabled constructor.
     * @param $carRepository
     */
    public function __construct(string $carRepoData, CarRepoFactory $carRepoFactory)
    {
        $this->carRepository = $carRepoFactory->createCarRepo($carRepoData);
    }

    /**
     * @return array
     */
    public function getCarsEnabled(): array
    {
        return $this->carRepository->findAllEnabled();
    }
}