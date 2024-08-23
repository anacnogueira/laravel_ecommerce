<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CityService;
use App\Services\StateService;
use App\Http\Requests\AdminStoreUpdateCityRequest;

class CityController extends Controller
{
    protected $cityService;

    public function __construct(CityService $cityService, StateService $stateService)
    {
        $this->cityService = $cityService;
        $this->stateService = $stateService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = $this->cityService->getAllCities();

        return view('admin.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $city = null;

        $select = new \stdClass();
        $select->id = null;
        $select->name = "Selecione o estado";

        $states = $this->stateService->getAllStates();
        $states = $countries->sortBy('name');
        $states = $countries->prepend($select);
        
        return view('admin.cities.create', compact('city', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreUpdateCityRequest $request)
    {
        $data = $request->all();
        
        $city = $this->cityService->makeCity($data);

        return redirect()->route('admin.cities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city = $this->cityService->getCityById($id);
        
        return view('admin.cities.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = $this->cityService->getCityById($id);

        $select = new \stdClass();
        $select->id = null;
        $select->name = "Selecione o estado";

        $states = $this->stateService->getAllStates();
        $states = $countries->sortBy('name');
        $states = $countries->prepend($select);
        
        return view('admin.cities.edit', compact('city','states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminStoreUpdateCityRequest $request, $id)
    {
        $data = $request->all();
 
        $city = $this->cityService->updateCity($id, $data);

        return redirect()->route('admin.citys.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = $this->cityService->destroyCity($id);

        return redirect()->route('admin.cities.index');
    }
}
