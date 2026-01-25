<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CouponService;

class CouponController extends Controller
{
    protected $couponService;

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }

    public function generateCode()
    {
        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    	$code = "";
    	for ($i = 0; $i < 10; $i++) {
        	$code .= $chars[mt_rand(0, strlen($chars)-1)];
     	}

        return response()->json($code);
    }
}
