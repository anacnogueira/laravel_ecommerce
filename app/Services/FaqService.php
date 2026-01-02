<?php

namespace App\Services;

use App\Repositories\Contracts\FaqRepositoryInterface;

class FaqService
{
    protected $faqRepository;

    public function __construct(FaqRepositoryInterface $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    public function getActiveFaqs()
    {
        return $this->faqRepository->getActiveFaqs()->paginate(5);
    }

}
