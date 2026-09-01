<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stat;

class StatSeeder extends Seeder
{
    public function run()
    {
        Stat::query()->truncate();

        $stats = [
            ['number' => '35,000+', 'label' => 'TOURISTS SERVED', 'sort_order' => 1],
            ['number' => null, 'label' => 'MOST VISITED MONUMENTS', 'sort_order' => 2],
            ['number' => null, 'label' => 'WHATSAPP INSTANT BOOKING', 'sort_order' => 3],
            ['number' => '7', 'label' => 'LANGUAGES SPOKEN', 'sort_order' => 4],
            ['number' => '4.8★', 'label' => 'AVERAGE RATING', 'sort_order' => 5],
            ['number' => '50+', 'label' => 'CURATED TOURS', 'sort_order' => 6],
            ['number' => null, 'label' => 'FREE CANCELLATION', 'sort_order' => 7],
            ['number' => '24/7', 'label' => 'SUPPORT', 'sort_order' => 8],
        ];

        foreach ($stats as $stat) {
            Stat::create($stat);
        }
    }
}
