<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplyCouponRequest;
use App\Services\CouponService;

class CouponController extends Controller
{

    protected $couponService;

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }

    public function apply(ApplyCouponRequest $request)
    {
        $code = $request->input("code");
        $subtotal = $request->input('subtotal');

        $coupon = $this->couponService->isCouponValid($code);

        if ($coupon) {
            $discountAmount = $coupon->discount_type == 'fixed' ?
                $coupon->discount_amount :
                $subtotal * ($coupon->discount_amount/100);

            //Gravar dados do cupom em sessão
            session(['coupon' => [
                'code' => $code,
                'discount_amount' => $discountAmount
            ]]);
        }



        return response()->json(['discount' => $discountAmount]);
    }
}
