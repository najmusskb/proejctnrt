<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Deal;

class DealSeeder extends Seeder
{
    public function run()
    {
        Deal::query()->truncate();

        Deal::create([
            'badge'           => '🎉 Limited Time Offer',
            'title'           => 'Explore Rome & Save 15%',
            'description'     => 'Book any featured tour before the end of the month and unlock an exclusive discount on your entire booking — seamless, secure and instantly confirmed.',
            'code'            => 'ROME15',
            'discount_label'  => 'Save 15%',
            'url'             => 'book.niceinrometour.com/rome15',
            'status'          => 1,
        ]);
    }
}
