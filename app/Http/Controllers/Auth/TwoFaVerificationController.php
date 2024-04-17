<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\TwoFaVerificationRequest;
use App\Notifications\TwoFactorNotification;

class TwoFaVerificationController extends Controller
{
    public function index()
    {
        return view('auth.two-factor');
    }

    public function verify(TwoFaVerificationRequest $request)
    {
        $user = auth()->user();

        if ($request->input('code') == $user->two_factor_code) {
            $user->resetTwoFactorCode();

            return redirect()->route('login');
        }

        return redirect()->back()->withErrors(['code' => 'The two factor code you have entered does not match']);

    }

    public function resend()
    {
        auth()->user()->notify(new TwoFactorNotification());

        return redirect()->back();
    }
}
