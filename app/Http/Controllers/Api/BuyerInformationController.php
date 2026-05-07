<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


class BuyerInformationController extends Controller
{
    public function __invoke()
    {
        $customer = auth()->user();

        preg_match('/^.*(?<ddd>[1-9][0-9]).*(?<prefixo>\d{4}).*(?<sufixo>\d{4})$/', $customer->phone ,$matches);
        return [
            'name' => $customer->name,
            'email' => $customer->email,
            'phone' => $customer->phone,
            'cpf' => $customer->cpf,
            'ddd' => $matches["ddd"],
            'phone' => $matches['prefixo'].'-'.$matches['sufixo'],
            'date_birth' => $customer->date_birth,
        ];

    }
}
