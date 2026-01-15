<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Http\Requests\UpdatePasswordRequest;

class ResetPasswordController extends Controller
{
    public function resetPassword($token)
    {
        $title = "Resetar senha";
        return view('reset-password', compact('token', 'title'));
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $status = Password::broker('contacts')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (Contact $customer, string $password) {
                $customer->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $customer->save();

                event(new PasswordReset($customer));
            }
        );

        return $status === Password::PasswordReset
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
