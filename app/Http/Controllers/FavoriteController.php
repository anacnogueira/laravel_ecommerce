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

    public function store(Request $request)
    {

        $data = $request->all();
        $data["type"] = "favorite";
        $data["contact_id"] = Auth::id();

        if ($data["status"] == "N") {
            $this->productContactService->destroyProductContact($data["contact_id"], $data["product_id"], $data["type"]);
        } else {
            $this->productContactService->makeProductContact($data);
        }

        return redirect($data['url']);

    }

}
