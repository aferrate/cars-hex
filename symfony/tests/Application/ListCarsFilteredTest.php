<?php

namespace App\Tests\Application;

use App\Domain\Criteria\Criteria;
use App\Infrastructure\Repository\CarRepository;
use App\Tests\Domain\CarMother;
use PHPUnit\Framework\TestCase;

class ListCarsFilteredTest extends TestCase
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
        $filters = [];

        $car1 = CarMother::createRandom();
        $car2 = CarMother::createRandom();
        $car1->setEnabled(true);
        $car2->setEnabled(true);
        $car1->setModel('test aaaa');
        $car2->setModel('test bbbb');

        $cars[] = $car1;
        $cars[] = $car2;

        $filters[] = 'model LIKE %test%';
        $criteria = new Criteria($filters, '');

        $this->carRepo->expects($this->once())
            ->method('searchByCriteria')
            ->with($criteria)
            ->willReturn($cars);

        $result = $this->carRepo->searchByCriteria($criteria);

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertCount(2, $result);
        $this->assertSame('test aaaa', $result[0]->getModel());
        $this->assertSame('test bbbb', $result[1]->getModel());
    }
}