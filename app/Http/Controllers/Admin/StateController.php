<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\StateService;
use App\Services\CountryService;
use App\Http\Requests\AdminStoreUpdateStateRequest;

class StateController extends Controller
{
    protected $stateService;

    public function __construct(StateService $stateService, CountryService $countryService)
    {
        $this->stateService = $stateService;
        $this->countryService = $countryService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = $this->stateService->getAllStates();

        return view('admin.states.index', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $state = null;

        $select = new \stdClass();
        $select->id = null;
        $select->name = "Selecione o país";

        $countries = $this->countryService->getAllCountries();
        $countries = $countries->sortBy('name');
        $countries = $countries->prepend($select);
        
        return view('admin.states.create', compact('state', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreUpdateStateRequest $request)
    {
        $data = $request->all();
        
        $state = $this->stateService->makeState($data);

        return redirect()->route('admin.states.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $state = $this->stateService->getStateById($id);
        
        return view('admin.states.show', compact('state'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $state = $this->stateService->getStateById($id);
        
        return view('admin.states.edit', compact('state'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminStoreUpdateStateRequest $request, $id)
    {
        $data = $request->all();
 
        $banner = $this->stateService->updateState($id, $data);

        return redirect()->route('admin.states.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state = $this->stateService->destroyState($id);

        return redirect()->route('admin.states.index');
    }
}
