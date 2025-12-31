<?php

namespace App\Services;

use App\Repositories\Contracts\ReportSearchRepositoryInterface;
use Illuminate\Support\Facades\Mail;
use App\Mail\SearchDone;

class ReportSearchService
{
    protected $reportSearchRepository;

    public function __construct(ReportSearchRepositoryInterface $reportSearchRepository)
    {
        $this->reportSearchRepository = $reportSearchRepository;
    }

    /**
     * Create a new Search
     * @param array $data
     * @return object
    */
    public function makeReportSearch(array $data)
    {
        // Grava Busca no banco
        $search = $this->reportSearchRepository->createReportSearch($data);

       // Envia por e-mail
       Mail::to(env("SITE_EMAIL_DEV"))
        ->send(new SearchDone($search));

        return $search;
    }
}
