<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Organisation;
use App\Services\OrganisationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrganisationRequest;

/**
 * Class OrganisationController
 * @package App\Http\Controllers
 */
class OrganisationController extends ApiController
{
    /**
     * @param OrganisationService $service
     *
     * @return JsonResponse
     */
    public function store(OrganisationService $service, OrganisationRequest $request): JsonResponse
    {
        $organisation = $service->createOrganisation($request->all());

        return $this
            ->transformItem('organisation', $organisation, ['user'])
            ->respond();
    }

    /**
     * @param OrganisationService $service
     *
     * @return JsonResponse
     */
    public function listAll(OrganisationService $service)
    {
        $filter = isset($_GET['filter']) ? $_GET['filter'] : false;

        $organisations = $service->list($filter);

        return $this
            ->transformCollection('organisations', $organisations, ['user'])
            ->respond();
    }
}
