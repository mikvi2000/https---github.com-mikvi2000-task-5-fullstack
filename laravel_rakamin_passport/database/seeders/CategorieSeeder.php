<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categories::truncate();
        $csvData = fopen(base_path('database/data/categories.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {
                Categories::create([
                    'id' => $data['0'],
                    'name' => $data['1'],
                    'user_id' => $data['2'],
                ]);
            }
            $transRow = false;
        }
        fclose($csvData);
    }
}
