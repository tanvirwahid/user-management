<?php

namespace App\Services;

use App\Contracts\FileDownloaderInterface;
use App\Contracts\FileHandlerInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class IdVerificationFileHandlerService implements FileDownloaderInterface, FileHandlerInterface
{
    public function getFileName(Request $request, string $fileColumn, string $location): string
    {
        $file = $request->file($fileColumn);
        $fileName = time().'_'.$file->getClientOriginalName();
        $file->storeAs($location, $fileName);

        return $fileName;
    }

    public function download(string $fileName, string $location): BinaryFileResponse
    {
        $path = storage_path('app/'.$location.'/'.$fileName);

        return response()->download($path, $fileName);
    }
}
