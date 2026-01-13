<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CustomerService;
use App\Http\Requests\AdminStoreUpdateCustomerRequest;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = $this->customerService->getAllCustomers();

        return view('admin.customers.index', compact('customers'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = null;

        return view('admin.customers.create', compact('customer'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreUpdateCustomerRequest $request)
    {
        $data = $request->all();
        $data["type_person"] = "pf";
        $data["type_contact"] = "client";

        $customer = $this->customerService->makeCustomer($data);

        return redirect()->route('admin.customers.index');
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = $this->customerService->getCustomerById($id);
        $customer->gender = $customer->gender == 'F' ? 'Feminino' : 'Masculino';
        $customer->newsletter = $customer->newsletter == 'S' ? 'Sim' : 'Não';

        return view('admin.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = $this->customerService->getCustomerById($id);

        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminStoreUpdateCustomerRequest $request, $id)
    {
        $data = $request->all();

        $customer = $this->customerService->updateCustomer($id, $data);

        return redirect()->route('admin.customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = $this->customerService->destroyCustomer($id);

        return redirect()->route('admin.customers.index');
    }
}
