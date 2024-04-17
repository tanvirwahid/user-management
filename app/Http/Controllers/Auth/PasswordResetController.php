<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    public function index()
    {
        return view('auth.password-reset');
    }

    public function update(PasswordUpdateRequest $request)
    {
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
