<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreditCardStoreRequest;
use App\Services\CreditCardService;

class CreditCardController extends Controller
{
    public function generateCharge(CreditCardStoreRequest $request)
    {
        $data = [
            'items' => $request->input('items'),
            'shippings' => $request->input('shippings'),
            'order_id' => $request->input('order_id'),
            'name' => $request->input('name'),
            'cpf' => $request->input('cpf'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'birth' => $request->input('birth'),
            'installments' => $request->input('installments'),
            'billing_address' => $request->input('billing_address'),
            'discount' => $request->input('discount'),
            'payment_token' => $request->input('payment_token'),
        ];

        $creditCardService = new CreditCardService();

        return response()->json($creditCardService->createCharge($data));
    }
}
