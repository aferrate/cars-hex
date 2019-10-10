<?php

namespace App\Tests\Infrastructure;

use App\Domain\Criteria\Criteria;
use App\Domain\Model\Car;
use App\Tests\Domain\CarMother;
use App\Infrastructure\Repository\CarRepository;

class CarRepositoryFunctionalTest extends AbstractTest
{
    /** @test */
    public function it_should_save_a_video(): void
    {
        $car = CarMother::createRandom();

        $this->repository()->save($car);
    }

    /** @test */
    public function it_should_delete_a_video(): void
    {
        $car = $this->repository()->findOneByMark('mark 0');

        $this->repository()->delete($car);
    }

    /** @test */
    public function it_should_find_by_slug(): void
    {
        $car = $this->repository()->getBySlug('mark-1-model-1-2001');

        $this->assertInstanceOf(Car::class, $car);
        $this->assertEquals('model 1', $car->getModel());
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
        $car = $this->repository()->findOneById(2);

        $this->assertInstanceOf(Car::class, $car);
        $this->assertEquals('model 1', $car->getModel());
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