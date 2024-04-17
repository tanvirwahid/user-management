<?php

namespace App\Actions;

use App\Contracts\CreateAction;
use App\Contracts\FileHandlerInterface;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserCreationAction implements CreateAction
{
    public function __construct(private FileHandlerInterface $fileHandler)
    {
    }

    public function create(Request $request): Model
    {
        $fileName = $this->fileHandler->getFileName(
            $request,
            'id_file',
            User::FILE_FOLDER
        );

        $userRole = Role::where('name', Role::ROLE_USER)
            ->first();

        return DB::transaction(function () use ($request, $userRole, $fileName) {

            $user = User::create([
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'password' => Hash::make($request->get('password')),
                'address' => $request->get('address'),
                'id_verification_document_path' => $fileName,
                'date_of_birth' => $request->get('date_of_birth'),
            ]);

            $user->roles()->attach($userRole->id);

            return $user;
        });

    }
}
