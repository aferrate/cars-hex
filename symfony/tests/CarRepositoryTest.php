<?php

namespace App\Tests;

use App\Domain\Criteria\Criteria;
use App\Domain\Model\Car;
use DateTime;
use DateTimeImmutable;
use App\Infrastructure\Repository\CarRepository;

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
        $car->setEnabled(true);

        $this->repository()->save($car);
    }

    /** @test */
    public function it_should_delete_a_video(): void
    {
        $car = $this->repository()->findOneByMark('test mark');

        $this->repository()->delete($car);
    }

    /** @test */
    public function it_should_find_by_slug(): void
    {
        $car = $this->repository()->getBySlug('mark-0-model-0-2000');

        $this->assertInstanceOf(Car::class, $car);
        $this->assertEquals('model 0', $car->getModel());
    }

    /** @test */
    public function it_should_find_all_enabled(): void
    {
        $cars = $this->repository()->findAllEnabled();

        $this->assertIsArray($cars);
        $this->assertNotEmpty($cars);
    }

    /** @test */
    public function it_should_find_all(): void
    {
        $cars = $this->repository()->findAllEnabled();

        $this->assertIsArray($cars);
        $this->assertNotEmpty($cars);
    }

    /** @test */
    public function it_should_find_by_id(): void
    {
        $car = $this->repository()->findOneById(1);

        $this->assertInstanceOf(Car::class, $car);
        $this->assertEquals('model 0', $car->getModel());
    }

    /** @test */
    public function it_should_find_by_criteria(): void
    {
        $filters = [];
        $filters[] = 'mark LIKE \'%mark%\'';

        $criteria = new Criteria($filters, 'DESC');

        $cars = $this->repository()->searchByCriteria($criteria);

        $this->assertIsArray($cars);
        $this->assertNotEmpty($cars);
    }

    /** @test */
    public function it_should_not_find_a_non_existing_car(): void
    {
        $this->assertNull($this->repository()->findOneById(999));
    }

    private function repository(): CarRepository
    {
        return $this->service(CarRepository::class);
    }
}