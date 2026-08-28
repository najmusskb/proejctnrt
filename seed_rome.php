<?php

use Illuminate\Support\Facades\DB;
use App\Models\Destination;
use App\Models\Package;
use App\Models\Product;
use App\Models\Category;

// Include Laravel's autoloader and bootstrap
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

DB::statement('SET FOREIGN_KEY_CHECKS=0;');
Destination::truncate();
Package::truncate();
Product::truncate();
Category::truncate();
DB::statement('SET FOREIGN_KEY_CHECKS=1;');

Illuminate\Database\Eloquent\Model::unguard();

$cat = Category::create([
    'name' => 'Rome Tours',
    'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg'
]);

// 1. Destinations
$destinations = [
    [
        'name' => 'Colosseum',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg',
        'is_active' => 1,
        'sort_order' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Vatican City',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f5/Basilica_di_San_Pietro_in_Vaticano_September_2015-1a.jpg/960px-Basilica_di_San_Pietro_in_Vaticano_September_2015-1a.jpg',
        'is_active' => 1,
        'sort_order' => 2,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Pantheon',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7b/Pantheon_%28Rome%29_-_Right_side_and_front.jpg/960px-Pantheon_%28Rome%29_-_Right_side_and_front.jpg',
        'is_active' => 1,
        'sort_order' => 3,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Roman Forum',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6a/Foro_Romano_Musei_Capitolini_Roma.jpg/960px-Foro_Romano_Musei_Capitolini_Roma.jpg',
        'is_active' => 1,
        'sort_order' => 4,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Trevi Fountain',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c7/Trevi_Fountain_-_Roma.jpg/960px-Trevi_Fountain_-_Roma.jpg',
        'is_active' => 1,
        'sort_order' => 5,
        'created_at' => now(),
        'updated_at' => now(),
    ]
];
Destination::insert($destinations);

// 2. Tours (Products)
$tours = [
    [
        'category_id' => $cat->id,
        'name' => 'Colosseum Skip-the-Line',
        'slug' => 'colosseum-skip-the-line',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg',
        'price' => 29,
        'duration' => '2 hours',
        'group_size' => 'Small group',
        'badge_type' => 'bestseller',
        'rating' => 4.7,
        'reviews_count' => 320,
        'is_hot' => 1,
    ],
    [
        'category_id' => $cat->id,
        'name' => 'Vatican Museums & Sistine Chapel',
        'slug' => 'vatican-museums-sistine-chapel',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f5/Basilica_di_San_Pietro_in_Vaticano_September_2015-1a.jpg/960px-Basilica_di_San_Pietro_in_Vaticano_September_2015-1a.jpg',
        'price' => 45,
        'duration' => '3 hours',
        'group_size' => 'Small group',
        'badge_type' => 'bestseller',
        'rating' => 4.9,
        'reviews_count' => 512,
        'is_hot' => 1,
    ],
    [
        'category_id' => $cat->id,
        'name' => 'Pantheon Priority Access',
        'slug' => 'pantheon-priority-access',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7b/Pantheon_%28Rome%29_-_Right_side_and_front.jpg/960px-Pantheon_%28Rome%29_-_Right_side_and_front.jpg',
        'price' => 18,
        'old_price' => 22,
        'duration' => '1 hour',
        'group_size' => 'Small group',
        'badge_type' => 'popular',
        'rating' => 4.5,
        'reviews_count' => 421,
        'is_hot' => 1,
    ],
    [
        'category_id' => $cat->id,
        'name' => 'Roman Forum & Palatine Hill',
        'slug' => 'roman-forum-palatine-hill',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6a/Foro_Romano_Musei_Capitolini_Roma.jpg/960px-Foro_Romano_Musei_Capitolini_Roma.jpg',
        'price' => 25,
        'duration' => '2.5 hours',
        'group_size' => 'Small group',
        'badge_type' => 'new',
        'rating' => 4.8,
        'reviews_count' => 102,
        'is_hot' => 1,
    ],
    [
        'category_id' => $cat->id,
        'name' => 'Trevi Fountain Night Experience',
        'slug' => 'trevi-fountain-night-experience',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c7/Trevi_Fountain_-_Roma.jpg/960px-Trevi_Fountain_-_Roma.jpg',
        'price' => 45,
        'old_price' => 55,
        'duration' => '1.5 hours',
        'group_size' => 'Small group',
        'badge_type' => 'bestseller',
        'rating' => 4.8,
        'reviews_count' => 389,
        'is_hot' => 1,
    ],
    [
        'category_id' => $cat->id,
        'name' => 'Piazza Navona Evening Walk',
        'slug' => 'piazza-navona-evening-walk',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/08/Piazza_Navona_%28Rome%29_at_night.jpg/960px-Piazza_Navona_%28Rome%29_at_night.jpg',
        'price' => 25,
        'old_price' => 30,
        'duration' => '2 hours',
        'group_size' => 'Small group',
        'badge_type' => 'popular',
        'rating' => 4.6,
        'reviews_count' => 512,
        'is_hot' => 1,
    ]
];

