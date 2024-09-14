<?php

namespace App\Repositories;

use App\Repositories\Contracts\CepSearchRepositoryInterface;
use App\Models\Search;

class CepSearchRepository implements CepSearchRepositoryInterface
{
    protected $entity;

    public function __construct(Search $search)
    {
        $this->entity = $search;
    }

    /**
     * Get all Cep Searches
     * @return array
     */
    public function getAllCepSearches()
    {
        return $this->entity->cep()->get();
    }
}