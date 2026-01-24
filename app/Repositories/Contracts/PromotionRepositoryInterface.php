<?php

namespace App\Repositories\Contracts;

use App\Models\ProductPromotion;

interface PromotionRepositoryInterface
{
    public function getAllPromotions();
    public function getPromotionById($id);
    public function createPromotion(array $data);
    public function updatePromotion(ProductPromotion $promotion, array $data);
    public function destroyPromotion(ProductPromotion $promotion);
}
