<?php

declare(strict_types=1);

namespace App\Services;

use App\Filters\OrganisationFilter;
use App\Organisation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * Class OrganisationService
 * @package App\Services
 */
class OrganisationService
{

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
     * @return Organisation
     */
    public function list($filter)
    {
        $organisations = Organisation::all();

        if (isset($filter['subscribed'])) {
            return OrganisationFilter::subscribed($organisations, $filter['subscribed']);
        }

        return $organisations;
    }
}
