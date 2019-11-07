<?php

namespace App\Application\Command;

class CreateCarCommand
{
    private $mark;
    private $model;
    private $country;
    private $city;
    private $description;
    private $year;
    private $enabled;
    private $imageName;

    public function __construct(
        string $mark,
        string $model,
        string $country,
        string $city,
        string $description,
        int $year,
        bool $enabled,
        string $imageName
    )
    {
        $this->mark = $mark;
        $this->model = $model;
        $this->country = $country;
        $this->city = $city;
        $this->description = $description;
        $this->year = $year;
        $this->enabled = $enabled;
        $this->imageName = $imageName;
    }

    /**
     * @return mixed
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @return mixed
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @return mixed
     */
    public function getImageName()
    {
        return $this->imageName;
    }
}