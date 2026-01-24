<?php

namespace App\Repositories;

use App\Repositories\Contracts\PromotionRepositoryInterface;
use App\Models\ProductPromotion;

class PromotionRepository implements PromotionRepositoryInterface
{
    protected $entity;

    public function __construct(ProductPromotion $promotion)
    {
        $this->entity = $promotion;
    }

    /**
     * Get all Promotions
     * @return array
     */
    public function getAllPromotions()
    {
        return $this->entity->all();
    }

    /**
     * Select Promotion by ID
     * @param int $id
     * @return object
     */
    public function getPromotionById($id)
    {
        return $this->entity->find($id);
    }

    /**
     * Create a new Promotion
     * @param array $data
     * @return object
     */
    public function createPromotion(array $data)
    {
        return $this->entity->create($data);
    }

     /**
     * Update data of Promotion
     * @param object $Promotion
     * @param array $data
     * @return object
     */
    public function updatePromotion(ProductPromotion $promotion, array $data)
    {
        return $promotion->update($data);
    }

    /**
     * Delete a Promotion
     * @param object $Promotion
     */
    public function destroyPromotion(ProductPromotion $promotion)
    {
        return $promotion->delete();
    }
}
