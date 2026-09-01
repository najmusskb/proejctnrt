<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;

class HomeGallerySeeder extends Seeder
{
    public function run()
    {
        Gallery::query()->where('section', 'home')->orWhereNull('section')->delete();

        $shots = [
            [
                'title'    => 'Colosseum',
                'image'    => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg',
                'section'  => 'home',
                'likes'    => 1472,
                'comments' => 218,
                'span'     => 'lg:col-span-2 lg:row-span-2',
            ],
            [
                'title'    => "St. Peter's Basilica",
                'image'    => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f5/Basilica_di_San_Pietro_in_Vaticano_September_2015-1a.jpg/960px-Basilica_di_San_Pietro_in_Vaticano_September_2015-1a.jpg',
                'section'  => 'home',
                'likes'    => 2034,
                'comments' => 322,
                'span'     => 'md:col-span-2 lg:col-span-2',
            ],
            [
                'title'    => 'Vatican Museums',
                'image'    => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f0/VaticanMuseumStaircase.jpg/960px-VaticanMuseumStaircase.jpg',
                'section'  => 'home',
                'likes'    => 921,
                'comments' => 187,
                'span'     => null,
            ],
            [
                'title'    => 'Trevi Fountain',
                'image'    => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c4/Fontana_di_Trevi_by_TC.jpg/960px-Fontana_di_Trevi_by_TC.jpg',
                'section'  => 'home',
                'likes'    => 1108,
                'comments' => 241,
                'span'     => null,
            ],
            [
                'title'    => 'Roman Forum',
                'image'    => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6a/Foro_Romano_Musei_Capitolini_Roma.jpg/960px-Foro_Romano_Musei_Capitolini_Roma.jpg',
                'section'  => 'home',
                'likes'    => 763,
                'comments' => 129,
                'span'     => null,
            ],
            [
                'title'    => 'Galleria Borghese',
                'image'    => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5d/Galleria_borghese_facade.jpg/960px-Galleria_borghese_facade.jpg',
                'section'  => 'home',
                'likes'    => 583,
                'comments' => 96,
                'span'     => null,
            ],
            [
                'title'    => 'Colosseum at Night',
                'image'    => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Colosseum_exterior_at_night%2C_Rome%2C_Italy_%28Ank_Kumar%29_11.jpg/960px-Colosseum_exterior_at_night%2C_Rome%2C_Italy_%28Ank_Kumar%29_11.jpg',
                'section'  => 'home',
                'likes'    => 1987,
                'comments' => 354,
                'span'     => null,
            ],
            [
                'title'    => 'Via dei Fori Imperiali',
                'image'    => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9f/Sidewalk_of_Via_dei_Fori_Imperiali%2C_Roma%2C_Italy.jpg/960px-Sidewalk_of_Via_dei_Fori_Imperiali%2C_Roma%2C_Italy.jpg',
                'section'  => 'home',
                'likes'    => 884,
                'comments' => 160,
                'span'     => null,
            ],
        ];

        foreach ($shots as $shot) {
            Gallery::create(array_merge($shot, [
                'ip_address' => '127.0.0.1',
                'created_by' => 1,
                'updated_by' => 1,
            ]));
        }
    }
}
