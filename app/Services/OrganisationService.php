<?php

declare(strict_types=1);

namespace App\Services;

use App\Organisation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * Class OrganisationService
 * @package App\Services
 */
class OrganisationService
{

    public static $subscribedEnums = [
        'subbed' => 1,
        'trial' => 0,
    ];

    /**
     * @param array $attributes
     *
     * @return Organisation
     */
    public function createOrganisation(array $attributes): Organisation
    {
        $organisation = new Organisation();
        $organisation->name = $attributes['name'];
        $organisation->trial_end = Carbon::now()->addDays(30);
        return Auth::user()->companies()->save($organisation)->refresh();
    }

    /**
     * @param array $filter
     *
     * @return Collection<Organisation>
     */
    public function list($filter)
    {
        if (isset($filter['subscribed'])) {
            if (array_key_exists($filter['subscribed'], self::$subscribedEnums)) {
               return Organisation::{$filter['subscribed']}()->get();
            }
            elseif($filter['subscribed'] == 'all'){
                return Organisation::all();
            }
            return [];
        }
       return Organisation::all();
    }
}
