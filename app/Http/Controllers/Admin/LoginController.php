<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Hashing\CakeSHA1Hasher;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    use AuthenticatesUsers;


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Credenciais inválidas.'])->onlyInput('email');
        }

        if (Hash::check($credentials['password'], $user->password)) {

            // Login bem-sucedido com HASH NOVO (Bcrypt/Argon2)
            Auth::guard('admin')->login($user);

            if (Hash::needsRehash($user->password)) {
                $user->forceFill(['password' => Hash::make($credentials['password'])])->save();
            }

            return redirect()->intended(route('admin.dashboard'));
        }

        if ($user) {
            $cakeHasher = new CakeSHA1Hasher();

            if ($cakeHasher->check($request->input('password'), $user->password)) {

                $newPasswordHash = Hash::make($credentials['password']);

                $user->forceFill(['password' => $newPasswordHash])->save();

                Auth::guard('admin')->login($user);

                return redirect()->intended(route('admin.dashboard'));
            }
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin');
    }

}
