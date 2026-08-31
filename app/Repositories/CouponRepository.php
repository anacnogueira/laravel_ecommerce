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
     * Get a valid Coupon
     * @param int $id
     * @return object
     */
    public function isCouponValid($code)
    {
        $now = now();

        return $this->entity
            ->where('code', $code)
            ->where('status', 'S')
            ->where(function ($query) use ($now) {
            $query->whereNull('from_date')
                ->orWhere('from_date', '<=', $now);
            })
            ->where(function ($query) use ($now) {
                $query->whereNull('to_date')
                    ->orWhere('to_date', '>=', $now);
            })
            ->first();
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
     * Add log from a coupn
     * @param array $data
     * @return object
     */
    public function addLog($coupon, $data)
    {
        return $coupon->histories()->create($data);
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
