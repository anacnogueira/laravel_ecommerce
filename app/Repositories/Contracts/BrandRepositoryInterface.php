<?php

namespace App\Repositories\Contracts;

use App\Models\Brand;

interface BrandRepositoryInterface
{
    public function getAllBrands();
    public function getBrandById($id);
    public function createBrand(array $data);
    public function updateBrand(Brand $brand, array $data);
    public function destroyBrand(Brand $brand);
}