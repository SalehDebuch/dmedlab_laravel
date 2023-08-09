<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InputTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inputTypes = [
            ['name' => 'text'],
            ['name' => 'img'],
            ['name' => 'math'],
            ['name' => 'table'],
            ['name' => 'text_editor'],
        ];
        
        // Insert the currency types into the database
        DB::table('input_types')->insert($inputTypes);
    }
}
