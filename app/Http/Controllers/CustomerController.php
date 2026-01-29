<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CustomerService;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateEmailCustomerRequest;
use Illuminate\Support\Facades\Auth;

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
     * @param  \Illuminate\Http\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        $data = $request->all();

        $data["type_contact"] = "client";

        $customer = $this->customerService->makeCustomer($data, "site");

        return redirect()->route('register.confirm-store');
    }

    public function confirm()
    {
        $title = "Confirmação de Cadastro";

        return view('customers.confirm-store', compact('title'));
    }

    public function editEmail()
    {
        $title = 'Alterar E-mail';
        $id = Auth::id();
        $customer = $this->customerService->getCustomerById($id);

        return view("customers.edit-email", compact("title","customer"));

    }

    public function updateEmail(UpdateEmailCustomerRequest $request)
    {
        $data = $request->all();
        $id = Auth::id();

        $customer = $this->customerService->updateCustomer($id, $data);

        return redirect()->back()->with('success', 'E-mail atualizado com sucesso!');
    }

}
