<?php

namespace App\Repositories\Contracts;

use App\Models\Coupon;

interface CouponRepositoryInterface
{
    public function getAllCoupons();
    public function getCouponById($id);
    public function createCoupon(array $data);
    public function updateCoupon(Coupon $coupon, array $data);
    public function destroyCoupon(Coupon $coupon);
}
