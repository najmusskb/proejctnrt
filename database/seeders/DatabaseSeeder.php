<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            StatSeeder::class,
            HomeCategorySeeder::class,
            AboutSeeder::class,
            PartnerSeeder::class,
            DealSeeder::class,
            HomeGallerySeeder::class,
            FaqSeeder::class,
            HomeBlogSeeder::class,
            HomeTestimonialSeeder::class,
            HomeServiceSeeder::class,
            HomeWhyChooseUsSeeder::class,
            HomePackageSeeder::class,
            CompanyprofileCtaSeeder::class,
        ]);
    }
}
