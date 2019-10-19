<?php

namespace App\Tests\Application;

use App\Domain\Criteria\Criteria;
use App\Infrastructure\Repository\CarRepository;
use App\Tests\Domain\CarMother;
use PHPUnit\Framework\TestCase;

class ListAllCarsEnabledTest extends TestCase
{
    private $carRepo;

    public function setUp(): void
    {
        $this->carRepo = $this->createMock(CarRepository::class);;
    }

    /** @test */
    public function it_should_list_all_cars_enabled(): void
    {
        $cars = [];

        $car1 = CarMother::createRandom();
        $car2 = CarMother::createRandom();
        $car1->setEnabled(true);
        $car2->setEnabled(true);

        $cars[] = $car1;
        $cars[] = $car2;

        $criteria = new Criteria([], '');

        $this->carRepo->expects($this->once())
            ->method('searchByCriteria')
            ->with($criteria)
            ->willReturn($cars);

        $result = $this->carRepo->searchByCriteria($criteria);

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertCount(2, $result);
    }
}