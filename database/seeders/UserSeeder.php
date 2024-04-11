<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add 4 users and 8 products, eachuser chooses 2 products
        User::factory()->count(4)
        ->hasAttached(Product::factory()->count(2), [] ,'products')
        ->create();

           // to add random pictures of users
           foreach (User::all() as $user) {
            $url = 'https://picsum.photos/200';
            $user->addMediaFromUrl($url)->toMediaCollection("avatar");
        }
    }
}
