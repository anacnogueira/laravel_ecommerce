<?php
namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Efi\Exception\EfiException;
use Efi\EfiPay;
use Carbon\Carbon;

class CreditCardService
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

    public function createCharge($infoCreditCard)
    {

        $items =  array_map(function($item) {
            $item['name'] = Str::ascii($item['name']);
            $item['amount'] =  (int)$item['amount'];
            $item['value'] = (int)($item['value'] * 100);
            return $item;
        }, $infoCreditCard['items']);

        $shippings =  array_map(function($shipping) {
            $shipping['name'] = Str::ascii($shipping['name']);
            $shipping['value'] = (int)($shipping['value'] * 100);
            return $shipping;
        },  $infoCreditCard['shippings']);


        $metadata = [
            "custom_id" => "Order_" . $infoCreditCard['order_id'],
            "notification_url" => env("EFI_PAYMENT_NOTIFICATION_URL")
        ];
        
        $customer = [
            "name" => Str::ascii($infoCreditCard['name']),
            "cpf" =>  $infoCreditCard['cpf'],
            "phone_number" => $infoCreditCard['phone'],
            "email" => $infoCreditCard['email'],
            "birth" => Carbon::createFromFormat('d/m/Y', $infoCreditCard['birth'])->format('Y-m-d'),
        ];

        $billingAddress = [
            "street" => $infoCreditCard['billing_address']['street'],
            "number" => $infoCreditCard['billing_address']['number'],
            "neighborhood" => $infoCreditCard['billing_address']['neighborhood'],
            "zipcode" => preg_replace('/[^0-9]/','',$infoCreditCard['billing_address']['zipcode']),
            "city" => $infoCreditCard['billing_address']['city'],
            "state" => $infoCreditCard['billing_address']['state'],
        ];

        $discount = [
            "type" => $infoCreditCard['discount']['type'],
            "value" => (int)($infoCreditCard['discount']['value'] * 100)
        ];
        
        $credit_card = [
            "customer" => $customer,
            "installments" => (int)$infoCreditCard['discount'],
            "billing_address" => $billingAddress,
            "payment_token" => $infoCreditCard['payment_token'],            
        ];

        if ($discount["value"] > 0) {
            $credit_card['discount'] = $discount;
        }

        $payment = [
            "credit_card" => $credit_card
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