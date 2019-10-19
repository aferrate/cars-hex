<?php

namespace App\Tests\Application;

use App\Domain\Model\Car;
use App\Infrastructure\Event\SymfonyDomainEventPublisher;
use App\Infrastructure\Repository\CarRepository;
use App\Tests\Domain\CarMother;
use PHPUnit\Framework\TestCase;

class UpdateCarTest extends TestCase
{
    private $carRepo;
    private $domainPublisher;

    public function setUp(): void
    {
        $this->carRepo = $this->createMock(CarRepository::class);
        $this->domainPublisher = $this->createMock(SymfonyDomainEventPublisher::class);
    }

    /** @test */
    public function it_should_update_car(): void
    {
        $car = CarMother::createFromData(
            1,
            'mark 0',
            'model 0',
            2000,
            'EEUU',
            'Houston',
            'description 0',
            'mark-0-model-0-2000',
            1
        );
        Car::update($car);

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