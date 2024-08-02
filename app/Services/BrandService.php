<?php

namespace App\Services;

use App\Repositories\Contracts\BrandRepositoryInterface;
use App\Services\StoreFileService;
use Illuminate\Support\Str;

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
    public function makeBrand(array $data, $file)
    {
        $data["status"] = isset($data["status"]) ? 'S' : 'N';
        $data["permalink"] = Str::kebab($data["name"]);

        $brand = $this->brandRepository->createBrand($data);

        $fileName = Str::kebab($brand->name)."-".date('dmYHis');

        if ($file) {
            $storeFileService = new StoreFileService(
                $file,
                "public/images/brands",
                $fileName
            );
            $pathFile = $storeFileService->upload();
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
    public function updateBrand(int $id, array $data, $file)
    {
   
        $brand = $this->brandRepository->getBrandById($id);

        if (!$brand) {
            return response()->json(['message' => 'Brand Not Found'], 404);
        }

        $data["status"] = isset($data["status"]) ? 'S' : 'N';        

        //To Do: Update image

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

        $this->brandRepository->destroyBrand($brand);

        return response()->json(['message' => 'Brand Deleted'], 200);
    }
}