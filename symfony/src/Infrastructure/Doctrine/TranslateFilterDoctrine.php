<?php

namespace App\Infrastructure\Doctrine;

class TranslateFilterDoctrine
{
    public static function translateFilter(string $field)
    {
        $filter = [];

        switch ($field) {
            case 'mark':
                if($field !== '') {
                    $filter[] = 'mark LIKE \'%' . $field . '%\'';
                }
                break;
            case 'model':
                if($field !== '') {
                    $filter[] = 'model LIKE \'%' . $field . '%\'';
                }
                break;
            case 'year':
                if($field !== '') {
                    $filter[] = 'year ='. $field .'';
                }
                break;
        }

        return $filter;
    }
}