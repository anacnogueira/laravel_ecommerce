<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ShippingService;
use App\Http\Requests\ApiCalculateShippingRequest;

class ShippingController extends Controller
{
    protected $shippingService;

    public function __construct(ShippingService $shippingService)
    {
        $this->shippingService = $shippingService;

    }

    public function calculate (ApiCalculateShippingRequest $request)
    {
        $data = $request->all();

        $result = $this->shippingService->calculateShippingByFrenet($data);

        return response()->json($result);
    }
}
