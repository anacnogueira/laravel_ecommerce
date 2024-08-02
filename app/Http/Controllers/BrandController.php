<?php

namespace App\Http\Controllers;


use App\Services\BrandService;
use App\Http\Resources\BrandResource;

class BrandController extends Controller
{
    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
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

        //To do: Get Products By Brand

        return view('brands.show', compact('title', 'description'));
    }

}
