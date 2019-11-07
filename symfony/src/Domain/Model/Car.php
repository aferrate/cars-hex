<?php

namespace App\Domain\Model;

use App\Domain\Aggregate\AggregateRoot;
use App\Domain\Event\CarCreated;
use App\Domain\Event\CarUpdated;
use App\Domain\Event\CarDeleted;
use DateTimeImmutable;
use DateTime;

final class Car extends AggregateRoot
{
    private $id;
    private $mark;
    private $model;
    private $year;
    private $description;
    private $slug;
    private $enabled;
    private $createdAt;
    private $updatedAt;
    private $country;
    private $city;
    private $imageFilename;

    public function __construct() {}

    public static function create(Car $car)
    {
        $car->record(new CarCreated($car));

        return $car;
    }

    public static function update(Car $car)
    {
        $car->record(new CarUpdated($car));

        return $car;
    }

    public static function delete(Car $car)
    {
        $car->record(new CarDeleted($car));

        return $car;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getMark(): string
    {
        return (!is_null($this->mark)) ? $this->mark : '';
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return (!is_null($this->model)) ? $this->model : '';
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return (!is_null($this->year)) ? $this->year : 0;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return (!is_null($this->description)) ? $this->description : '';
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return (!is_null($this->slug)) ? $this->slug : '';
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return (!is_null($this->country)) ? $this->country : '';
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return (!is_null($this->city)) ? $this->city : '';
    }

    /**
     * @return string
     */
    public function getImageFilename(): string
    {
        $return = ($this->imageFilename == null) ?  '' : $this->imageFilename;

        return $return;
    }

    /**
     * @param int $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $mark
     */
    public function setMark(string $mark): void
    {
        $this->mark = $mark;
    }

    /**
     * @param string $model
     */
    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    /**
     * @param int $year
     */
    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = strtolower(str_replace(' ', '-', $slug));
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    /**
     * @param DateTimeImmutable $createdAt
     */
    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @param string $imageFilename
     */
    public function setImageFilename(string $imageFilename): void
    {
        $this->imageFilename = ($imageFilename === '' ? null : $imageFilename);
    }
}