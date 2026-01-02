<?php

namespace App\Repositories;

use App\Repositories\Contracts\FaqRepositoryInterface;
use App\Models\Faq;

class FaqRepository implements FaqRepositoryInterface
{
    protected $entity;

    public function __construct(Faq $faq)
    {
        $this->entity = $faq;
    }

    /**
     * Get Active Faqs
     * @return array
     */
    public function getActiveFaqs()
    {
        return $this->entity->active();
    }
}
