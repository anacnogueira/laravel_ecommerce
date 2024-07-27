<?php

namespace App\Repositories;

use App\Repositories\Contracts\BannerRepositoryInterface;
use App\Models\Banner;

class BannerRepository implements BannerRepositoryInterface
{
    protected $entity;

    public function __construct(Banner $banner)
    {
        $this->entity = $banner;
    }

    /**
     * Get all Banners
     * @return array
     */
    public function getAllBanners()
    {
        return $this->entity->all();
    }

    /**
     * Get all Banners
     * @return array
     */
    public function getActiveBanners()
    {
        return $this->entity->show();
    }

    /**
     * Select Banner by ID
     * @param int $id
     * @return object
     */
    public function getBannerById($id)
    {
        return $this->entity->find($id);
    }

    /**
     * Create a new banner
     * @param array $data
     * @return object
     */
    public function createBanner(array $data)
    {
        return $this->entity->create($data);
    }

     /**
     * Update data of banner
     * @param object $banner
     * @param array $data
     * @return object
     */
    public function updateBanner(Banner $banner, array $data)
    {
        return $banner->update($data);
    }

    /**
     * Delete a banner
     * @param object $banner
     */
    public function destroyBanner(Banner $banner) 
    {
        return $banner->delete();
    }
}