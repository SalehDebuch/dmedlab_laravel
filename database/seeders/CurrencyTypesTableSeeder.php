<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencyTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencyTypes = [
            ['currency_name' => 'US Dollar', 'currency_type' => 'USD', 'currency_symbol' => '$'],
            ['currency_name' => 'Euro', 'currency_type' => 'EUR', 'currency_symbol' => '€'],
            ['currency_name' => 'Japanese Yen', 'currency_type' => 'JPY', 'currency_symbol' => '¥'],
            ['currency_name' => 'British Pound', 'currency_type' => 'GBP', 'currency_symbol' => '£'],
            ['currency_name' => 'Canadian Dollar', 'currency_type' => 'CAD', 'currency_symbol' => 'CA$'],
            ['currency_name' => 'Australian Dollar', 'currency_type' => 'AUD', 'currency_symbol' => 'A$'],
            ['currency_name' => 'Syrian Pound', 'currency_type' => 'SYP', 'currency_symbol' => 'SP'],
            ['currency_name' => 'UAE Dirham', 'currency_type' => 'AED', 'currency_symbol' => 'AED'],
            ['currency_name' => 'Libyan Dinar', 'currency_type' => 'LYD', 'currency_symbol' => 'LD'],
            ['currency_name' => 'Egyptian Pound', 'currency_type' => 'EGP', 'currency_symbol' => 'EGP'],
            // Add more currency types as needed
        ];
        
        // Insert the currency types into the database
        DB::table('currency_types')->insert($currencyTypes);
    }
}
