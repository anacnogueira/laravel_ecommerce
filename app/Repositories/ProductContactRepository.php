<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProductContactRepositoryInterface;
use App\Models\Product;

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
}
