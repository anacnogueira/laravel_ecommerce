<?php

namespace App\Repositories\Contracts;

interface CepSearchRepositoryInterface
{
    public function getAllCepSearches();
    public function createCepReportSearch(array $data);
}
