<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface Filterable
{
    public function scopeFilter(Builder $query, array $parameters);
}
