<?php

namespace Database\Seeders;

use App\Models\User;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();

        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'administrator@app.com',
            'password' => Hash::make('eskelapa')
        ]);

        $user->roles()->attach([1, 2, 3, 4, 5, 6]);

        $userType = [
            2 => 'GTK',
            3 => 'Dinas',
            4 => 'BGP',
            5 => 'LPTK',
            6 => 'Guru'
        ];

        foreach ($userType as $key => $newUser) {
            $roleId = $key;

            $user = User::create([
                'name' => $newUser,
                'email' => strtolower($newUser) . '@app.com',
                'password' => Hash::make('eskelapa'),
            ]);

            $user->roles()->attach($roleId);
        }
    }
}
