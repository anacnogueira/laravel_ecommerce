<?php

namespace App\Repositories;

use App\Repositories\Contracts\BrandRepositoryInterface;
use App\Models\Brand;

class BrandRepository implements BrandRepositoryInterface
{
    protected $entity;

    public function __construct(Brand $brand)
    {
        $this->entity = $brand;
    }

    /**
     * Get all Brands
     * @return array
     */
    public function getAllBrands()
    {
        return $this->entity->all();
    }

    /**
     * Get all Brands
     * @return array
     */
    public function getActiveBrands()
    {
        return $this->entity->activeBrands();
    }

    /**
     * Select Brand by ID
     * @param int $id
     * @return object
     */
    public function getBrandById($id)
    {
        return $this->entity->find($id);
    }

     /**
     * Select Brand by Permalink
     * @param string $permalink
     * @return object
     */
    public function getBrandByPermalink($permalink)
    {
        return $this->entity->where('permalink', $permalink)->first();
    }

    /**
     * Create a new brand
     * @param array $data
     * @return object
     */
    public function createBrand(array $data)
    {
        return $this->entity->create($data);
    }

     /**
     * Update data of brand
     * @param object $brand
     * @param array $data
     * @return object
     */
    public function updateBrand(Brand $brand, array $data)
    {
        return $brand->update($data);
    }

    /**
     * Delete a brand
     * @param object $brand
     */
    public function destroyBrand(Brand $brand) 
    {
        return $brand->delete();
    }
}