<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProductPhotoRepositoryInterface;
use App\Models\ProductPhoto;

class ProductPhotoRepository implements ProductPhotoRepositoryInterface
{
    protected $entity;

    public function __construct(ProductPhoto $productPhoto)
    {
        $this->entity = $productPhoto;
    }

    /**
     * Create a new ProductPhoto
     * @param array $data
     * @return object
     */
    public function createProductPhoto(array $data)
    {
        return $this->entity->create($data);
    }

     /**
     * Delete a Category
     * @param object $Category
     */
    public function deleteProductPhoto($productId, $order)
    {
        return $this->entity
            ->where('product_id', $productId)
            ->where('order', $order)
            ->delete();
    }

    /* Select ProductPhotos by ProductId
     * @param int $productId
     * @return object
     */
    public function getPhotosByProductId($productId)
    {
        return $this->entity
            ->select('photo_ori', 'photo_redim', 'order')
            ->where('product_id', $productId)->get();
    }

}
