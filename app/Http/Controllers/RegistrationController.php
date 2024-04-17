<?php

namespace App\Http\Controllers;

use App\Contracts\CreateAction;
use App\Contracts\FileHandlerInterface;
use App\Http\Requests\UserCreationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function __construct(
        private FileHandlerInterface $fileHandler,
        private CreateAction $createAction
    ) {
    }

    public function create(): View
    {
        return view('registration.register');
    }

    public function store(UserCreationRequest $request)
    {
        $this->createAction->create($request);

        return redirect(route('login.form'))->with('success', 'User registered successfully');
    }

    public function checkIfEmailExists(Request $request)
    {
        $email = $request->filled('email') ? $request->get('email') : '';
        $user = User::where('email', $email)->first();

        if ($user) {
            return response()->json(['exists' => true]);
        }

        return response()->json(['exists' => false]);
    }
}
