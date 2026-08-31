<?php

namespace App\Services;

use App\Repositories\Contracts\CouponRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CouponService
{
    protected $couponRepository;

    public function __construct(CouponRepositoryInterface $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

     /**
     * Select all coupons
     * @return array
    */
    public function getAllCoupons()
    {
        return $this->couponRepository->getAllCoupons();
    }

     /**
     * Create a new coupon
     * @param array $data
     * @return object
    */
    public function makeCoupon(array $data)
    {
        $data["status"] = isset($data["status"]) ? 'S' : 'N';
        $data["customer_login"] = isset($data["customer_login"]) ? 'S' : 'N';
        $data["free_shipping"] = isset($data["free_shipping"]) ? 'S' : 'N';

        $coupon = $this->couponRepository->createCoupon($data);

        return $coupon;
    }

    /**
     * Add log of a coupon
     * @param array $data
     * @return object
    */
    public function addLog($orderId)
    {
        $coupon = $this->isCouponValid(session('coupon.code'));

        $data = [
            'order_id' => $orderId,
            'contact_id' => Auth::id(),
            'ip' => ''
        ];

        return $this->couponRepository->addLog($coupon, $data);
    }

    /**
     * Get a valid coupon
     * @param int $id
     * @return object
    */
    public function isCouponValid(string $code)
    {
        return $this->couponRepository->isCouponValid($code);
    }

    /**
     * Get Coupon by ID
     * @param int $id
     * @return object
    */
    public function getCouponById(int $id)
    {
        return $this->couponRepository->getCouponById($id);
    }

    /**
     * Update a coupon
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updateCoupon(int $id, array $data)
    {
        $coupon = $this->couponRepository->getCouponById($id);

        if (!$coupon) {
            return response()->json(['message' => 'Coupon Not Found'], 404);
        }

        $data["status"] = isset($data["status"]) ? 'S' : 'N';
        $data["customer_login"] = isset($data["customer_login"]) ? 'S' : 'N';
        $data["free_shipping"] = isset($data["free_shipping"]) ? 'S' : 'N';

        $this->couponRepository->updateCoupon($coupon, $data);

        return response()->json(['message' => 'Coupon Updated'], 200);
    }

     /**
     * Delete a coupon
     * @param int $id
     * @return json response
    */
    public function destroyCoupon(int $id)
    {
        $coupon = $this->couponRepository->getCouponById($id);

        if (!$coupon) {
            return response()->json(['message' => 'Coupon Not Found'], 404);
        }

        $this->couponRepository->destroyCoupon($coupon);

        return response()->json(['message' => 'Coupon Deleted'], 200);
    }

}
