<?php

namespace App\Contracts;

use Symfony\Component\HttpFoundation\BinaryFileResponse;

interface FileDownloaderInterface
{
    public function download(string $fileName, string $location): BinaryFileResponse;
}
