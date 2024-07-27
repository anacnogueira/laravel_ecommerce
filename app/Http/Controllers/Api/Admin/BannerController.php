<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BannerService;
use App\Http\Requests\StoreUpdateBannerRequest;
use App\Http\Resources\BannerResource;

class BannerController extends Controller
{
    protected $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = $this->bannerService->getAllBanners();
        return BannerResource::collection($banners);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateBannerRequest $request)
    {
        $data = $request->all();
        
        $banner = $this->bannerService->makeBanner($data, $request->file("upload"));
        return new BannerResource($banner);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banner = $this->bannerService->getBannerById($id);
        return new BannerResource($banner);
    }

    
    public function update(StoreUpdateBannerRequest $request, $id)
    {
        $data = $request->all();
 
        $banner = $this->bannerService->updateBanner($id, $data, $request->file("upload"));
        return $banner;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = $this->bannerService->destroyBanner($id);
        return $banner;
    }
}
