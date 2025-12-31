<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProductNotificationService;
use App\Http\Requests\ApiStoreProductNotificationRequest;

class ProductNotificationController extends Controller
{
    protected $productNotificationService;

    public function __construct(ProductNotificationService $productNotificationService)
    {
        $this->productNotificationService = $productNotificationService;

    }

    public function store(ApiStoreProductNotificationRequest $request)
    {
        $data = $request->all();

        $notification = $this->productNotificationService->makeNotification($data);

        return $notification;
    }
}
