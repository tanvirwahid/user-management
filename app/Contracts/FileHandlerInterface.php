<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface FileHandlerInterface
{
    public function getFileName(Request $request, string $fileColumn, string $location): string;
}
