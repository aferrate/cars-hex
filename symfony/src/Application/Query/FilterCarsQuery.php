<?php

namespace App\Application\Query;

class FilterCarsQuery
{
    private $field;
    private $search;

    /**
     * FilterCarsQuery constructor.
     * @param $field
     * @param $search
     */
    public function __construct(
        string $field,
        string $search)
    {
        $this->field = $field;
        $this->search = $search;
    }

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @return string
     */
    public function getSearch(): string
    {
        return $this->search;
    }
}