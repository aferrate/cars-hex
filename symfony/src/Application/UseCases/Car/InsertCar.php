<?php

namespace App\Application\UseCases\Car;

use App\Domain\Model\CarRepositoryInterface;
use App\Domain\Photo\PhotoManager;
use App\Domain\Model\Car;
use DateTime;
use DateTimeImmutable;
use App\Domain\Event\DomainEventPublisher;

class InsertCar
{
    private $carRepository;
    private $photoManager;
    private $publisher;

    /**
     * InsertCar constructor.
     */
    public function __construct(
        CarRepositoryInterface $carRepository,
        PhotoManager $photoManager,
        DomainEventPublisher $publisher
    )
    {
        $this->carRepository = $carRepository;
        $this->photoManager = $photoManager;
        $this->publisher = $publisher;
    }

    /**
     * @return bool
     */
    public function insert($car, $uploadedFile): bool
    {
        if ($uploadedFile) {
            $newFilename = $this->photoManager->uploadArticleImage($uploadedFile, null);
            $car->setImageFilename($newFilename);
        }

        $car->setCreatedAt(new DateTimeImmutable('NOW'));
        $car->setUpdatedAt(new DateTime('NOW'));
        $car->setSlug($car->getMark().'-'.$car->getModel().'-'.$car->getYear());

        $this->carRepository->save($car);

        Car::create($car);

        $this->publisher->publishRecorded($car->pullDomainEvents());

        return true;
    }
}