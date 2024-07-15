<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Http\Resources\BannerResource;

class BannerController extends Controller
{
    protected $banner;

    public function __construct(Banner $banner)
    {
        $this->banner = $banner;
    }

    public function index(Request $request)
    {
        $banners = BannerResource::collection(Banner::show());

        return view('banners.index', compact('banners'));
    }

}
