<?php

namespace App\Services;

use App\Repositories\Contracts\BannerRepositoryInterface;
use App\Services\StoreFileService;
use Illuminate\Support\Str;

class BannerService
{
    protected $banneryRepository;

    public function __construct(BannerRepositoryInterface $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    /**
     * Select all banners
     * @return array
    */
    public function getAllBanners()
    {
        return $this->bannerRepository->getAllBanners();
    }

     /**
     * Create a new banner
     * @param array $data
     * @return object 
    */
    public function makeBanner(array $data, $file)
    {
        $data["status"] = isset($data["status"]) ? 'S' : 'N';

        $banner = $this->bannerRepository->createBanner($data);

        $fileName = Str::kebab($banner->name)."-".date('dmYHis');


        $storeFileService = new StoreFileService(
            $file,
            "public/images/banners",
            $fileName
        );
        $pathFile = $storeFileService->upload();
        $banner->update([
            "image" => $pathFile,
        ]);

        return $banner;
    }

    /**
     * Get Banner by  ID
     * @param int $id
     * @return object
    */
    public function getBannerById(int $id)
    {
        return $this->bannerRepository->getBannerById($id);
    }

    /**
     * Update a banner
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updateBanner(int $id, array $data, $file)
    {
   
        $banner = $this->bannerRepository->getBannerById($id);

        if (!$banner) {
            return response()->json(['message' => 'Banner Not Found'], 404);
        }

        $data["status"] = isset($data["status"]) ? 'S' : 'N';

        

        //To Do: Update image

        $this->bannerRepository->updateBanner($banner, $data);
        return response()->json(['message' => 'Banner Updated'], 200);
    }

    /**
     * Delete a banner
     * @param int $id
     * @return json response
    */
    public function destroyBanner(int $id)
    {
        $banner = $this->bannerRepository->getBannerById($id);

        if (!$banner) {
            return response()->json(['message' => 'Banner Not Found'], 404);
        }

        $this->bannerRepository->destroyBanner($banner);

        return response()->json(['message' => 'Banner Deleted'], 200);
    }
}