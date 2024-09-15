<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Services\UserGroupService;
use App\Http\Requests\AdminStoreUpdateUserRequest;

class UserController extends Controller
{
    protected $userService;
    protected $userGroupService;

    public function __construct(UserService $userService, UserGroupService $userGroupService)
    {
        $this->userService = $userService;
        $this->userGroupService = $userGroupService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userService->getAllUsers();

        return view('admin.users.index', compact('users'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = null;

        $select = new \stdClass();
        $select->id = null;
        $select->name = "Selecione o grupo";

        $userGroups = $this->userGroupService->getAllUserGroups();
        $userGroups = $userGroups->sortBy('name');
        $userGroups = $userGroups->prepend($select);
        
        return view('admin.users.create', compact('user', 'userGroups'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreUpdateUserRequest $request)
    {
        $data = $request->all();
        
        $user = $this->userService->makeUser($data);

        return redirect()->route('admin.users.index');
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userService->getUserById($id);
        
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminStoreUpdateUserRequest $request, $id)
    {
        $data = $request->all();
 
        $user = $this->userService->updateUser($id, $data);

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->userService->destroyUser($id);

        return redirect()->route('admin.users.index');
    }
}
