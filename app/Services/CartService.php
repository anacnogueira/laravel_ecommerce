<?php

namespace App\Services;

use App\Services\ProductService;

class CartService
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

     /**
     * Create a new comment
     * @param array $data
     * @return object
    */
    public function addToCart(array $data)
    {
        $product = $this->productService->getProductById($data["product_id"]);
        $cart = session('cart',[]);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else{
            $cart[$product->id] = [
                "name" => $product->name,
                'price' => $data["price"],
                'price_without_discount' =>  $data["price_without_discount"],
                'gift' => $data['gift'] ?? 0,
                "image" => $product->photos,
                "quantity" => $data["quantity"],
            ];
        }

        session(['cart' => $cart]);

       $cartProducts = collect(session('cart'));
       $cartTotal = 0;

       foreach ($cartProducts as $key  => $product) {

       }
    }

    public function getProductsFromCart()
    {
        $carts =  session('cart');
        if ($carts) {
            foreach ($carts as $key => $cart) {
                $product = $this->productService->getProductById($key);
                $carts[$key]['brand_name'] = $product->brand->name;
                $carts[$key]['weight'] = $product->gross_weight;
                $carts[$key]['stock'] = $product->current_stock;
            }

        }

        return $carts;
    }

    public function updateCart(array $data)
    {
        $cart = session('cart',[]);

        foreach ($data["quantity"] as $key => $quantity) {
            if (isset($cart[$key])) {
                $cart[$key]['quantity'] = $quantity;
                $cart[$key]['gift'] = isset($data['gift'][$key]) ? 1 : 0;
            }
        }

        session(['cart' => $cart]);
    }

    public function removeFromCart($id)
    {
        $cart = session('cart',[]);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
            return ['success' => true, 'message' => 'Produto removido do carrinho.'];
        }

        return ['success' => false, 'message' => 'Produto não encontrado no carrinho.'];
    }

}
