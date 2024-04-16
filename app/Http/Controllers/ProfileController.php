<?php

namespace App\Http\Controllers;

use App\Contracts\FileHandlerInterface;
use App\Models\User;

class ProfileController extends Controller
{
    public function __construct(private FileHandlerInterface $fileHandler)
    {
    }

    public function show()
    {   
        return view('profile.show')
            ->with([
                'profile' => auth()->user()
            ]);
    }

    public function downloadNidDocument()
    {
        return $this->fileHandler->download(
                auth()->user()->id_verification_document_path,
                User::FILE_FOLDER
        );
    }
}
