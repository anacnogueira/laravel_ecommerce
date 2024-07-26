<?php  

namespace App\Http\Controllers\Api;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;

class BannersController extends Controller
{
	protected $banner;

	public function __construct(Banner $banner)
	{
		$this->banner = $banner;
	}

	public function index(Request $request) 
	{

		$banners = BannerResource::collection(Banner::show());
		
		
		return $banners;		
	}
	
}