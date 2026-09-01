<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class HomeServiceSeeder extends Seeder
{
    public function run()
    {
        Service::query()->truncate();

        $services = [
            ['name' => 'Luggage Storage', 'slug' => 'luggage-storage', 'icon' => '🧳', 'short_description' => 'Drop your bags before your tour and explore hands-free. Secure storage right in the heart of the city, open daily.', 'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a4/Main_entrance_hall_at_Roma_Termini_Railway_Station_in_Rome%2C_Italy.jpg/960px-Main_entrance_hall_at_Roma_Termini_Railway_Station_in_Rome%2C_Italy.jpg', 'status' => 1, 'order' => 1, 'type' => 'home'],
            ['name' => 'Airport Transfer', 'slug' => 'airport-transfer', 'icon' => '✈️', 'short_description' => 'Private, punctual transfers to and from Fiumicino & Ciampino. A chauffeur meets you at arrivals — no queues, no hassle.', 'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b7/Rome_Fiumicino_international_airport_-_Main_entrance_with_streets.jpg/960px-Rome_Fiumicino_international_airport_-_Main_entrance_with_streets.jpg', 'status' => 1, 'order' => 2, 'type' => 'home'],
            ['name' => 'Private Taxi & Transfers', 'slug' => 'private-taxi-transfers', 'icon' => '🚗', 'short_description' => 'Book a private car for any journey — hotel-to-hotel, cruise port, or a night out. Fixed fares, professional drivers.', 'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a1/Colosseum_of_Rome_and_Roman_forum.jpg/960px-Colosseum_of_Rome_and_Roman_forum.jpg', 'status' => 1, 'order' => 3, 'type' => 'home'],
            ['name' => 'Golf Cart Tours', 'slug' => 'golf-cart-tours', 'icon' => '🏎️', 'short_description' => 'Glide through the cobbled lanes of the Eternal City in style. A fun, effortless way to see Rome\'s hidden gems.', 'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Colosseum_in_Rome%2C_Italy_-_April_2007.jpg/960px-Colosseum_in_Rome%2C_Italy_-_April_2007.jpg', 'status' => 1, 'order' => 4, 'type' => 'home'],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
