<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        for($i = 0; $i<300; $i++){
            $category = $categories->random();
            Product::factory()->create([
                'category_id' => $category->id
            ]);
        }
    }
}
