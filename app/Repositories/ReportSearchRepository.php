<?php

namespace App\Repositories;

use App\Repositories\Contracts\ReportSearchRepositoryInterface;
use App\Models\ReportSearch;

class ReportSearchRepository implements ReportSearchRepositoryInterface
{
    protected $entity;

    public function __construct(ReportSearch $reportSearch)
    {
        $this->entity = $reportSearch;
    }

    /**
     * Create a new Report Search
     * @param array $data
     * @return object
     */
    public function createReportSearch(array $data)
    {
        return $this->entity->create($data);
    }
}
