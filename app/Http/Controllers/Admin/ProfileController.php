<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Http\Requests\AdminUpdateProfileRequest;

class ProfileController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = auth()->user();
        //dd($user);

        return view('admin.profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUpdateProfileRequest $request)
    {
        $data = $request->all();

        $user = auth()->user();

        $userUpdated = $this->userService->updateUser($user->id, $data);

        if ($userUpdated->statusText() === 'OK') {
            return redirect()->back()->with('success', 'Perfil atualizado com sucesso!');
        }
    }

}
