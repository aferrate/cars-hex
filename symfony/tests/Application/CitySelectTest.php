<?php

namespace App\Tests\Application;

use App\Tests\Domain\CarMother;
use PHPUnit\Framework\TestCase;

class CitySelectTest extends TestCase
{
    /** @test */
    public function it_should_change_city(): void
    {
        $car = CarMother::createRandom();
        $car->setCountry('test country');

        $this->assertEquals('test country', $car->getCountry());
    }
}