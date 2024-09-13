<?php

namespace App\Repositories\Contracts;

use App\Models\Faq;

interface FaqRepositoryInterface
{
    public function getAllFaqs();
    public function getFaqById($id);
    public function createFaq(array $data);
    public function updateFaq(Faq $faq, array $data);
    public function destroyFaq(Faq $faq);
}