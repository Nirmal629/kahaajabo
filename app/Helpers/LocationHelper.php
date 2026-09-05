<?php

namespace App\Helpers;

use App\Models\State;
use App\Models\District;
use App\Models\Country;
use App\Models\City;
use App\Models\Area;

class LocationHelper
{
    public static function fetch($type, $filters = [])
    {
        $models = [
            'state'    => State::class,
            'district' => District::class,
            'city'     => City::class,
            'area'     => Area::class,
        ];

        if (!isset($models[$type])) {
            return collect();
        }

        $query = $models[$type]::query();

        $allowedFilters = [
            'country_id',
            'state_id',
            'district_id',
            'city_id',
        ];

        foreach ($allowedFilters as $field) {
            if (isset($filters[$field]) && $filters[$field] !== '') {
                $query->where($field, $filters[$field]);
            }
        }

        return $query->get();
    }
}