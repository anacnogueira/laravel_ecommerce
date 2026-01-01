<?php

namespace App\Http\Controllers;

use App\Services\PageService;
use App\Services\ContactService;
use App\Http\Requests\SendContactRequest;
use App\Models\Category;
use App\Models\Brand;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\BrandResource;

class PagesController extends Controller
{
    protected $pageService;
    protected $contactService;

    public function __construct(PageService $pageService, ContactService $contactService)
    {
        $this->pageService = $pageService;
        $this->contactService = $contactService;
    }

    public function contact()
    {
        $title = 'Formulário de Contato';
        return view('pages.contact', compact('title'));
    }

    public function sendContact(SendContactRequest $request)
    {
        $data = $request->all();

        $this->contactService->sendEmail($data);

        return redirect()->route('pages.contact-sent');
    }

    public function contactSent()
    {
        $title = "Contato - Formulário enviado";
        return view('pages.contact-sent', compact('title'));
    }

    public function sitemap()
    {
        $title = 'Mapa do Site';
        $categories = CategoryResource::collection(Category::tree());
        $brands = BrandResource::collection(Brand::menu());
        $pages = $this->pageService->getActivePages();

        return view('pages.sitemap', compact('title','categories','brands', 'pages'));
    }

    public function show($permalink)
    {
        $page = $this->pageService->getPageByPermalink($permalink);
        $title = $page->title;
        return view('maintenance', compact('title'));
    }

}
