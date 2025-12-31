<?php

namespace App\Repositories\Contracts;

use App\Models\ReportSearch;

interface ReportSearchRepositoryInterface
{
    public function createReportSearch(array $data);
}
