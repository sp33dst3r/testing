<?php

declare(strict_types=1);

namespace App\Filters;

use App\Organisation;

class OrganisationFilter
{
    public static $subscribedEnums = [
        'subbed' => 1,
        'trial' => 0,
    ];

    /**
     * @param Organisation $collection
     *
     * @param any $value
     *
     * @return Organisation
     */
    public static function subscribed($collection, $value)
    {
        //all is default value (no filter applied)
        return array_key_exists($value, self::$subscribedEnums) ? $collection->where('subscribed', self::$subscribedEnums[$value]) : $collection;
    }
}
