<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CouponService;
use App\Http\Requests\AdminStoreUpdateCouponRequest;

class CouponController extends Controller
{
    protected $couponService;

    protected $types = [
    	'percent' =>'Porcentagem',
    	'fixed' => 'Valor fixo',
  	];

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = $this->couponService->getAllCoupons();

        return view('admin.coupons.index', compact('coupons'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $coupon = null;
        $types = $this->types;

        return view('admin.coupons.create', compact('coupon','types'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreUpdateCouponRequest $request)
    {
        $data = $request->all();

        $coupon = $this->couponService->makeCoupon($data);

        return redirect()->route('admin.coupons.index');
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coupon = $this->couponService->getCouponById($id);
        $coupon->status = $coupon->status === 'S' ? 'Ativo' : ' Inativo';
        $coupon->customer_login = $coupon->customer_login === 'S' ? 'Sim' : ' Não';
        $coupon->free_shipping = $coupon->free_shipping === 'S' ? 'Sim' : ' Não';
        $coupon->discount_type = $this->types[$coupon->discount_type];

        return view('admin.coupons.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = $this->couponService->getCouponById($id);
        $types = $this->types;

        return view('admin.coupons.edit', compact('coupon','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminStoreUpdateCouponRequest $request, $id)
    {
        $data = $request->all();

        $coupon = $this->couponService->updateCoupon($id, $data);

        return redirect()->route('admin.coupons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = $this->couponService->destroyCoupon($id);

        return redirect()->route('admin.coupons.index');
    }
}
