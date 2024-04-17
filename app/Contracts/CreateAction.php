<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface CreateAction
{
    public function create(Request $request): Model;
}
