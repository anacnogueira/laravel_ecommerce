<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Efi\Exception\EfiException;
use Efi\EfiPay;

class PaymentNotificationController extends Controller
{
    protected $options = [];

    public function __construct()
    {
        $this->options = [
            "client_id" => env("PIX_PSP_CLIENT_ID"),
            "client_secret" =>  env("PIX_PSP_CLIENT_SECRET"),
            "pix_cert" => Storage::path('public/certificates/'. env("PIX_PSP_CERT")),
            "sandbox" => env("PIX_PSP_SANDBOX"),
            "debug" => false,
            "timeout" => 0
        ];
    }
    
    public function store(Request $request)
    {
        $params = [
            'token' => $request->input('notification'),
        ];

        try {
            $api = new EfiPay($this->options);
            $response = $api->getNotification($params, []);

            $fileName = "notification-charge-".date("Y-m-d-h-i-s").".log";
            Storage::disk('local')->put($fileName, $response);

            //To do:
            // Alterar dados do pedido na tabela
        } catch (EfiException $e) {
            print_r($e->code);
            print_r($e->error);
            print_r($e->errorDescription);
        } catch (Exception $e) {
            print_r($e->getMessage());
        }            
    }
}
