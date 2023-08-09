<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            [
                'name' => 'العربي',
                'code' => 'ar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'English',
                'code' => 'en',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'French',
                'code' => 'fr',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'German',
                'code' => 'de',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more languages as needed
        ]);
    }
}