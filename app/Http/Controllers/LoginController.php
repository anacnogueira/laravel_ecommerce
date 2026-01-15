<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Services\CustomerService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Hashing\CakeSHA1Hasher;

class LoginController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function login()
    {
        $title = 'Login';
        return view('login', compact('title'));
    }

    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $customer = $this->customerService->getCustomerByEmail($credentials['email']);

        $errorMessage = "Credenciais inválidas.";

        if (!$customer) {
            return back()->withErrors(['email' => $errorMessage])->onlyInput('email');
        }

        if (Hash::check($credentials['password'], $customer->password)) {
            Auth::login($customer);

            if (Hash::needsRehash($customer->password)) {
                $customer->forceFill(['password' => Hash::make($credentials['password'])])->save();
            }

            return redirect()->intended('/');
        }

        if ($customer) {
            $cakeHasher = new CakeSHA1Hasher();

            if ($cakeHasher->check($credentials['password'], $customer->password)) {

                $newPasswordHash = Hash::make($credentials['password']);

                $customer->forceFill(['password' => $newPasswordHash])->save();

                Auth::login($customer);

                $request->session()->regenerate();

                return redirect()->intended('/');

            }
        }

        return back()->withErrors(['email' => $errorMessage])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
