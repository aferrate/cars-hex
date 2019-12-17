<?php

namespace App\Infrastructure\Elasticsearch;

class TranslateFilterElastic
{
    public static function translateFilter(string $field, string $search)
    {
        $filter = [];

        switch ($field) {
            case 'mark':
                if($field !== '') {
                    $filter = [
                        'bool' => [
                            'must' => [
                                ['wildcard' => ['mark' => '*' . $search . '*']],
                                ['match' => ['enabled' => true]]
                            ]
                        ]
                    ];
                }
                break;
            case 'model':
                if($field !== '') {
                    $filter = [
                        'bool' => [
                            'must' => [
                                ['wildcard' => ['model' => '*' . $search . '*']],
                                ['match' => ['enabled' => true]]
                            ]
                        ]
                    ];
                }
                break;
            case 'year':
                if($field !== '') {
                    $filter = [
                        'bool' => [
                            'must' => [
                                ['match' => ['year' => $search]],
                                ['match' => ['enabled' => true]]
                            ]
                        ]
                    ];
                }
                break;
        }

        return $filter;
    }
}