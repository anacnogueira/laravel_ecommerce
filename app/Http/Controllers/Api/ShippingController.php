<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ShippingService;
use App\Http\Requests\ApiCalculateShippingRequest;
use App\Services\CepSearchService;


class ShippingController extends Controller
{
    protected $shippingService;
    protected $cepSearchService;

    public function __construct(
        ShippingService $shippingService,
        CepSearchService $cepSearchService
    )
    {
        $this->shippingService = $shippingService;
        $this->cepSearchService = $cepSearchService;
    }

    public function calculate (ApiCalculateShippingRequest $request)
    {
        $data = $request->all();
        session(['cep' => $data['cep']]);
        $page = $data['page'];

        $shippings = $this->shippingService->calculateShipping($data);

        $this->cepSearchService->makeReportCepSearch($data['cep']);

        $renderHTML =  view("shippings.show", compact('shippings','page'))->render();
        return response()->json(['renderHTML'=>$renderHTML]);
    }
}
