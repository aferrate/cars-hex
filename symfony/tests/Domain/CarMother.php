<?php

namespace App\Tests\Domain;

use App\Domain\Model\Car;
use Faker\Factory;
use DateTimeImmutable;

class CarMother
{
    public static function createRandom(): Car
    {
        $faker = Factory::create();

        $car = new Car();
        $car->setMark($faker->asciify('mark ****'));
        $car->setModel($faker->asciify('model ****'));
        $car->setYear($faker->numberBetween(1990, 2019));
        $car->setCountry($faker->randomElement(['eeuu', 'france', 'spain']));
        $car->setCity($faker->randomElement(
            ['Dallas', 'Houston', 'Miami', 'Paris','Lyon', 'Nantes', 'Barcelona', 'Madrid', 'Valencia'])
        );
        $car->setDescription($faker->text(60));
        $car->setSlug($car->getMark().'-'.$car->getModel().'-'.$car->getYear());
        $car->setCreatedAt(
            DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-30 years', '-5 years', null))
        );
        $car->setUpdatedAt($faker->dateTimeBetween('-4 years', 'now', null));
        $car->setEnabled($faker->randomElement([true, false]));

        return $car;
    }
}