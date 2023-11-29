<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            ['name' => 'business'],
            ['name' => 'entertainment'],
            ['name' => 'general'],
            ['name' => 'health'],
            ['name' => 'science'],
            ['name' => 'technology'],
            ['name' => 'sports'],
            ['name' => 'arts'],
            ['name' => 'world'],
            // Add more categories as needed
        ];
        Category::insert($categories);

    }
}
curl \
  'https://api.nytimes.com/svc/mostpopular/v2/emailed/1.json?api-key=EZSu4o5OQIMeJZ2Zr1c0M1OkMcgxLni0' \
  --header 'Accept: application/json' \
  --compressed
