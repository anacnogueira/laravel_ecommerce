<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CityService;

class CityController extends Controller
{
    protected $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;

    }

    public function citiesByState($stateId)
    {

        $cities = $this->cityService->getCitiesByStateId($stateId);
        return response()->json($cities);
    }
}
