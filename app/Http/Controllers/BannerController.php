<?php

namespace App\Http\Controllers;


use App\Services\BannerService;
use App\Http\Resources\BannerResource;

class BannerController extends Controller
{
    protected $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    public function index()
    {
        //Banner::show()
        
        $banners = BannerResource::collection($this->bannerService->getActiveBanners());

        return view('banners.index', compact('banners'));
    }

}
