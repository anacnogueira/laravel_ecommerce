<?php

namespace App\Repositories;

use App\Repositories\Contracts\WebsiteSearchRepositoryInterface;
use App\Models\Search;

class WebsiteSearchRepository implements WebsiteSearchRepositoryInterface
{
    protected $entity;

    public function __construct(Search $search)
    {
        $this->entity = $search;
    }

    /**
     * Get all Website Searches
     * @return array
     */
    public function getAllWebsiteSearches()
    {
        return $this->entity->search()->get();
    }
}