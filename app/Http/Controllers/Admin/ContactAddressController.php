<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ContactAddressService;
use App\Services\CustomerService;
use App\Services\CountryService;
use App\Services\StateService;
use App\Services\CityService;
use App\Http\Requests\Admin\StoreUpdateContactAddressRequest;

class ContactAddressController extends Controller
{
    protected $contactAddressService;
    protected $customerService;
    protected $countryService;
    protected $stateService;
    protected $cityService;

    public function __construct(
        ContactAddressService $contactAddressService,
        CustomerService $customerService,
        CountryService $countryService,
        StateService $stateService,
        CityService $cityService
        )
    {
        $this->contactAddressService = $contactAddressService;
        $this->customerService = $customerService;
        $this->countryService = $countryService;
        $this->stateService = $stateService;
        $this->cityService = $cityService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($contactId)
    {
        $customer = $this->customerService->getCustomerById($contactId);

        $addresses = $this->contactAddressService->getAllContactAddressesByContactId($contactId);

        return view('admin.contact-addresses.index', compact('addresses','customer'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($contactId)
    {
        $address = null;

        $customer = $this->customerService->getCustomerById($contactId);

        $countries = $this->countryService->getCountriesToSelect();
        $states = $this->stateService->getStatesToSelect();
        $cities = null;

        return view('admin.contact-addresses.create', compact('address','customer', 'countries','states', 'cities'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateContactAddressRequest $request, $contactId)
    {
        $data = $request->all();

        $address = $this->contactAddressService->makeContactAddress($data);

        return redirect()->route('admin.addresses.index', $contactId);
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($contactId, $id)
    {
        $customer = $this->customerService->getCustomerById($contactId);
        $address = $this->contactAddressService->getContactAddressById($id);

        return view('admin.contact-addresses.show', compact('address','customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($contactId, $id)
    {
        $customer = $this->customerService->getCustomerById($contactId);
        $address = $this->contactAddressService->getContactAddressById($id);

        $countries = $this->countryService->getCountriesToSelect();
        $states = $this->stateService->getStatesToSelect();
        $cities = $this->cityService->getCitiesToSelect();

        return view('admin.contact-addresses.edit', compact('customer', 'address', 'countries', 'states', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateContactAddressRequest $request, $contactId, $id)
    {
        $data = $request->all();

        $address = $this->contactAddressService->updateContactAddress($id, $data);

        return redirect()->route('admin.addresses.index', $contactId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $contactId, $id)
    {
        $address = $this->contactAddressService->destroyContactAddress($id);

        return redirect()->route('admin.addresses.index', $contactId);
    }
}
