<?php
namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Efi\Exception\EfiException;
use Efi\EfiPay;
use App\Services\TimeService;

class BilletService
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

    public function createCharge($infoBillet)
    {
        $timeService = new TimeService();

        $items =  array_map(function($item) {
            $item['name'] = Str::ascii($item['name']);
            $item['amount'] =  (int)$item['amount'];
            $item['value'] = (int)($item['value'] * 100);
            return $item;
        }, $infoBillet['items']);

        $shippings =  array_map(function($shipping) {
            $shipping['name'] = Str::ascii($shipping['name']);
            $shipping['value'] = (int)($shipping['value'] * 100);
            return $shipping;
        },  $infoBillet['shippings']);


        $metadata = [
            "custom_id" => "Order_" . $infoBillet['order_id'],
            "notification_url" => env("EFI_PAYMENT_NOTIFICATION_URL")
        ];
        
        $customer = [
            "name" => Str::ascii($infoBillet['name']),
            "cpf" =>  $infoBillet['cpf'],           
        ];

        $configurations = [
            "days_to_write_off" => 0
        ];

        $bankingBillet = [
            "expire_at" => $timeService->addDaysToNow(3), 
            "message" => "Este boleto não poderá ser pago após a data de vencimento.",
            "customer" => $customer,
            "configurations" => $configurations,
        ];

        $payment = [
            "banking_billet" => $bankingBillet
        ];
        
        $body = [
            "items" => $items,
            "shippings" => $shippings,
            "metadata" => $metadata,
            "payment" => $payment
        ];
        
        try {
            $api = new EfiPay($this->options);
            $response = $api->createOneStepCharge($params = [], $body);
            
            return  [
                'payment_link' => $response['data']["billet_link"],
                'status' => $response['data']['status'],
                'charge_id' => $response['data']['charge_id'],
            ];
        } catch (EfiException $e) {
            return $this->setExcectionMessageError($e->code, $e->error, $e->errorDescription);
        } catch (Exception $e) {
            return $this->setExcectionMessageError($e->getCode(), $e->getMessage());
        }
    }

    private function setExcectionMessageError($code, $message, $log = [])
    {
        //To do: Transformar em Log

        return [
            'error' => [
                "code" => $code,
                "description" => $message
            ]
        ];

    }
}