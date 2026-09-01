<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Companyprofile;

class CompanyprofileCtaSeeder extends Seeder
{
    public function run()
    {
        $company = Companyprofile::first();

        if (!$company) {
            return;
        }

        $company->update([
            'cta_badge'        => '🌍 Ready for Your Roman Holiday?',
            'cta_title'        => 'Ready to Explore Rome?',
            'cta_description'  => 'Choose your perfect experience and start your Roman adventure today — secure, instant and unforgettable.',
            'cta_btn1_text'    => '🎟️ Explore Tours',
            'cta_btn1_link'    => '#tours',
            'cta_btn2_text'    => '💬 WhatsApp Us',
            'cta_btn2_link'    => $company->whatsapp ? 'https://wa.me/' . $company->whatsapp : 'https://wa.me/1234567890',
            'insta_handle'     => '@niceinrometour',
            'insta_followers'  => '12.4K',
            'insta_link'       => '#',
        ]);
    }
}
