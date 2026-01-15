<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\PasswordEmailRequest;

class ForgotPasswordController extends Controller
{
   public function passwordReset()
   {
        $title = 'Esqueci minha senha';

        return view('forgot-password', compact('title'));
   }

   public function passwordEmail(PasswordEmailRequest $request)
   {
        $status = Password::broker('contacts')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::ResetLinkSent
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
   }
}
