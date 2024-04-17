<?php

namespace Database\Seeders;

use App\Exceptions\AdminSeederException;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();

        $adminEmail = config('admin-credentials.email');
        $adminPassword = config('admin-credentials.password');

        if(
            $adminEmail == null || 
            $adminPassword == null || 
            $adminEmail == "" || 
            $adminPassword == ""
        )
        {
            throw new AdminSeederException('Please, specify admin email and password in .env file. See readme for more info.');
        }

        $user = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Local',
            'email' => config('admin-credentials.email'),
            'phone' => '+8801478284721',
            'password' => Hash::make(config('admin-credentials.password')),
            'address' => 'admin address',
            'date_of_birth' => Carbon::parse('2000-01-01')
        ]);

        $user->roles()->attach(Role::where('name', Role::ROLE_ADMIN)->first()->id);
    }
}
