<?php

namespace App\Services;

use App\Repositories\Contracts\CepSearchRepositoryInterface;


class CepSearchService
{
    protected $cepSearchRepository;

    public function __construct(CepSearchRepositoryInterface $cepSearchRepository)
    {
        $this->cepSearchRepository = $cepSearchRepository;
    }

    /**
     * Select all banners
     * @return array
    */
    public function getAllCepSearches()
    {
        return $this->cepSearchRepository->getAllCepSearches();
    }
}