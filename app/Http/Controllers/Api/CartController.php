<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use App\Http\Requests\ApiStoreCartRequest;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function showCart()
    {
        $cart = $this->cartService->getProductsFromCart();
        $renderHTML = view('carts.mini-bag-render', compact("cart"))->render();
        return response()->json(['renderHTML'=>$renderHTML]);
    }


    public function store(ApiStoreCartRequest $request)
    {
        $data = $request->all();
        $response = $this->cartService->addToCart($data);
        return response()->json($response, 201);
    }

    public function destroy($id)
    {
        $response = $this->cartService->removeFromCart($id);
        return response()->json($response);
    }
}
