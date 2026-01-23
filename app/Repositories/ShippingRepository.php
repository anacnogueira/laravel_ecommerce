<?php

namespace App\Repositories;

use App\Repositories\Contracts\ShippingRepositoryInterface;
use App\Models\Shipping;

class ShippingRepository implements ShippingRepositoryInterface
{
    protected $entity;

    public function __construct(Shipping $shipping)
    {
        $this->entity = $shipping;
    }

    /**
     * Get all Shippings
     * @return array
     */
    public function getAllShippings()
    {
        return $this->entity->all();
    }

    /**
     * Select Shipping by ID
     * @param int $id
     * @return object
     */
    public function getShippingById($id)
    {
        return $this->entity->find($id);
    }

    /**
     * Create a new Shipping
     * @param array $data
     * @return object
     */
    public function createShipping(array $data)
    {
        return $this->entity->create($data);
    }

     /**
     * Update data of Shipping
     * @param object $Shipping
     * @param array $data
     * @return object
     */
    public function updateShipping(Shipping $shipping, array $data)
    {
        return $shipping->update($data);
    }

    /**
     * Delete a Shipping
     * @param object $Shipping
     */
    public function destroyShipping(Shipping $shipping)
    {
        return $shipping->delete();
    }
}
