<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BrandService;
use App\Http\Requests\StoreUpdateBrandRequest;
use App\Http\Resources\BrandResource;

class BrandController extends Controller
{
    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = $this->brandService->getAllBrands();
        return BrandResource::collection($brands);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateBrandRequest $request)
    {
        $data = $request->all();
        
        $brand = $this->brandService->makeBrand($data, $request->file("upload"));
        return new BrandResource($brand);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = $this->brandService->getBrandById($id);

        if (!$brand) {
            return response()->json(['message' => 'Brand Not Found'], 404);
        }
        return new BrandResource($brand);
    }

    
    public function update(StoreUpdateBrandRequest $request, $id)
    {
        $data = $request->all();
 
        $brand = $this->brandService->updateBrand($id, $data, $request->file("upload"));
        return $brand;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = $this->brandService->destroyBrand($id);
        return $brand;
    }
}
