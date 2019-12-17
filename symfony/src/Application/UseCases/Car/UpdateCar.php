<?php

namespace App\Application\UseCases\Car;

use App\Domain\Event\DomainEventPublisher;
use App\Domain\Model\Car;
use App\Domain\Model\CarRepositoryInterface;
use App\Domain\Photo\PhotoManager;
use DateTime;

class UpdateCar
{
    private $carRepository;
    private $photoManager;
    private $publisher;

    /**
     * UpdateCar constructor.
     * @param $carRepository
     * @param $photoManager
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
    public function update($command): bool
    {
        $car = $this->carRepository->findOneById($command->getId());

        $car->setMark($command->getMark());
        $car->setModel($command->getModel());
        $car->setCountry($command->getCountry());
        $car->setCity($command->getCity());
        $car->setDescription($command->getDescription());
        $car->setYear($command->getYear());
        $car->setEnabled($command->getEnabled());
        $car->setImageFilename($command->getImageName());
        $car->setUpdatedAt(new DateTime('NOW'));

        $this->carRepository->save($car);
        $this->carBackupRepository->save($car);

        Car::update($car);

        $this->publisher->publishRecorded($car->pullDomainEvents());

        return true;
    }
}