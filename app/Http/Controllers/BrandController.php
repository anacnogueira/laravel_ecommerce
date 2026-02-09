<?php

namespace App\Http\Controllers;

use App\Services\BrandService;
use App\Http\Resources\BrandResource;

use App\Services\ProductService;
use App\Http\Resources\ProductResource;

class BrandController extends Controller
{
    protected $brandService;
    protected $productService;

    public function __construct(BrandService $brandService, ProductService $productService)
    {
        $this->brandService = $brandService;
        $this->productService = $productService;
    }

    public function index()
    {
        $title = 'Marcas';
        $brands = BrandResource::collection($this->brandService->getActiveBrands());

        return view('brands.index', compact('brands','title'));
    }

    public function show($permalink)
    {
        $brand = $this->brandService->getBrandByPermalink($permalink);
        $title = $brand->name;
        $description = $brand->text;

        $products = ProductResource::collection($this->productService->getProductsByBrandId($brand->id));

        foreach ($products as $i => $product) {
            $products[$i]->promotion = count($product->promotions) > 0 ?
                $product->promotions[0]->getPromotion($product) :
                null;

            $products[$i]->categories = $product->category->ancestors($product->category_id);
        }

        return view('brands.show', compact('title', 'description','products'));
    }
}
