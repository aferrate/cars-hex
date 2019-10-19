<?php

namespace App\Tests\Application;

use App\Domain\Model\Car;
use App\Infrastructure\Repository\CarRepository;
use App\Tests\Domain\CarMother;
use PHPUnit\Framework\TestCase;

class GetCarInfoTest extends TestCase
{
    private $carRepo;

    public function setUp(): void
    {
        $this->carRepo = $this->createMock(CarRepository::class);;
    }

    /** @test */
    public function it_should_get_car_info(): void
    {
        $car = CarMother::createRandom();
        $car->setSlug('test-slug');

        $this->carRepo->expects($this->once())
            ->method('getBySlug')
            ->with($car->getSlug())
            ->willReturn($car);

        $this->assertInstanceOf(Car::class, $this->carRepo->getBySlug($car->getSlug()));
        $this->assertEquals('test-slug', $car->getSlug());
    }
}