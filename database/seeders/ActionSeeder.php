<?php

namespace Database\Seeders;

use App\Models\Action;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('actions')->truncate();
        $arr = ['view', 'create', 'update', 'delete', 'download'];

        foreach ($arr as $key => $value) {
            Action::create([
                'name' => $value
            ]);
        }
    }
}
