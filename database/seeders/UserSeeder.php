<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sourceFilePath = public_path('assets/pdfs/sample-pdf.pdf');
        $destinationFolderPath = storage_path('app/public/nid_documents');

        if (!File::exists($destinationFolderPath)) {
            File::makeDirectory($destinationFolderPath, 0755, true, true);
        }

        $fileName = pathinfo($sourceFilePath, PATHINFO_BASENAME);

        if (!File::exists($destinationFolderPath . '/' . $fileName)) 
        {
            File::copy($sourceFilePath, $destinationFolderPath . '/' . $fileName);
        }

        User::factory(50)->create([
            'id_verification_document_path' => 'sample-pdf.pdf',
        ]);

        $userRoleId = Role::where('name', Role::ROLE_USER)->first()->id;

        foreach(User::all() as $user)
        {
            if($user->email == config('admin-credentials.email'))
            {
                continue;
            }

            $user->roles()->attach($userRoleId);
        }
    }
}
