<?php

namespace App\Application\UseCases\Car;

use App\Domain\Model\CarRepositoryInterface;

class ListAllCarsEnabled
{
    private $carRepository;

    /**
     * ListAllCarsEnabled constructor.
     * @param $carRepository
     */
    public function __construct(CarRepositoryInterface $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    /**
     * @return array
     */
    public function getCarsEnabled(): array
    {
        return $this->carRepository->findAllEnabled();
    }
}