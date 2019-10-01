<?php

namespace App\Tests;

use App\Domain\Model\Car;
use DateTime;
use DateTimeImmutable;

class CarRepositoryTest extends AbstractTest
{
    /** @test */
    public function it_should_save_a_video(): void
    {
        $car = new Car();
        $car->setMark('test mark');
        $car->setModel('test model');
        $car->setYear(1900);
        $car->setCountry('Spain');
        $car->setCity('Madrid');
        $car->setDescription('test description');
        $car->setSlug('test-car-1');
        $car->setCreatedAt(new DateTimeImmutable('NOW'));
        $car->setUpdatedAt(new DateTime('NOW'));

        $this->repository()->save($car);
    }

    private function repository()
    {
        return $this->entityManager->getRepository(Car::class);
    }
}