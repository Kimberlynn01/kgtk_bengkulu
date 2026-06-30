<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Super Admin',
                'email' => 'administrator@app.com',
                'password' => Hash::make('oke'),
            ]
        );

        $user->roles()->syncWithoutDetaching([1, 2,3]);

        $userType = [
            2 => 'User',
            3 => 'PIC',
            
        ];

        foreach ($userType as $key => $newUser) {
            $roleId = $key;

            $user = User::updateOrCreate(
                ['username' => strtolower($newUser)],
                [
                    'name' => $newUser,
                    'email' => strtolower($newUser) . '@app.com',
                    'password' => Hash::make('oke'),
                ]
            );

            $user->roles()->syncWithoutDetaching([$roleId]);
        }
    }
}
