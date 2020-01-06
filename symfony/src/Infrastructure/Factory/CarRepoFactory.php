<?php

namespace App\Infrastructure\Factory;

use App\Domain\Model\CarRepositoryInterface;
use App\Infrastructure\Repository\CarRepository;
use App\Infrastructure\Repository\CarElasticRepository;

class CarRepoFactory
{
    public $carRepoMysql;
    public $carRepoElastic;

    /**
     * CarRepoFactory constructor.
     * @param $carRepoMysql
     * @param $carRepoElastic
     */
    public function __construct(CarRepository $carRepoMysql, CarElasticRepository $carRepoElastic)
    {
        $this->carRepoMysql = $carRepoMysql;
        $this->carRepoElastic = $carRepoElastic;
    }

    public function createCarRepo(string $carRepoOption): CarRepositoryInterface
    {
        $return = null;

        switch ($carRepoOption){
            case 'mysql':
                $return = $this->carRepoMysql;
                break;
            case 'elastic':
                $return = $this->carRepoElastic;
                break;
        }

        return $return;
    }
}