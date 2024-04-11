<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add 10 products
        Product::factory()->count(10)->create();

        // add random pictures of products
        foreach (Product::all() as $product) {
            $url = 'https://picsum.photos/200/300';
            $product->addMediaFromUrl($url)->toMediaCollection("image");
        }
    }
}
