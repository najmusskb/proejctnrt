<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    public function run()
    {
        Faq::query()->truncate();

        $faqs = [
            ['question' => 'How does WhatsApp booking work?', 'answer' => 'Simply click "WhatsApp Us", send us a message with your preferred tour, date, and number of people. We confirm your booking in seconds — no forms, no waiting, just a friendly chat.', 'order' => 1],
            ['question' => 'What is your cancellation policy?', 'answer' => 'All tours offer free cancellation up to 24 hours before the tour starts. Simply message us on WhatsApp to cancel or reschedule — we\'ll handle it instantly with no questions asked.', 'order' => 2],
            ['question' => 'Are your tours suitable for families with kids?', 'answer' => 'Absolutely! Our guides are experienced with families and know how to keep kids engaged with fun stories and facts. Many tours have family discounts — just ask us on WhatsApp!', 'order' => 3],
            ['question' => 'How many people are in a "small group" tour?', 'answer' => 'Our small group tours have a maximum of 12 people, ensuring a personal, intimate experience. You can always hear the guide and ask questions comfortably.', 'order' => 4],
            ['question' => 'Do I need to print my ticket?', 'answer' => 'No printing needed! We send your tickets digitally via WhatsApp. Simply show the QR code on your phone at the entrance. Easy, eco-friendly, and hassle-free.', 'order' => 5],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
