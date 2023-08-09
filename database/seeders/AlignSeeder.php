<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aligns')->insert([
            [
                'alignment' => 'Right'
            ],
            [
                'alignment' => 'Left'
            ],
            [
                'alignment' => 'Center'
            ],
        ]);
    }
}
