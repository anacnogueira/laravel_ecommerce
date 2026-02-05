<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ProductContactService;

class FavoriteController extends Controller
{
    protected $productContactService;

    public function __construct(ProductContactService $productContactService)
    {
        $this->productContactService = $productContactService;
    }

    public function index()
    {
        $title = "Meus Produtos Favoritos";
        $customerId = Auth::id();

        $products = $this->productContactService->getFavoriteProductsByCustomerId($customerId);

        foreach ($products as $i => $product) {
             $products[$i]->categories = $product->category->ancestors($product->category_id);
        }

        return view('favorites.index', compact('title', 'products'));
    }

}
