<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PartnerService;
use App\Services\CountryService;
use App\Services\StateService;
use App\Services\CityService;
use App\Http\Requests\AdminStoreUpdatePartnerRequest;

class PartnerController extends Controller
{
    protected $partnerService, $countryService, $stateService, $cityService;

    public function __construct(
        PartnerService $partnerService,
        CountryService $countryService,
        StateService $stateService,
        CityService $cityService
    )
    {
        $this->partnerService = $partnerService;
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
        $partners = $this->partnerService->getAllPartners();

        return view('admin.partners.index', compact('partners'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partner = null;

        $countries = $this->getCountries();
        $states = $this->getStates();
        $cities = $this->getCities();

        return view('admin.partners.create', compact('partner','countries', 'states', 'cities'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreUpdatePartnerRequest $request)
    {
        $data = $request->all();
        $partner = $this->partnerService->makePartner($data);

        return redirect()->route('admin.partners.index');
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $partner = $this->partnerService->getPartnerById($id);

        return view('admin.partners.show', compact('partner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $partner = $this->partnerService->getPartnerById($id);

        $countries = $this->getCountries();
        $states = $this->getStates();
        $cities = $this->getCities();

        return view('admin.partners.edit', compact('partner', 'countries', 'states', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminStoreUpdatePartnerRequest $request, $id)
    {
        $data = $request->all();

        $partner = $this->partnerService->updatePartner($id, $data);

        return redirect()->route('admin.partners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $partner = $this->partnerService->destroyPartner($id);

        return redirect()->route('admin.partners.index');
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
