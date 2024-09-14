<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CepSearchService;

class CepSearchController extends Controller
{
    protected $cepSearchService;

    public function __construct(CepSearchService $cepSearchService)
    {
        $this->cepSearchService = $cepSearchService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cepSearches = $this->cepSearchService->getAllCepSearches();

        return view('admin.cep-searches.index', compact('cepSearches'));
    }
}
