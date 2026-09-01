<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class HomeCategorySeeder extends Seeder
{
    public function run()
    {
        Category::where('section', 'home')->delete();

        $categories = [
            ['name' => 'Rome City Tours', 'image' => 'no.png', 'emoji' => '🏙️', 'subtitle' => '12 tours →', 'link' => '#tours', 'section' => 'home', 'description' => 'Explore the heart of Rome'],
            ['name' => 'Food & Wine Tours', 'image' => 'no.png', 'emoji' => '🍕', 'subtitle' => '6 tours →', 'link' => '#tours', 'section' => 'home', 'description' => 'Taste authentic Roman cuisine'],
            ['name' => 'Walking Tours', 'image' => 'no.png', 'emoji' => '🚶', 'subtitle' => '18 tours →', 'link' => '#tours', 'section' => 'home', 'description' => 'Walk through ancient streets'],
            ['name' => 'Private Tours', 'image' => 'no.png', 'emoji' => '🚗', 'subtitle' => '8 tours →', 'link' => '/services', 'section' => 'home', 'description' => 'Exclusive private experiences'],
            ['name' => 'Ancient Rome', 'image' => 'no.png', 'emoji' => '🏛️', 'subtitle' => '10 tours →', 'link' => '#tours', 'section' => 'home', 'description' => 'Discover ancient wonders'],
            ['name' => 'Night Tours', 'image' => 'no.png', 'emoji' => '🌙', 'subtitle' => '5 tours →', 'link' => '#tours', 'section' => 'home', 'description' => 'See Rome by night'],
            ['name' => 'Family Friendly', 'image' => 'no.png', 'emoji' => '👨‍👩‍👧', 'subtitle' => '9 tours →', 'link' => '#tours', 'section' => 'home', 'description' => 'Fun for the whole family'],
            ['name' => 'Vatican Tours', 'image' => 'no.png', 'emoji' => '⛪', 'subtitle' => '7 tours →', 'link' => '#tours', 'section' => 'home', 'description' => 'Explore the Vatican City'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}
