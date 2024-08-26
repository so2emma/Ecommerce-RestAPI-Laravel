<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        $users = User::all();

        for($i = 0; $i < 2000; $i++){
            $user = $users->random();
            $product = $products->random();

            Review::factory()->create([
                "user_id" => $user->id,
                "product_id" => $product->id
            ]);
        }
    }
}
