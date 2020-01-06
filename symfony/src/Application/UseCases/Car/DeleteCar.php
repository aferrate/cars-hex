<?php

namespace App\Application\UseCases\Car;

use App\Domain\Event\DomainEventPublisher;
use App\Domain\Model\Car;
use App\Domain\Model\CarRepositoryInterface;
use App\Domain\Photo\PhotoManager;

class DeleteCar
{
    private $carRepository;
    private $photoManager;
    private $publisher;

    /**
     * DeleteCar constructor.
     * @param $carRepository
     */
    public function __construct(
        CarRepositoryInterface $carRepository,
        CarRepositoryInterface $carBackupRepository,
        PhotoManager $photoManager,
        DomainEventPublisher $publisher
    )
    {
        $this->carRepository = $carRepository;
        $this->carBackupRepository = $carBackupRepository;
        $this->photoManager = $photoManager;
        $this->publisher = $publisher;
    }

    /**
     * @return bool
     */
    public function delete(int $carId): bool
    {
        $car = $this->carRepository->findOneById($carId);

        if(!$car) {
            throw new \Exception();
        }

        $this->photoManager->deleteOldPhoto($car->getImageFilename());

        Car::delete($car);

        $this->publisher->publishRecorded($car->pullDomainEvents());

        $this->carBackupRepository->delete($car);
        $this->carRepository->delete($car);

        return true;
    }
}