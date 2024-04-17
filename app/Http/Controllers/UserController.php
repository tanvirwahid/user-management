<?php

namespace App\Http\Controllers;

use App\Contracts\Factories\FilterFactoryInterface;
use App\Contracts\FileDownloaderInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct(private FileDownloaderInterface $fileDownloader)
    {
    }

    public function index(Request $request)
    {
        $search = $request->filled('search') ? $request->get('search') : '';

        return view('users.show')
            ->with([
                'users' => User::normalUser()->filter(
                    [
                        'name' => $search,
                        'address' => $search,
                        'phone' => $search,
                        'email' => $search,
                        'date_of_birth' => $search
                    ],
                )->paginate(10),
                'search' => $search
            ]);
    }

    public function downloadIdVerificationDocument(User $user)
    {
        return $this->fileDownloader->download(
            $user->id_verification_document_path,
            User::FILE_FOLDER    
        );
    }
}
