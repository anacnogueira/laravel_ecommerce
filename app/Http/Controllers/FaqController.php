<?php

namespace App\Http\Controllers;

use App\Services\FaqService;

class FaqController extends Controller
{
    protected $brandService;

    public function __construct(FaqService $faqService)
    {
        $this->faqService = $faqService;
    }

    public function index()
    {
        $title = 'Perguntas Frequentes';
        $faqs = $this->faqService->getActiveFaqs();

        return view('faq.index', compact('faqs','title'));
    }
}
