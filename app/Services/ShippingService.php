<?php

namespace App\Services;

use App\Repositories\Contracts\ShippingRepositoryInterface;
use Illuminate\Support\Facades\Http;

class ShippingService
{
    protected $services;
    protected $shippingRepository;

    public function __construct(ShippingRepositoryInterface $shippingRepository)
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

        $this->shippingRepository = $shippingRepository;
    }

    public function getServiceDescription($shipping)
    {
        return $this->services[$shipping];
    }

     /**
     * Select all shippings
     * @return array
    */
    public function getAllShippings()
    {
        return $this->shippingRepository->getAllShippings();
    }

     /**
     * Create a new Shipping
     * @param array $data
     * @return object
    */
    public function makeShipping(array $data)
    {
        $data["status"] = isset($data["status"]) ? 'S' : 'N';

        $shipping = $this->shippingRepository->createShipping($data);

        return $shipping;
    }

    /**
     * Get Shipping by  ID
     * @param int $id
     * @return object
    */
    public function getShippingById(int $id)
    {
        return $this->shippingRepository->getShippingById($id);
    }


    /**
     * Update a shipping
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updateShipping(int $id, array $data)
    {
        $shipping = $this->shippingRepository->getShippingById($id);

        if (!$shipping) {
            return response()->json(['message' => 'Shipping Not Found'], 404);
        }

        $data["status"] = isset($data["status"]) ? 'S' : 'N';

        $this->shippingRepository->updateShipping($shipping, $data);

        return response()->json(['message' => 'Shipping Updated'], 200);
    }

     /**
     * Delete a Shipping
     * @param int $id
     * @return json response
    */
    public function destroyShipping(int $id)
    {
        $shipping = $this->shippingRepository->getShippingById($id);

        if (!$shipping) {
            return response()->json(['message' => 'Shipping Not Found'], 404);
        }

        $this->shippingRepository->destroyShipping($shipping);

        return response()->json(['message' => 'Shipping Deleted'], 200);
    }

    public function calculateShippingByFrenet(array $data)
    {
        $shippings = [];

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

            return response()->json(['shippings' => $shippings]);
        }

        return response()->json(['error' => 'Dados inválidos'], 500);
    }
}
