<?php

namespace App\Infrastructure\Elasticsearch;

class TranslateFilterElastic
{
    public static function translateFilter(string $field)
    {
        $filter = [];

        switch ($field) {
            case 'mark':
                if($field !== '') {
                    $filter = ['match_phrase' => ['mark' => $field]];
                }
                break;
            case 'model':
                if($field !== '') {
                    $filter = ['match_phrase' => ['model' => $field]];
                }
                break;
            case 'year':
                if($field !== '') {
                    $filter = ['match' => ['year' => $field]];
                }
                break;
        }

        return $filter;
    }
}