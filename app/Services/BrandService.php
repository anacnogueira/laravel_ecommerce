<?php

namespace App\Services;

use App\Repositories\Contracts\BrandRepositoryInterface;
use Illuminate\Support\Str;
use App\Services\StoreFileService;
use App\Services\DeleteFileService;

class BrandService
{
    protected $brandRepository;

    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    /**
     * Select all brands
     * @return array
    */
    public function getAllBrands()
    {
        return $this->brandRepository->getAllBrands();
    }

    public function getActiveBrands()
    {
        return $this->brandRepository->getActiveBrands();
    }

    /**
     * Create a new brand
     * @param array $data
     * @return object
    */
    public function makeBrand(array $data)
    {
        $data["status"] = isset($data["status"]) ? 'S' : 'N';
        $data["permalink"] = Str::slug($data["name"]);
        $data["permalink_old"] = Str::slug($data["name"]);

        $brand = $this->brandRepository->createBrand($data);

        if (isset($data["upload"])) {
            $filename = Str::slug($brand->name)."-".date('dmYHis');
            $pathFile = $this->storeImage($data["upload"], $filename);

            $brand->update([
                "image" => $pathFile,
            ]);
        }

        return $brand;
    }

    /**
     * Get Brand by  ID
     * @param int $id
     * @return object
    */
    public function getBrandById(int $id)
    {
        return $this->brandRepository->getBrandById($id);
    }

    /**
     * Get Brand by  Permalink
     * @param string $permalink
     * @return object
    */
    public function getBrandByPermalink(string $permalink)
    {
        return $this->brandRepository->getBrandByPermalink($permalink);
    }

    /**
     * Update a Brand
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updateBrand(int $id, array $data)
    {
        $brand = $this->brandRepository->getBrandById($id);

        if (!$brand) {
            return response()->json(['message' => 'Brand Not Found'], 404);
        }

        $data["status"] = isset($data["status"]) ? 'S' : 'N';

        if (isset($data["upload"])) {
            $oldFile = $brand->image;
            $filename = Str::slug($data["name"])."-".date('dmYHis');
            $pathFile = $this->storeImage($data["upload"], $filename, $oldFile);

            $data["image"] = $pathFile;
        }

        $this->brandRepository->updateBrand($brand, $data);
        return response()->json(['message' => 'Brand Updated'], 200);
    }

    /**
     * Delete a brand
     * @param int $id
     * @return json response
    */
    public function destroyBrand(int $id)
    {
        $brand = $this->brandRepository->getBrandById($id);

        if (!$brand) {
            return response()->json(['message' => 'Brand Not Found'], 404);
        }

        if ($brand->image) {
            DeleteFileService::delete($brand->image);
        }

        $this->brandRepository->destroyBrand($brand);

        return response()->json(['message' => 'Brand Deleted'], 200);
    }

    private function storeImage($file, $filename, $oldFile = null)
    {
        if ($oldFile) {
            DeleteFileService::delete($oldFile);
        }

        $storeFileService = new StoreFileService(
            $file,
            env('FILE_DESTINATION_BRANDS'),
            $filename
        );
        $pathFile = $storeFileService->upload();

        return $pathFile;
    }
}
