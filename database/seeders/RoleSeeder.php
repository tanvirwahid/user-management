<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{

    const ROLES = [
        Role::ROLE_ADMIN,
        Role::ROLE_USER
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::truncate();

        foreach(self::ROLES as $role)
        {
            Role::create([
                'name' => $role
            ]);
        }        
    }
}
