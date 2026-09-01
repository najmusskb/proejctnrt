<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\About;

class AboutSeeder extends Seeder
{
    public function run()
    {
        $about = About::firstOrNew();

        $about->fill([
            'title'            => 'See Rome Through The Eyes Of A Local',
            'subtitle'         => 'Experience Rome',
            'description'      => 'Nice in Rome Tour is more than a booking service — we\'re a family of passionate Roman guides who have spent a decade uncovering the Eternal City\'s secrets. Every experience is hand-crafted, authentic and personal.',
            'mission'          => null,
            'image'            => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg',
            'image2'           => null,
            'checkmarks'       => [
                'Deep local knowledge of Rome',
                'Experienced, licensed guides',
                'Authentic, hand-crafted experiences',
                'Personalised, concierge service',
            ],
            'button_text'      => 'Discover Our Story →',
            'button_link'      => '#',
            'button2_text'     => 'Browse All Tours',
            'button2_link'     => '#tours',
            'counter1_number'  => '35K+',
            'counter1_label'   => 'Happy Travellers',
            'counter2_number'  => '4.8★',
            'counter2_label'   => 'Avg. Rating',
            'badge_number'     => '12',
            'badge_label'      => 'Years Exp.',
        ]);

        $about->save();
    }
}
