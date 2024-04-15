<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\TwoFactorNotification;
use Illuminate\Http\Request;

class TwofaVerificationController extends Controller
{
    public function index()
    {
        return view('auth.two-factor');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);

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
