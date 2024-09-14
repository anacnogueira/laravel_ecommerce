<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserGroupService;
use App\Http\Requests\AdminStoreUpdateUserGroupRequest;

class UserGroupController extends Controller
{
    protected $userGroupService;

    public function __construct(UserGroupService $userGroupService)
    {
        $this->userGroupService = $userGroupService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userGroups = $this->userGroupService->getAllUserGroups();

        return view('admin.user-groups.index', compact('userGroups'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userGroup = null;
        
        return view('admin.user-groups.create', compact('userGroup'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreUpdateUserGroupRequest $request)
    {
        $data = $request->all();
        
        $userGroup = $this->userGroupService->makeUserGroup($data);

        return redirect()->route('admin.user-groups.index');
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userGroup = $this->userGroupService->getUserGroupById($id);
        
        return view('admin.user-groups.show', compact('userGroup'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userGroup = $this->userGroupService->getUserGroupById($id);
        
        return view('admin.user-groups.edit', compact('userGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminStoreUpdateUserGroupRequest $request, $id)
    {
        $data = $request->all();
 
        $userGroup = $this->userGroupService->updateUserGroup($id, $data);

        return redirect()->route('admin.user-groups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userGroup = $this->userGroupService->destroyUserGroup($id);

        return redirect()->route('admin.user-groups.index');
    }
}
