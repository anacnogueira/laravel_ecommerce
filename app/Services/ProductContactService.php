<?php

namespace App\Services;

use App\Repositories\Contracts\ProductContactRepositoryInterface;

class ProductContactService
{
    protected $productContactRepository;

    public function __construct(ProductContactRepositoryInterface $productContactRepository)
    {
        $this->productContactRepository = $productContactRepository;
    }

    /**
     * Select all Favorites Products by CustomerId
     * @return array
    */
    public function getFavoriteProductsByCustomerId($customerId)
    {
        return $this->productContactRepository->getFavoriteProductsByCustomerId($customerId);
    }
}
