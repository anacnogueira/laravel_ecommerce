<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContactAddressService;
use Illuminate\Support\Facades\Auth;

class ContactAddressController extends Controller
{
    protected $contactAddressService;

     public function __construct(ContactAddressService $contactAddressService)
    {
        $this->contactAddressService = $contactAddressService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $queryParams = [];
        $title = "Meus Endereços";

        $sort = $request->query('sort');
        $direction = $request->query('direction') ?? 'asc';

        $queryParams = [
            "paginate" => 10,
            "sort" => $sort,
            "direction" => $direction
        ];

        if ($request->query("cep")) {
            $queryParams['conditions'] = [
                ["column" => "cep", "operator" => "=", "value" => $request->query("cep")]
            ];
        }

        $contactId = Auth::id();
        $addresses = $this->contactAddressService->getAllContactAddressesByContactId($contactId, $queryParams);
        $direction = $direction == 'desc' ? 'asc' : 'desc';

        return view('addresses.index', compact('title', 'addresses', 'direction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Cadastrar Novo Endereço";
        return view('maintenance', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Editar Endereço";
        return view('maintenance', compact('title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $title = "Excluir Endereço";
        return view('maintenance', compact('title'));
    }
}
