<?php

namespace App\Services;

use App\Repositories\Contracts\WebsiteSearchRepositoryInterface;


class WebsiteSearchService
{
    protected $websiteSearchRepository;

    public function __construct(WebsiteSearchRepositoryInterface $websiteSearchRepository)
    {
        $this->websiteSearchRepository = $websiteSearchRepository;
    }

    /**
     * Select all banners
     * @return array
    */
    public function getAllWebsiteSearches()
    {
        return $this->websiteSearchRepository->getAllWebsiteSearches();
    }
}