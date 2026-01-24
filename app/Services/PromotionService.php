<?php

namespace App\Services;

use App\Repositories\Contracts\PromotionRepositoryInterface;

class PromotionService
{
    protected $promotionRepository;

    public function __construct(PromotionRepositoryInterface $promotionRepository)
    {
        $this->promotionRepository = $promotionRepository;
    }

     /**
     * Select all promotions
     * @return array
    */
    public function getAllPromotions()
    {
        return $this->promotionRepository->getAllPromotions();
    }

     /**
     * Create a new promotion
     * @param array $data
     * @return object
    */
    public function makePromotion(array $data)
    {
        $data["status"] = isset($data["status"]) ? 'S' : 'N';
        $data["black_friday"] = isset($data["black_friday"]) ? 'S' : 'N';

        $promotion = $this->promotionRepository->createPromotion($data);

        return $promotion;
    }

    /**
     * Get Shipping by  ID
     * @param int $id
     * @return object
    */
    public function getPromotionById(int $id)
    {
        return $this->promotionRepository->getPromotionById($id);
    }

    /**
     * Update a promotion
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updatePromotion(int $id, array $data)
    {
        $promotion = $this->promotionRepository->getPromotionById($id);

        if (!$promotion) {
            return response()->json(['message' => 'Promotion Not Found'], 404);
        }

        $data["status"] = isset($data["status"]) ? 'S' : 'N';
        $data["black_friday"] = isset($data["black_friday"]) ? 'S' : 'N';

        $this->promotionRepository->updatePromotion($promotion, $data);

        return response()->json(['message' => 'Promotion Updated'], 200);
    }

     /**
     * Delete a Promotion
     * @param int $id
     * @return json response
    */
    public function destroyPromotion(int $id)
    {
        $promotion = $this->promotionRepository->getPromotionById($id);

        if (!$promotion) {
            return response()->json(['message' => 'Promotion Not Found'], 404);
        }

        $this->promotionRepository->destroyPromotion($promotion);

        return response()->json(['message' => 'Promotion Deleted'], 200);
    }

}
