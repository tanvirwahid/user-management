<?php

namespace App\Models\Traits;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

trait UserScopeTrait
{
    public function scopeNormalUser(Builder $query)
    {
        return $query->whereHas('roles', function ($query) {
            $query->where('name', Role::ROLE_USER);
        });
    }

    public function scopeFilter(Builder $builder, array $parameters)
    {
        return $builder->where(function ($query) use ($parameters) {

            foreach ($parameters as $column => $value) {
                $columnToSearch = $column;

                if ($column == 'name') {
                    $columnToSearch = DB::raw("CONCAT(first_name, ' ', last_name)");
                }

                $query->orWhere($columnToSearch, 'like', '%'.$value.'%');
            }

        });
    }
}
