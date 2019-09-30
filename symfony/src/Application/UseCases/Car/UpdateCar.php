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
    public function update($car, $uploadedFile): bool
    {
        if ($uploadedFile) {
            $newFilename = $this->photoManager->uploadArticleImage($uploadedFile, $car->getImageFilename());
            $car->setImageFilename($newFilename);
        }

        $car->setUpdatedAt(new DateTime('NOW'));

        $this->carRepository->save($car);

        Car::update($car);

        $this->publisher->publishRecorded($car->pullDomainEvents());

        return true;
    }
}