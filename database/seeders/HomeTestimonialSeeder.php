<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class HomeTestimonialSeeder extends Seeder
{
    public function run()
    {
        Testimonial::query()->truncate();

        $reviews = [
            ['name' => 'Emily & Luke', 'designation' => 'Verified Travellers, UK', 'review' => "The Colosseum tour with skip-the-line access was flawless. Mr. J's team made everything effortless — we booked on WhatsApp in under a minute!", 'rating' => 5, 'status' => 1],
            ['name' => 'Marco & Camila', 'designation' => 'Verified Travellers, Spain', 'review' => 'Vatican Museums at opening was magical. Our guide spoke perfect English and Spanish for my parents. Worth every euro — book it!', 'rating' => 5, 'status' => 1],
            ['name' => 'Sarah Green', 'designation' => 'Verified Traveller, USA', 'review' => 'Free cancellation saved my trip when my flight changed. The team rearranged everything instantly via WhatsApp. Truly premium service.', 'rating' => 5, 'status' => 1],
            ['name' => 'Priya & Daniel', 'designation' => 'Verified Travellers, India / Canada', 'review' => 'The golf cart tour was the highlight of our honeymoon! Covered more of Rome in one evening than days of walking. So romantic at sunset.', 'rating' => 5, 'status' => 1],
            ['name' => 'Hiro & Keiko', 'designation' => 'Verified Travellers, Japan', 'review' => 'Luggage storage + airport transfer package was genius. We landed, dropped bags, toured the Pantheon, and reached our hotel stress-free.', 'rating' => 5, 'status' => 1],
            ['name' => 'Aisha B.', 'designation' => 'Verified Traveller, Australia', 'review' => 'As a solo traveller I felt completely safe and looked after. The small group size meant the guide could tailor everything to us. 10/10.', 'rating' => 5, 'status' => 1],
        ];

        foreach ($reviews as $review) {
            Testimonial::create($review);
        }
    }
}
