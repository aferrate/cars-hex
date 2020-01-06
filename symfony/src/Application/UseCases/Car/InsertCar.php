<?php

namespace App\Application\UseCases\Car;

use App\Domain\Model\CarRepositoryInterface;
use App\Domain\Photo\PhotoManager;
use App\Domain\Model\Car;
use DateTime;
use App\Domain\Event\DomainEventPublisher;

class InsertCar
{
    private $carRepository;
    private $photoManager;
    private $publisher;
    private $carBackupRepository;

    /**
     * InsertCar constructor.
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
    public function insert($car): bool
    {
        $car->setCreatedAt(new DateTime('NOW'));
        $car->setUpdatedAt(new DateTime('NOW'));
        $car->setSlug($car->getMark().'-'.$car->getModel().'-'.$car->getYear());

        $this->carRepository->save($car);
        $this->carBackupRepository->save($car);

        Car::create($car);

        $this->publisher->publishRecorded($car->pullDomainEvents());

        return true;
    }
}