<?php

namespace App\Repositories\Contracts;

use App\Models\Shipping;

interface ShippingRepositoryInterface
{
    public function getAllShippings();
    public function getShippingById($id);
    public function createShipping(array $data);
    public function updateShipping(Shipping $shipping, array $data);
    public function destroyShipping(Shipping $shipping);
}
