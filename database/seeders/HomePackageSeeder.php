<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;

class HomePackageSeeder extends Seeder
{
    public function run()
    {
        Package::query()->truncate();

        $packages = [
            [
                'name' => 'Ancient Rome Package',
                'subtitle' => 'Colosseum, Roman Forum & Palatine Hill',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5b/Colosseum_of_Rome%2C_Italy.jpg/960px-Colosseum_of_Rome%2C_Italy.jpg',
                'badge_label' => 'Bestseller',
                'price' => 89,
                'highlights' => [],
                'is_active' => 1,
                'sort_order' => 1,
            ],
            [
                'name' => 'Vatican Highlights Package',
                'subtitle' => 'Museums, Sistine Chapel & St. Peter\'s',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f5/Basilica_di_San_Pietro_in_Vaticano_September_2015-1a.jpg/960px-Basilica_di_San_Pietro_in_Vaticano_September_2015-1a.jpg',
                'badge_label' => 'Popular',
                'price' => 109,
                'highlights' => [],
                'is_active' => 1,
                'sort_order' => 2,
            ],
            [
                'name' => 'Forum & Palatine Walk',
                'subtitle' => 'Guided walk through Ancient Rome\'s heart',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/aa/2002_Rome_Roman_Forum_%26_Palatine_01.jpg/960px-2002_Rome_Roman_Forum_%26_Palatine_01.jpg',
                'badge_label' => 'Small Group',
                'price' => 59,
                'highlights' => [],
                'is_active' => 1,
                'sort_order' => 3,
            ],
            [
                'name' => 'Rome at Twilight',
                'subtitle' => 'Pantheon, piazzas & glowing fountains',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/28/The_Pantheon_at_dusk.jpg/960px-The_Pantheon_at_dusk.jpg',
                'badge_label' => 'Romantic',
                'price' => 75,
                'highlights' => [],
                'is_active' => 1,
                'sort_order' => 4,
            ],
        ];

        foreach ($packages as $package) {
            Package::create($package);
        }
    }
}
