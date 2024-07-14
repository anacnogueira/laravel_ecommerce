<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BilletStoreRequest;
use App\Services\BilletService;

class BilletController extends Controller
{
    public function generateCharge(BilletStoreRequest $request)
    {
        $data = [
            'items' => $request->input('items'),
            'shippings' => $request->input('shippings'),
            'order_id' => $request->input('order_id'),
            'name' => $request->input('name'),
            'cpf' => $request->input('cpf'),
        ];

        $billetService = new BilletService();

        return response()->json($billetService->createCharge($data));
    }
}
