<?php

namespace App\Application\UseCases\Car;

use App\Domain\Model\Car;
use App\Infrastructure\Factory\CarRepoFactory;

class GetCarInfo
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
     * @return Car
     */
    public function getCarDetails($slug): Car
    {
        return $this->carRepository->getBySlug($slug);
    }
}