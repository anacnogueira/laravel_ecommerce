<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateEmailCustomerRequest;
use App\Http\Requests\UpdatePasswordCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Requests\VerifyRegisterRequest;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index()
    {
        $title = "Minha Conta";

        return view('customers.index', compact('title'));
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

    /**
     * Verify if a register already exists.
     *
     * @param  \Illuminate\Http\VerifyRegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function verify(VerifyRegisterRequest $request)
    {
        return redirect()->route('register')->with('email', $request->input("email_reg"));
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

    public function editPassword()
    {
        $title = "Alterar Senha";

        return view("customers.edit-password", compact("title"));
    }

    public function updatePassword(UpdatePasswordCustomerRequest $request)
    {
        $data = $request->all();
        $id = Auth::id();

        $customer = $this->customerService->updateCustomer($id, $data);

        return redirect()->back()->with('success', 'Senha atualizada com sucesso!');
    }

    public function edit()
    {
        $title = 'Alterar Dados Cadastrais';
        $id = Auth::id();
        $customer = $this->customerService->getCustomerById($id);

        return view("customers.edit", compact("title","customer"));
    }

    public function update(UpdateCustomerRequest $request)
    {
        $data = $request->all();
        $id = Auth::id();

        $customer = $this->customerService->updateCustomer($id, $data);

        return redirect()->back()->with('success', 'Dados atualizados com sucesso!');
    }

    public function editEmailNewsletter()
    {
        $title = 'E-mail de ofertas';
        $id = Auth::id();
        $customer = $this->customerService->getCustomerById($id);

        return view("customers.edit-email-newsletter", compact("title","customer"));
    }

    public function updateEmailNewsletter(Request $request)
    {
        $data = $request->all();
        $data["newsletter"] = isset($data["newsletter"]) ? 'S' : 'N';

        $id = Auth::id();

        $customer = $this->customerService->updateCustomer($id, $data);

        return redirect()->back()->with('success', 'E-mail de ofertas atualizado com sucesso!');
    }

}
