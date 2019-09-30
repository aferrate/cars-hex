<?php

namespace App\Application\UseCases\Car;

use App\Domain\Model\Car;
use App\Domain\Model\CarRepositoryInterface;

class GetCarInfo
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
     * @return Car
     */
    public function getCarDetails($slug): Car
    {
        return $this->carRepository->getBySlug($slug);
    }
}