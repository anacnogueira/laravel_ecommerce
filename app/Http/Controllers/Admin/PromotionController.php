<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PromotionService;
use App\Services\ProductService;
use App\Http\Requests\AdminStoreUpdatePromotionRequest;

class PromotionController extends Controller
{
    protected $promotionService;
    protected $productService;

    public function __construct(
        PromotionService $promotionService,
        ProductService $productService
        )
    {
        $this->promotionService = $promotionService;
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions = $this->promotionService->getAllPromotions();

        return view('admin.promotions.index', compact('promotions'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promotion = null;

        $products = $this->productService->getProductsToSelect();

        return view('admin.promotions.create', compact('promotion','products'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreUpdatePromotionRequest $request)
    {
        $data = $request->all();

        $shipping = $this->promotionService->makePromotion($data);

        return redirect()->route('admin.promotions.index');
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $promotion = $this->promotionService->getPromotionById($id);
        $promotion->status = $promotion->status === 'S' ? 'Ativo' : ' Inativo';
        $promotion->black_friday = $promotion->black_friday === 'S' ? 'Sim' : ' Não';

        return view('admin.promotions.show', compact('promotion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $promotion = $this->promotionService->getPromotionById($id);
        $promotion->product->selling_price = number_format($promotion->product->selling_price, 2, ",", ".");
        $promotion->price_promotion = number_format($promotion->price_promotion, 2, ",", ".");

        $products = $this->productService->getProductsToSelect();

        return view('admin.promotions.edit', compact('promotion','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminStoreUpdatePromotionRequest $request, $id)
    {
        $data = $request->all();

        $promotion = $this->promotionService->updatePromotion($id, $data);

        return redirect()->route('admin.promotions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promotion = $this->promotionService->destroyPromotion($id);

        return redirect()->route('admin.promotions.index');
    }
}