foreach ($tours as $t) {
    Product::create($t);
}

// 3. Packages
$packages = [
    [
        'name' => 'Ancient Rome Full Day',
        'subtitle' => 'Colosseum, Roman Forum & Palatine Hill',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg',
        'highlights' => json_encode(['Colosseum', 'Roman Forum', 'Palatine Hill', 'Skip-the-line']),
        'price' => 89,
        'badge_label' => 'FULL DAY',
        'badge_icon' => '🏛️ Ancient Rome',
        'is_active' => 1,
        'sort_order' => 1,
    ],
    [
        'name' => 'Vatican Complete Experience',
        'subtitle' => "Museums, Sistine Chapel & St. Peter's",
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f5/Basilica_di_San_Pietro_in_Vaticano_September_2015-1a.jpg/960px-Basilica_di_San_Pietro_in_Vaticano_September_2015-1a.jpg',
        'highlights' => json_encode(['Vatican Museums', 'Sistine Chapel', "St. Peter's", 'Expert guide']),
        'price' => 75,
        'badge_label' => 'HALF DAY',
        'badge_icon' => '⛪ Vatican City',
        'is_active' => 1,
        'sort_order' => 2,
    ],
    [
        'name' => 'Rome by Night Walking Tour',
        'subtitle' => 'Magical Rome after dark',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c7/Trevi_Fountain_-_Roma.jpg/960px-Trevi_Fountain_-_Roma.jpg',
        'highlights' => json_encode(['Trevi Fountain', 'Pantheon', 'Piazza Navona', 'Gelato stop']),
        'price' => 45,
        'badge_label' => 'EVENING',
        'badge_icon' => '🌙 Night Tour',
        'is_active' => 1,
        'sort_order' => 3,
    ],
    [
        'name' => 'Hidden Gems of Rome',
        'subtitle' => 'Off-the-beaten-path secrets',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/62/Palatine_Hill_from_across_the_Circus_Maximus_April_2019.jpg/960px-Palatine_Hill_from_across_the_Circus_Maximus_April_2019.jpg',
        'highlights' => json_encode(['Aventine Hill', 'Keyhole View', 'Orange Garden', 'Local stories']),
        'price' => 39,
        'badge_label' => '3 HOURS',
        'badge_icon' => '🔍 Hidden Gems',
        'is_active' => 1,
        'sort_order' => 4,
    ],
    [
        'name' => 'Trastevere Food & Culture',
        'subtitle' => 'Taste authentic Roman life',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/08/Piazza_Navona_%28Rome%29_at_night.jpg/960px-Piazza_Navona_%28Rome%29_at_night.jpg',
        'highlights' => json_encode(['Trastevere', 'Wine tasting', 'Street food', 'Gelato']),
        'price' => 65,
        'badge_label' => '4 HOURS',
        'badge_icon' => '🍕 Food Tour',
        'is_active' => 1,
        'sort_order' => 5,
    ],
    [
        'name' => 'Spanish Steps & Borghese',
        'subtitle' => 'Elegance, art & panoramic views',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b8/Piazza_di_Spagna_%28Rome%29_0004.jpg/960px-Piazza_di_Spagna_%28Rome%29_0004.jpg',
        'highlights' => json_encode(['Spanish Steps', 'Borghese Gallery', 'Via Veneto', 'Bernini sculptures']),
        'price' => 59,
        'badge_label' => 'HALF DAY',
        'badge_icon' => '🎨 Art & Culture',
        'is_active' => 1,
        'sort_order' => 6,
    ],
];
Package::insert($packages);

echo "Seed complete!\n";
