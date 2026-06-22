<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\EventService;
use App\Services\CountryService;
use App\Services\StateService;
use App\Services\CityService;
use App\Http\Requests\AdminStoreUpdateEventRequest;

class EventController extends Controller
{
    protected $eventService;
    protected $countryService;
    protected $stateService;
    protected $cityService;

    public function __construct(
        EventService $eventService,
        CountryService $countryService,
        StateService $stateService,
        CityService $cityService)
    {
        $this->eventService = $eventService;
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
        $events = $this->eventService->getAllEvents();

        return view('admin.events.index', compact('events'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event = null;

        $countries = $this->countryService->getCountriesToSelect();
        $states = $this->stateService->getStatesToSelect();
        $cities = null;

        return view('admin.events.create', compact('event','countries','states','cities'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreUpdateEventRequest $request)
    {
        $data = $request->all();

        $event = $this->eventService->makeEvent($data);

        return redirect()->route('admin.events.index');
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = $this->eventService->getEventById($id);
        $event->status = $event->status == 'S' ? 'Ativo' : 'Inativo';
        $event->show_map = $event->show_map == 'S' ? 'Sim' : 'Não';
        $event->show_link_map = $event->stshow_link_mapatus == 'S' ? 'Sim' : 'Não';

        return view('admin.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = $this->eventService->getEventById($id);

        $countries = $this->countryService->getCountriesToSelect();
        $states = $this->stateService->getStatesToSelect();
        $cities = null;

        return view('admin.events.edit', compact('event','countries','states','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminStoreUpdateEventRequest $request, $id)
    {
        $data = $request->all();

        $event = $this->eventService->updateEvent($id, $data);

        return redirect()->route('admin.events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = $this->eventService->destroyEvent($id);

        return redirect()->route('admin.events.index');
    }
}
