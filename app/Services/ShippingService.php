<?php

namespace App\Services;

use App\Repositories\Contracts\ShippingRepositoryInterface;

class ShippingService
{
    protected $services;
    protected $shippingRepository;

    public function __construct(ShippingRepositoryInterface $shippingRepository) {
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


}
