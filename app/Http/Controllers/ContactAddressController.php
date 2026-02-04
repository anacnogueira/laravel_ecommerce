<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\ContactAddressService;
use App\Services\CountryService;
use App\Services\StateService;
use App\Services\CityService;
use App\Http\Requests\StoreUpdateContactAddressRequest;

class ContactAddressController extends Controller
{
    protected $contactAddressService;
    protected $countryService;
    protected $stateService;
    protected $cityService;

     public function __construct(
        ContactAddressService $contactAddressService,
        CountryService $countryService,
        StateService $stateService,
        CityService $cityService
    )
    {
        $this->contactAddressService = $contactAddressService;
        $this->countryService = $countryService;
        $this->stateService = $stateService;
        $this->cityService = $cityService;
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
        $address = null;
        $countries = $this->countryService ->getCountriesToSelect();
        $states = $this->stateService ->getStatesToSelect();
        $cities = $this->cityService ->getCitiesToSelect();

        return view('addresses.create', compact('title', 'address', 'countries','states', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateContactAddressRequest $request)
    {
        $data = $request->all();
        $data["contact_id"] = Auth::id();

        $address = $this->contactAddressService->makeContactAddress($data);

        return redirect()->route('customers.addresses.index')->with('success', 'Endereço cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Editar Endereço";
        $contactId = Auth::id();
        $address = $this->contactAddressService->getContactAddressByIdAndContactId($id, $contactId);
        $countries = $this->countryService ->getCountriesToSelect();
        $states = $this->stateService ->getStatesToSelect();
        $cities = $this->cityService ->getCitiesToSelect();

        return view('addresses.edit', compact('title', 'address', 'countries','states', 'cities'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateContactAddressRequest $request, string $id)
    {
        $data = $request->all();
        $data["contact_id"] = Auth::id();

        $address = $this->contactAddressService->updateContactAddress($id, $data);

        return redirect()->route('customers.addresses.index')->with('success', 'Endereço alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contactId = Auth::id();
        $address = $this->contactAddressService->getContactAddressByIdAndContactId($id, $contactId);

        if ($address) {
            $this->contactAddressService->destroyContactAddress($id);
            return redirect()->route('customers.addresses.index')->with('success', 'Endereço excluído com sucesso!');
        }

        return redirect()->route('customers.addresses.index')->with('error', 'Não é possível excluir esse endereço');

    }
}
