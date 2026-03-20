<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function show()
    {
        $title = "Minha Sacola";
        $carts = $this->cartService->getProductsFromCart();
        $length = 0;
        $height = 0;
        $width = 0;
        $coupon = (object)[];

        if ($carts) {
            $collection = collect($carts);
            $length = $collection->max("length");
            $height = $collection->max("height");
            $width = $collection->max("width");
        }

        //To Do: Counpon
        $coupon->code   = "ABC123";
        $coupon->amount = 1.00;

        return view('carts.show', compact('title', 'carts', 'length', 'height', 'width', 'coupon'));
    }

    public function update(Request $request)
    {
        $this->cartService->updateCart($request->all());
        return redirect()->route('cart.show');
    }

    public function destroy($id)
    {
        $this->cartService->removeFromCart($id);
        return redirect()->route('cart.show');
    }
}
