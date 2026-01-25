<?php

namespace App\Repositories;

use App\Repositories\Contracts\CouponRepositoryInterface;
use App\Models\Coupon;

class CouponRepository implements CouponRepositoryInterface
{
    protected $entity;

    public function __construct(Coupon $coupon)
    {
        $this->entity = $coupon;
    }

    /**
     * Get all Cupons
     * @return array
     */
    public function getAllCoupons()
    {
        return $this->entity->all();
    }

    /**
     * Select Coupon by ID
     * @param int $id
     * @return object
     */
    public function getCouponById($id)
    {
        return $this->entity->find($id);
    }

    /**
     * Create a new Coupon
     * @param array $data
     * @return object
     */
    public function createCoupon(array $data)
    {
        return $this->entity->create($data);
    }

     /**
     * Update data of coupon
     * @param object $coupon
     * @param array $data
     * @return object
     */
    public function updateCoupon(Coupon $coupon, array $data)
    {
        return $coupon->update($data);
    }

    /**
     * Delete a coupon
     * @param object $coupon
     */
    public function destroyCoupon(Coupon $coupon)
    {
        return $coupon->delete();
    }
}
