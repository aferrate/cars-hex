<?php

namespace App\Infrastructure\Repository;

use App\Domain\Criteria\Criteria;
use Elasticsearch\ClientBuilder;
use App\Domain\Model\CarRepositoryInterface;
use App\Domain\Model\Car;
use App\Infrastructure\Elasticsearch\TranslateFilterElastic;
use App\Infrastructure\Elasticsearch\ResultsFormatter;

class CarElasticRepository implements CarRepositoryInterface
{
    private $client;

    /**
     * CarElasticRepository constructor.
     * @param $client
     */
    public function __construct(string $host, string $port)
    {
        $this->client = ClientBuilder::create()->setHosts([$host.':'.$port])->build();;
    }

    public function save(Car $car): void
    {
        $existCar = $this->existCar($car->getId());

        ($existCar['exists']) ? $this->update($car, $existCar['docId']) : $this->insert($car);
    }

    public function delete(Car $car): void
    {
        $params = [
            'id'    => $this->existCar($car->getId())['docId'],
            'index' => 'cars',
            'type'  => '_doc'
        ];

        $this->client->delete($params);
    }

    public function getBySlug(string $slug)
    {
        $params = [
            'index' => 'cars',
            'body'  => [
                'query' => [
                    'match' => ['slug' => $slug]
                ]
            ]
        ];

        $car = ResultsFormatter::formatResultsArray($this->client->search($params))[0];

        return $car;
    }

    public function findAllEnabled(int $limit = 0, int $offset = 0): array
    {
        $params = [
            'index' => 'cars',
            'body'  => [
                'from' => 0,
                'size' => 1000,
                'query' => [
                    'match' => ['enabled' => true]
                ],
                'sort' => ['id' => ['order' => 'desc']]
            ]
        ];

        return ResultsFormatter::formatResultsArray($this->client->search($params));
    }

    public function findAll(): array
    {
        $params = [
            'index' => 'cars',
            'body'  => [
                'from' => 0,
                'size' => 1000,
                'query' => [
                    'match_all' => new \stdClass()
                ],
                'sort' => ['id' => ['order' => 'desc']]
            ]
        ];

        return ResultsFormatter::formatResultsArray($this->client->search($params));
    }

    public function searchByCriteria(Criteria $criteria): array
    {
        $filter = $criteria->hasFilters() ? $criteria->getFilters() : ['match' => ['enabled' => true]];
        $order = $criteria->hasOrder() ? $criteria->getOrder() : 'ASC';
        $sort = ['id' => ['order' => $order]];

        $params = [
            'index' => 'cars',
            'body'  => [
                'from' => 0,
                'size' => 1000,
                'query' => $filter,
                'sort' => $sort
            ]
        ];

        return ResultsFormatter::formatResultsArray($this->client->search($params));
    }

    public function findOneById($id)
    {
        $params = [
            'index' => 'cars',
            'body'  => [
                'query' => [
                    'match' => ['id' => $id]
                ]
            ]
        ];

        $car = $this->client->search($params);

        return $car;
    }

    public function findOneByMark($mark)
    {
        $params = [
            'index' => 'cars',
            'body'  => [
                'query' => [
                    'match' => ['mark' => $mark]
                ]
            ]
        ];

        $car = ResultsFormatter::formatResultsArray($this->client->search($params))[0];

        return $car;
    }

    public function findOneByModel($model)
    {
        $params = [
            'index' => 'cars',
            'body'  => [
                'query' => [
                    'match' => ['model' => $model]
                ]
            ]
        ];

        $car = ResultsFormatter::formatResultsArray($this->client->search($params))[0];

        return $car;
    }

    public function translateFilter(string $field, string $search)
    {
        return TranslateFilterElastic::translateFilter($field, $search);
    }

    public function existCar($id): array
    {
        $carExists = $this->findOneById($id);

        if($carExists['hits']['total'] == 0) {
            return ['exists' => false, 'docId' => null];
        }

        return ['exists' => true, 'docId' => $carExists['hits']['hits'][0]['_id']];
    }

    public function update(Car $car, string $docId)
    {
        $params = [
            'index' => 'cars',
            'type' => '_doc',
            'id' => $docId,
            'body' => [
                'doc' => [
                    'id' => $car->getId(),
                    'mark' => $car->getMark(),
                    'model' => $car->getModel(),
                    'year' => $car->getYear(),
                    'description' => $car->getDescription(),
                    'slug' => $car->getSlug(),
                    'enabled' => $car->isEnabled(),
                    'created_at' => $car->getCreatedAt()->format('Y-m-d H:i:s'),
                    'updated_at' => $car->getUpdatedAt()->format('Y-m-d H:i:s'),
                    'country' => $car->getCountry(),
                    'city' => $car->getCity(),
                    'image_filename' => $car->getImageFilename()
                ]
            ]
        ];

        $this->client->update($params);
    }

    public function insert(Car $car)
    {
        $params = [
            'index' => 'cars',
            'type' => '_doc',
            'body' => [
                'id' => $car->getId(),
                'mark' => $car->getMark(),
                'model' => $car->getModel(),
                'year' => $car->getYear(),
                'description' => $car->getDescription(),
                'slug' => $car->getSlug(),
                'enabled' => $car->isEnabled(),
                'created_at' => $car->getCreatedAt()->format('Y-m-d H:i:s'),
                'updated_at' => $car->getUpdatedAt()->format('Y-m-d H:i:s'),
                'country' => $car->getCountry(),
                'city' => $car->getCity(),
                'image_filename' => $car->getImageFilename()
            ]
        ];

        $this->client->index($params);
    }
}