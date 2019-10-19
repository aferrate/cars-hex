<?php

namespace App\Tests\Application;

use App\Domain\Model\Car;
use App\Tests\Domain\CarMother;
use PHPUnit\Framework\TestCase;
use App\Infrastructure\Repository\CarRepository;
use App\Infrastructure\Event\SymfonyDomainEventPublisher;

class InsertCarTest extends TestCase
{
    private $carRepo;
    private $domainPublisher;

    public function setUp(): void
    {
        $this->carRepo = $this->createMock(CarRepository::class);
        $this->domainPublisher = $this->createMock(SymfonyDomainEventPublisher::class);
    }

    /** @test */
    public function it_should_create_a_car(): void
    {
        $car = CarMother::createRandom();
        Car::create($car);

        $this->carRepo->expects($this->once())
            ->method('save')
            ->with($car)
            ->willReturn(null);

        $this->domainPublisher->expects($this->once())
            ->method('publishRecorded')
            ->with($car->pullDomainEvents())
            ->willReturn(null);

        $this->assertSame(null, $this->carRepo->save($car));
        $this->assertSame(null, $this->domainPublisher->publishRecorded($car->pullDomainEvents()));
    }
}