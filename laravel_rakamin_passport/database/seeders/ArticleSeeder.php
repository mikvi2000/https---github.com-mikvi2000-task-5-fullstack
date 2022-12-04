<?php

namespace Database\Seeders;

use App\Models\Articles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Articles::truncate();
        $csvData = fopen(base_path('database/data/articles.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {
                Articles::create([
                    'id' => $data['0'],
                    'title' => $data['1'],
                    'content' => $data['2'],
                    'image' => $data['3'],
                    'user_id' => $data['4'],
                    'category_id' => $data['5'],
                ]);
            }
            $transRow = false;
        }
        fclose($csvData);
    }
}
