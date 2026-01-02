<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ContactNewsletterService;
use App\Services\MailchimpService;
use App\Http\Requests\ApiStoreContactNewsletterRequest;

class ContactNewsletterController extends Controller
{
    protected $contactNewsletterService;

    public function __construct(ContactNewsletterService $contactNewsletterService)
    {
        $this->contactNewsletterService = $contactNewsletterService;
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApiStoreContactNewsletterRequest $request)
    {
        $data = $request->all();

        $newsletter = $this->contactNewsletterService->makeContactNewsletter($data);

        return response()->json(['E-mail cadastrado com sucesso!'], 201);

    }
}
