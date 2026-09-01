<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class PartnerSeeder extends Seeder
{
    public function run()
    {
        $partners = [
            'Vatican Museums',
            'Borghese Gallery',
            'Roma Pass',
            'Trenitalia',
            'Visit Rome',
            'Italia.it',
            'ENIT',
            'Colosseo Parco Archeologico',
            'Musei Vaticani',
        ];

        $existing = Brand::orderBy('id')->get();

        foreach ($partners as $i => $name) {
            if (isset($existing[$i])) {
                $existing[$i]->update(['name' => $name, 'ip_address' => '127.0.0.1']);
            } else {
                Brand::create([
                    'name'       => $name,
                    'image'      => 'no.png',
                    'ip_address' => '127.0.0.1',
                    'created_by' => 1,
                ]);
            }
        }
    }
}
