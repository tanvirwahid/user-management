<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    public function index()
    {
        return view('auth.password-reset');
    }

    public function update(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        $authenticatedUser = auth()->user();

        if (! Hash::check($request->get('old_password'), $authenticatedUser->password)) {
            return back()->with('error', 'Incorrect old password');
        }

        $user = User::find($authenticatedUser->id);
        $user->password = Hash::make($request->get('new_password'));
        $user->save();

        return back()->with('success', 'Successfully updated password');
    }
}
