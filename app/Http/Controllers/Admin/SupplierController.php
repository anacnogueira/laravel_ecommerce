<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SupplierService;
use App\Services\CountryService;
use App\Services\StateService;
use App\Services\CityService;
use App\Http\Requests\AdminStoreUpdateSupplierRequest;

class SupplierController extends Controller
{
    protected $supplierService, $countryService, $stateService, $cityService;

    public function __construct(
        SupplierService $supplierService,
        CountryService $countryService,
        StateService $stateService,
        CityService $cityService
    )
    {
        $this->supplierService = $supplierService;
        $this->countryService = $countryService;
        $this->stateService = $stateService;
        $this->cityService = $cityService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = $this->supplierService->getAllSuppliers();

        return view('admin.suppliers.index', compact('suppliers'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = null;

        $countries = $this->getCountries();
        $states = $this->getStates();
        $cities = $this->getCities();
        
        return view('admin.suppliers.create', compact('supplier','countries', 'states', 'cities'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreUpdateSupplierRequest $request)
    {
        $data = $request->all();
        
        $supplier = $this->supplierService->makeSupplier($data, $request->file("upload"));

        return redirect()->route('admin.suppliers.index');
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = $this->supplierService->getSupplierById($id);
        
        return view('admin.suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = $this->supplierService->getSupplierById($id);
        
        return view('admin.suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminStoreUpdateSupplierRequest $request, $id)
    {
        $data = $request->all();
 
        $supplier = $this->supplierService->updateSupplier($id, $data, $request->file("upload"));

        return redirect()->route('admin.suppliers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = $this->supplierService->destroySupplier($id);

        return redirect()->route('admin.suppliers.index');
    }

    private function getCountries()
    {
        $select = new \stdClass();
        $select->id = null;
        $select->name = "Selecione";

        return $this->countryService->getAllCountries()
            ->sortBy('name')
            ->prepend($select);
    }

    private function getStates()
    {
        $select = new \stdClass();
        $select->id = null;
        $select->name = "Selecione";

        return $this->stateService->getAllStates()
            ->sortBy('name')
            ->prepend($select);
    }

    private function getCities()
    {
        $select = new \stdClass();
        $select->id = null;
        $select->name = "Selecione";

        return $this->cityService->getAllCities()
            ->sortBy('name')
            ->prepend($select);
    }
}
