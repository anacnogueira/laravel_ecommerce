<?php

namespace App\Repositories\Contracts;

interface ProductContactRepositoryInterface
{
    public function getFavoriteProductsByCustomerId(int $customerId);
}
