<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\WebsiteSearchService;

class WebsiteSearchController extends Controller
{
    protected $websiteSearchService;

    public function __construct(WebsiteSearchService $websiteSearchService)
    {
        $this->websiteSearchService = $websiteSearchService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $webSearches = $this->websiteSearchService->getAllWebsiteSearches();

        return view('admin.website-searches.index', compact('webSearches'));
    }
}
