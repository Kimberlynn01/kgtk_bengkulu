<?php

namespace Database\Seeders;

use App\Models\MenuGroup;
use Illuminate\Database\Seeder;

class PpidMenuGroupSeeder extends Seeder
{
    public function run(): void
    {
        MenuGroup::firstOrCreate(['name' => 'PPID']);
    }
}