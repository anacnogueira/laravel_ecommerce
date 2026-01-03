<?php

namespace App\Services;

use App\Repositories\Contracts\BannerRepositoryInterface;
use App\Services\StoreFileService;
use Illuminate\Support\Str;

class BannerService
{
    protected $bannerRepository;

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

    public function getActiveBanners()
    {
        return $this->bannerRepository->getActiveBanners();
    }

     /**
     * Create a new banner
     * @param array $data
     * @return object
    */
    public function makeBanner(array $data)
    {
        $data["status"] = isset($data["status"]) ? 'S' : 'N';

        $banner = $this->bannerRepository->createBanner($data);

        $fileName = Str::slug($banner->name)."-".date('dmYHis');

        if (isset($data["upload"])) {
            $filename = Str::slug($data["name"])."-".date('dmYHis');
            $pathFile = $this->storeImage($data["upload"], $filename);

            $banner->update([
                "image" => $pathFile,
            ]);
        }

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
    public function updateBanner(int $id, array $data)
    {
        $banner = $this->bannerRepository->getBannerById($id);

        if (!$banner) {
            return response()->json(['message' => 'Banner Not Found'], 404);
        }

        $data["status"] = isset($data["status"]) ? 'S' : 'N';

        if ( $data["upload"]) {
            $oldFile = $banner->image;
            $filename = Str::slug($data["name"])."-".date('dmYHis');
            $pathFile = $this->storeImage($data["upload"], $filename, $oldFile);

            $data["image"] = $pathFile;
        }

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

        if ($banner->image) {
            DeleteFileService::delete($banner->image);
        }

        $this->bannerRepository->destroyBanner($banner);

        return response()->json(['message' => 'Banner Deleted'], 200);
    }

    private function storeImage($file, $filename, $oldFile = null)
    {
        if ($oldFile) {
            DeleteFileService::delete($oldFile);
        }

        $storeFileService = new StoreFileService(
            $file,
            env('FILE_DESTINATION_BANNERS'),
            $filename
        );
        $pathFile = $storeFileService->upload();

        return $pathFile;
    }
}
