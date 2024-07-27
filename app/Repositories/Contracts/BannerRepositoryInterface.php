<?php

namespace App\Repositories\Contracts;

use App\Models\Banner;

interface BannerRepositoryInterface
{
    public function getAllBanners();
    public function getBannerById($id);
    public function createBanner(array $data);
    public function updateBanner(Banner $banner, array $data);
    public function destroyBanner(Banner $banner);
}