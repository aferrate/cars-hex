<?php

namespace App\Tests\Application;

use App\Infrastructure\Repository\CarRepository;
use App\Tests\Domain\CarMother;
use PHPUnit\Framework\TestCase;

class ListAllCarsTest extends TestCase
{
    private $carRepo;

    public function setUp(): void
    {
        $this->carRepo = $this->createMock(CarRepository::class);;
    }

    /** @test */
    public function it_should_list_all_cars(): void
    {
        $cars = [];

        $car1 = CarMother::createRandom();
        $car2 = CarMother::createRandom();

        $cars[] = $car1;
        $cars[] = $car2;

        $this->carRepo->expects($this->once())
            ->method('findAll')
            ->willReturn($cars);

        $result = $this->carRepo->findAll();

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertCount(2, $result);
    }
}