<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\RoutineService;
use App\Services\ModuleService;
use App\Http\Requests\AdminStoreUpdateRoutineRequest;

class RoutineController extends Controller
{
    protected $routineService;
    protected $moduleService;

    public function __construct(RoutineService $routineService, ModuleService $moduleService)
    {
        $this->routineService = $routineService;
        $this->moduleService = $moduleService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routines = $this->routineService->getAllRoutines();

        return view('admin.routines.index', compact('routines'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $routine = null;

        $modules = $this->getModules();
        
        return view('admin.routines.create', compact('routine', 'modules'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreUpdateRoutineRequest $request)
    {
        $data = $request->all();
        
        $routine = $this->routineService->makeRoutine($data);

        return redirect()->route('admin.routines.index');
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $routine = $this->routineService->getRoutineById($id);
        
        return view('admin.routines.show', compact('routine'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $routine = $this->routineService->getRoutineById($id);

        $modules = $this->getModules();
        
        return view('admin.routines.edit', compact('routine', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminStoreUpdateRoutineRequest $request, $id)
    {
        $data = $request->all();
 
        $routine = $this->routineService->updateRoutine($id, $data);

        return redirect()->route('admin.routines.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $routine = $this->routineService->destroyRoutine($id);

        return redirect()->route('admin.routines.index');
    }

    private function getModules()
    {
        $select = new \stdClass();
        $select->id = null;
        $select->name = "Selecione";

        return $this->moduleService->getAllModules()
            ->sortBy('name')
            ->prepend($select);
    }

}
