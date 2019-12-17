<?php

namespace App\Infrastructure\Repository;

use App\Domain\Criteria\Criteria;
use App\Domain\Model\Car;
use App\Domain\Model\CarRepositoryInterface;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManagerInterface;
use App\Infrastructure\Doctrine\TranslateFilterDoctrine;

class CarRepository implements CarRepositoryInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getBySlug(string $slug)
    {
        return $this->entityManager->getRepository(Car::class)->findOneBy(['slug' => $slug]);
    }

    public function save(Car $car): void
    {
        $this->entityManager->persist($car);
        $this->entityManager->flush();
    }

    public function delete(Car $car): void
    {
        $this->entityManager->remove($car);
        $this->entityManager->flush();
    }

    public function findAllEnabled(int $limit = 0, int $offset = 0): array
    {
        $qb = $this->entityManager->createQueryBuilder();

        $cars = $qb->select('c')
            ->from('App:Car', 'c')
            ->where('c.enabled = TRUE')
            ->orderBy('c.createdAt', 'DESC')
            ->getQuery()
            ->getResult(AbstractQuery::HYDRATE_ARRAY)
        ;

        return $cars;
    }

    public function findAll(): array
    {
        return $this->entityManager->getRepository(Car::class)->findAll();
    }

    public function searchByCriteria(Criteria $criteria): array
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb->select('c')
            ->from('App:Car', 'c')
            ->where('c.enabled = TRUE')
        ;

        if($criteria->hasFilters()) {
            $filters = $criteria->getFilters();

            foreach ($filters as $filter) {
                $qb->andWhere('c.'. $filter);
            }
        }

        if($criteria->hasOrder()) {
            $qb->orderBy('c.createdAt', $criteria->getOrder());
        }

        $cars = $qb->getQuery()
            ->getResult(AbstractQuery::HYDRATE_ARRAY)
        ;

        return $cars;
    }

    public function findOneById($id)
    {
        return $this->entityManager->getRepository(Car::class)->findOneBy(['id' => $id]);
    }

    public function findOneByMark($mark)
    {
        return $this->entityManager->getRepository(Car::class)->findOneBy(['mark' => $mark]);
    }

    public function findOneByModel($model)
    {
        return $this->entityManager->getRepository(Car::class)->findOneBy(['model' => $model]);
    }

    public function translateFilter(string $field)
    {
        return TranslateFilterDoctrine::translateFilter($field);
    }
}