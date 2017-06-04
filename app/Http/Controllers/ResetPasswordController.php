<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
//Auth Facade
use Illuminate\Support\Facades\Auth;
//Password Broker Facade
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    // redirect path
    protected $redirectTo = '/';

    //trait for handling reset Password
    use ResetsPasswords;

    //Show form to users where they can save new password
    public function showResetForm(Request $request, $token = null)
    {
        return view('user.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    //returns Password broker of users
    public function broker()
    {
        return Password::broker('users');
    }

    //returns authentication guard of users
    protected function guard()
    {
        return Auth::guard('web');
    }
}
