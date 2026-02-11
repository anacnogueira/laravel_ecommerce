<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProductContactRepositoryInterface;
use App\Models\Product;
use App\Models\ProductContact;

class ProductContactRepository implements ProductContactRepositoryInterface
{
    protected $entity;

    public function __construct(Product $product)
    {
        $this->entity = $product;
    }

    /**
     * Get all Favorite Active Products By CustomerId
     * @return array
     */
    public function getFavoriteProductsByCustomerId($customerId)
    {
        return $this->entity
            ->where('status','S')
            ->where("current_stock", ">", 0)
            ->whereIn('id', function($query) use ($customerId){
                $query->select('product_id')
                    ->from('product_contacts')
                    ->where('contact_id', $customerId)
                    ->where('type', 'favorite');
            })
            ->paginate(12);
    }

    public function favoriteStatusFromCustomerId($customerId, $productId)
    {
        return ProductContact::where('contact_id', $customerId)
            ->where('product_id', $productId)
            ->where('type', 'favorite')
            ->first();
    }

    /**
     * Create a new Product Contact
     * @param array $data
     * @return object
     */
    public function createProductContact(array $data)
    {
        return ProductContact::create($data);
    }

    /**
     * Delete a contact address
     * @param object $contactAddress
     */
    public function destroyProductContact($customerId, $productId, $type)
    {
        return ProductContact::where('contact_id', $customerId)
            ->where('product_id', $productId)
            ->where('type', $type)
            ->delete();
    }
}
