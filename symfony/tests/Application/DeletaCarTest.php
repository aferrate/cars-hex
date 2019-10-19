<?php

namespace App\Tests\Application;

use App\Domain\Model\Car;
use App\Infrastructure\Event\SymfonyDomainEventPublisher;
use App\Infrastructure\Repository\CarRepository;
use App\Tests\Domain\CarMother;
use PHPUnit\Framework\TestCase;

class DeletaCarTest extends TestCase
{
    private $carRepo;
    private $domainPublisher;

    public function setUp(): void
    {
        $this->carRepo = $this->createMock(CarRepository::class);
        $this->domainPublisher = $this->createMock(SymfonyDomainEventPublisher::class);
    }

    /** @test */
    public function it_should_delete_car(): void
    {
        $car = CarMother::createFromData(
            1,
            'mark 0',
            'model 0',
            2000,
            'EEUU',
            'Dallas',
            'description 0',
            'mark-0-model-0-2000',
            1
        );
        Car::delete($car);

        $this->carRepo->expects($this->once())
            ->method('delete')
            ->with($car)
            ->willReturn(null);

        $this->domainPublisher->expects($this->once())
            ->method('publishRecorded')
            ->with($car->pullDomainEvents())
            ->willReturn(null);

        $this->assertSame(null, $this->carRepo->delete($car));
        $this->assertSame(null, $this->domainPublisher->publishRecorded($car->pullDomainEvents()));
    }
}