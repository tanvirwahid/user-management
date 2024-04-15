<?php

namespace App\Http\Controllers;

use App\Contracts\FileHandlerInterface;
use App\Http\Requests\UserCreationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function __construct(private FileHandlerInterface $fileHandler)
    {
    }

    public function create(): View
    {
        return view('registration.register');
    }

    public function store(UserCreationRequest $request)
    {

        $fileName = $this->fileHandler->getFileName(
            $request,
            'id_file',
            User::FILE_FOLDER
        );

        User::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'password' => Hash::make($request->get('password')),
            'address' => $request->get('address'),
            'id_verification_document_path' => $fileName,
            'date_of_birth' => $request->get('date_of_birth'),
        ]);

        return redirect(route('login.form', ['success' => 'User registered successfully.']));
    }

    public function checkIfEmailExists(Request $request)
    {
        $email = $request->filled('email') ? $request->get('email') : '';
        $user = User::where('email', $email)->first();

        if ($user) {
            return response()->json(['exists' => true]);
        } else {
            return response()->json(['exists' => false]);
        }

    }
}
