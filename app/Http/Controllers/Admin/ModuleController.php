<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ModuleService;
use App\Http\Requests\AdminStoreUpdateModuleRequest;

class ModuleController extends Controller
{
    protected $moduleService;

    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = $this->moduleService->getAllModules();

        return view('admin.modules.index', compact('modules'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $module = null;

        $select = new \stdClass();
        $select->id = null;
        $select->name = "Selecione";

        $modules = $this->moduleService->getAllModules();
        $modules = $modules->sortBy('name');
        $modules = $modules->prepend($select);
        
        return view('admin.modules.create', compact('module', 'modules'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreUpdateModuleRequest $request)
    {
        $data = $request->all();
        
        $module = $this->moduleService->makeModule($data);

        return redirect()->route('admin.modules.index');
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $module = $this->moduleService->getModuleById($id);
        
        return view('admin.modules.show', compact('module'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $module = $this->moduleService->getModuleById($id);
        
        return view('admin.modules.edit', compact('module'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminStoreUpdateModuleRequest $request, $id)
    {
        $data = $request->all();
 
        $module = $this->moduleService->updateModule($id, $data);

        return redirect()->route('admin.modules.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $module = $this->moduleService->destroyModule($id);

        return redirect()->route('admin.modules.index');
    }
}
