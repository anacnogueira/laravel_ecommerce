<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ContactNewsletterService;
use App\Services\CustomerService;
use App\Http\Requests\Admin\StoreUpdateContactNewsletterRequest;

class ContactNewsletterController extends Controller
{
    protected $contactNewsletterService;
    protected $customerService;

    public function __construct(
        ContactNewsletterService $contactNewsletterService,
        CustomerService $customerService,
        )
    {
        $this->contactNewsletterService = $contactNewsletterService;
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsletters = $this->contactNewsletterService->getAllContactNewsletters();

        return view('admin.newsletters.index', compact('newsletters'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $newsletter = null;

        $customers = $this->customerService->getCustomersToSelect();

        return view('admin.newsletters.create', compact('newsletter','customers'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateContactNewsletterRequest $request)
    {
        $data = $request->all();

        $newsletter = $this->contactNewsletterService->makeContactNewsletter($data);

        return redirect()->route('admin.newsletters.index');
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $newsletter = $this->contactNewsletterService->getContactNewsletterById($id);

        return view('admin.newsletters.show', compact('newsletter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $newsletter = $this->contactNewsletterService->getContactNewsletterById($id);

        $customers = $this->customerService->getCustomersToSelect();

        return view('admin.newsletters.edit', compact('newsletter', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateContactNewsletterRequest $request, $id)
    {
        $data = $request->all();

        $newsletter = $this->contactNewsletterService->updateContactNewsletter($id, $data);

        return redirect()->route('admin.newsletters.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newsletter = $this->contactNewsletterService->destroyContactNewsletter($id);

        return redirect()->route('admin.newsletters.index');
    }
}
