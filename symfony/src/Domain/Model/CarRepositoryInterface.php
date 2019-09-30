<?php

namespace App\Domain\Model;

use App\Domain\Criteria\Criteria;

interface CarRepositoryInterface
{
    public function getBySlug(string $slug);
    public function save(Car $car): void;
    public function delete(Car $car): void;
    public function findAllEnabled(int $limit = 0, int $offset = 0): array;
    public function findAll(): array;
    public function searchByCriteria(Criteria $criteria): array;
    public function findOneById($id);
}