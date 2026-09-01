<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WhyChooseUs;

class HomeWhyChooseUsSeeder extends Seeder
{
    public function run()
    {
        WhyChooseUs::query()->truncate();

        $items = [
            ['title' => 'WhatsApp Instant Booking', 'icon' => '💬', 'description' => 'Book your tour in seconds — availability confirmed instantly, 24/7. Chat like a friend, not a customer.', 'status' => 1],
            ['title' => 'Skip the Line Access', 'icon' => '🏛️️', 'description' => 'Exclusive priority access to Rome\'s most visited monuments. No waiting, no stress — just pure history.', 'status' => 1],
            ['title' => '7 Languages Spoken', 'icon' => '🌐', 'description' => 'Our expert guides speak Italian, English, Spanish, French, Arabic and more for a truly personal experience.', 'status' => 1],
            ['title' => 'Free Cancellation', 'icon' => '✅', 'description' => 'Flexible booking with free cancellation on all tours. Book with confidence — plans change, we understand.', 'status' => 1],
            ['title' => '4.8★ Average Rating', 'icon' => '⭐', 'description' => 'Trusted by 35,000+ happy tourists worldwide. Our reputation is built on unforgettable experiences.', 'status' => 1],
            ['title' => 'Small Group Tours', 'icon' => '🎯', 'description' => 'Intimate small-group experiences that make you feel like a VIP, not just another tourist in the crowd.', 'status' => 1],
        ];

        foreach ($items as $item) {
            WhyChooseUs::create($item);
        }
    }
}
