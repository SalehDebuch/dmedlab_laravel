<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Test;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tests = [
            [
                'name_ar' => 'اسم الاختبار بالعربية',
                'name_en' => 'Test Name in English',
                'name_fr' => 'Nom du test en français',
                'name_de' => 'Testname auf Deutsch',
            ],
            // Add more test data as needed
        ];

        foreach ($tests as $testData) {
            $test = new Test();
            $test->name_ar = $testData['name_ar'];
            $test->name_en = $testData['name_en'];
            $test->name_fr = $testData['name_fr'];
            $test->name_de = $testData['name_de'];

            // Generate the search value by concatenating all names
            $searchValue = implode(',', $testData);
            $test->search_keywords = $searchValue;

            $test->save();
        }
    }
}
