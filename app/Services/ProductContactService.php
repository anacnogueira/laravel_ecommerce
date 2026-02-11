<?php

namespace App\Services;

use App\Repositories\Contracts\ProductContactRepositoryInterface;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProductFavorited;

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

    public function makeProductContact(array $data)
    {
       $productContact = $this->productContactRepository->createProductContact($data);

        // Envia por e-mail
       Mail::to(env("SITE_EMAIL_DEV"))
        ->send(new ProductFavorited($productContact));

        return $productContact;

    }

    public function destroyProductContact($customerId, $productId, $type)
    {
        return $this->productContactRepository->destroyProductContact($customerId, $productId, $type);
    }


}
