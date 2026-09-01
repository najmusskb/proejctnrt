<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;

class HomeBlogSeeder extends Seeder
{
    public function run()
    {
        Blog::query()->truncate();

        $blogs = [
            [
                'title'            => "The Colosseum's Secret Underground — What Most Tourists Miss",
                'slug'             => 'colosseum-secret-underground',
                'author'           => 'Mr. J',
                'image'            => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/66/Colosseum_Arena_%285986632567%29.jpg/960px-Colosseum_Arena_%285986632567%29.jpg',
                'short_description' => 'Discover the hypogeum, the labyrinthine underground network where gladiators and wild animals once waited...',
                'description'      => 'Discover the hypogeum, the labyrinthine underground network where gladiators and wild animals once waited before being lifted into the arena. A fascinating hidden world beneath the iconic Colosseum.',
                'status'           => 1,
            ],
            [
                'title'            => "Vatican Museums: The Complete Visitor's Guide for 2026",
                'slug'             => 'vatican-museums-complete-guide',
                'author'           => 'Mr. J',
                'image'            => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e8/Vatican_Museums_Spiral_Staircase_Looking_Up_2012.jpg/960px-Vatican_Museums_Spiral_Staircase_Looking_Up_2012.jpg',
                'short_description' => 'Everything you need to know about visiting the Vatican — best times, what to skip, and the must-sees...',
                'description'      => 'Everything you need to know about visiting the Vatican — best times, what to skip, and the must-sees. Plan your perfect visit with our expert tips.',
                'status'           => 1,
            ],
            [
                'title'            => 'Best Time to Visit Trevi Fountain Without the Crowds',
                'slug'             => 'best-time-trevi-fountain',
                'author'           => 'Mr. J',
                'image'            => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c7/Trevi_Fountain_-_Roma.jpg/960px-Trevi_Fountain_-_Roma.jpg',
                'short_description' => 'The Trevi Fountain is magical — but when is the best time to visit and actually enjoy it in peace?...',
                'description'      => 'The Trevi Fountain is magical — but when is the best time to visit and actually enjoy it in peace? Our insider tips reveal the quietest hours.',
                'status'           => 1,
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::create($blog);
        }
    }
}
