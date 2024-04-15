<?php

namespace App\Services;

use App\Contracts\FileHandlerInterface;
use Illuminate\Http\Request;

class IdVerificationFileHandlerService implements FileHandlerInterface
{
    public function getFileName(Request $request, string $fileColumn, string $location): string
    {
        $file = $request->file($fileColumn);
        $fileName = time().'_'.$file->getClientOriginalName();
        $file->storeAs($location, $fileName);

        return $fileName;
    }
}
