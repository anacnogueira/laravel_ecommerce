<?php

namespace App\Http\Controllers;

use App\Services\PageService;

class PagesController extends Controller
{
    protected $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function contact()
    {
        $title = 'Formulário de Contato';
        return view('maintenance', compact('title'));
    }

    public function sitemap()
    {
        $title = 'Mapa do Site';
        return view('maintenance', compact('title'));
    }

    public function show($permalink)
    {
        $page = $this->pageService->getPageByPermalink($permalink);
        $title = $page->title;
        return view('maintenance', compact('title'));
    }

}
