<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\Traits\VerificationCodeSenderTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    use VerificationCodeSenderTrait;

    public function showLoginPage()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $this->sendVerificationCode();

            return redirect(route('verify.index'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);

    }

    public function logoutAndRedirectToHome(Request $request)
    {
        $this->logout($request);

        return redirect('/');
    }

    public function logoutAndRedirectToRegister(Request $request)
    {
        $this->logout($request);

        return redirect(route('registration.form'));
    }

    private function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
