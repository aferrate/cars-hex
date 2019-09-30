<?php

namespace App\Application\UseCases\Car;

use App\Domain\Model\Car;

class CitySelect
{
    /**
     * @return Car
     */
   public function setCountry(string $country)
   {
       $car = new Car();
       $car->setCountry($country);

       return $car;
   }
}