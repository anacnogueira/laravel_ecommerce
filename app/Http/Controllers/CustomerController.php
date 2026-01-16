<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CustomerService;
use App\Http\Requests\StoreCustomerRequest;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = null;
        $title = "Cadastre-se";

        return view('customers.create', compact('customer','title'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        $data = $request->all();

        $data["type_contact"] = "client";

        $customer = $this->customerService->makeCustomer($data);

        return redirect()->route('register.confirm-store');
    }

    public function confirm()
    {
        $title = "Confirmação de Cadastro";

        return view('customers.confirm-store', compact('title'));
    }

}
