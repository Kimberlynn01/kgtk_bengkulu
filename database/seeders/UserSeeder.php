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
        User::truncate();

        $user = User::create([
            'name' => 'Super Admin',
            'username' => 'admin',
            'email' => 'administrator@app.com',
            'password' => Hash::make('oke')
        ]);

        $user->roles()->attach([1, 2]);

        $userType = [
            2 => 'User',
        ];

        foreach ($userType as $key => $newUser) {
            $roleId = $key;

            $user = User::create([
                'name' => $newUser,
                'username' => strtolower($newUser),
                'email' => strtolower($newUser) . '@app.com',
                'password' => Hash::make('eskelapa'),
            ]);

            $user->roles()->attach($roleId);
        }
    }
}
