<?php

namespace App\Contracts;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

interface FileHandlerInterface
{
    public function getFileName(Request $request, string $fileColumn, string $location): string;
}
