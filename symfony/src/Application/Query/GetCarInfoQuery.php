<?php

namespace App\Application\Query;

class GetCarInfoQuery
{
    private $slug;

    /**
     * GetCarInfoQuery constructor.
     * @param $slug
     */
    public function __construct(string $slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }
}