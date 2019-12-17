<?php

namespace App\Infrastructure\Elasticsearch;

use App\Domain\Model\Car;
use DateTime;
use DateTimeImmutable;

class ResultsFormatter
{
    public static function formatResultsArray($elasticResult)
    {
        $result = [];
        $x = 0;

        if(empty($elasticResult['hits']['hits'])) {
            return [new Car()];
        }

        foreach ($elasticResult['hits']['hits'] as $row) {
            $car = new Car();

            $car->setId($row['_source']['id']);
            $car->setMark($row['_source']['mark']);
            $car->setModel($row['_source']['model']);
            $car->setYear($row['_source']['year']);
            $car->setDescription($row['_source']['description']);
            $car->setSlug($row['_source']['slug']);
            $car->setEnabled($row['_source']['enabled']);
            $car->setCreatedAt(
                DateTimeImmutable::createFromFormat(
                    'Y-m-d H:i:s', $row['_source']['created_at']));
            $car->setUpdatedAt(
                DateTime::createFromFormat(
                    'Y-m-d H:i:s', $row['_source']['updated_at']));
            $car->setCountry(is_null($row['_source']['country']) ? '' : $row['_source']['country']);
            $car->setCity(is_null($row['_source']['city']) ? '' : $row['_source']['city']);
            $car->setImageFilename(is_null($row['_source']['image_filename'])
                ? '' : $row['_source']['image_filename']);

            $x++;
            $result[] = $car;

        }

        return $result;
    }
}