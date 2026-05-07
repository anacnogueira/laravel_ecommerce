<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FrenetService
{
     protected $services;

     /**
     * FrenetService constructor.
     */
    public function __construct()
    {
        $this->services = [
           'pac' =>  'Correios PAC',
           'sedex' => 'Correios Sedex',
           'loja' => 'Retirada na loja|Pque Santo Antonio|',
           'motoboy' => 'Motoboy',
           'jadlog' => 'Jadlog',
           'Sequoia SFX' => 'Sequoia SFX',
           'Total Express' => 'Total Express',
        ];
    }

    public function calculateShipping(array $data)
    {
        $shippings = [];

        try {
            $response = Http::withHeaders([
            'token' => env("FRENET_TOKEN")
        ])
        ->post('http://api.frenet.com.br/shipping/quote',[
            "SellerCEP" => env("SELLER_CEP"),
            "RecipientCEP"=> $data["cep"],
            "ShipmentInvoiceValue" =>  $data['cart_value'],
            "ShippingItemArray" => [
                [
                    "Weight" => $data['weight'],
                    "Length" => $data['length'],
                    "Height" => $data['height'],
                    "Width" => $data['width'],
                    "Quantity" => $data['quantity'],
                    "SKU" => $data['sku'],
                ]
            ],
            "RecipientCountry" => "BR"
        ]);

        $result = $response->object()->ShippingSevicesArray ?? [];

        if (count($result) > 0) {
            for ($i = 0; $i < count($result); $i++) {
                if (!$result[$i]->Error) {
                    $shippings[$i]['PrazoEntrega'] = isset($result[$i]->DeliveryTime) ? $result[$i]->DeliveryTime : 0;
                    $shippings[$i]['nome'] = isset($result[$i]->ServiceDescription) ? $result[$i]->ServiceDescription : '';
                    $shippings[$i]['type'] = array_search($result[$i]->ServiceDescription, $this->services);
                    $shippings[$i]['valorFrete'] = isset($result[$i]->ShippingPrice) ? $result[$i]->ShippingPrice : 0.00;
                }
            }
            $valorFrete = array_column($shippings, 'valorFrete');
            array_multisort($valorFrete, SORT_ASC, $shippings);

            return $shippings;
        }
        } catch (\Exception $e) {

            return ['error' => $e->getMessage()];
        }

    }
}
