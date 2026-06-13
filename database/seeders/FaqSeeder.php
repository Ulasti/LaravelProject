<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        Faq::create([
            'question' => 'What payment methods do you accept?',
            'answer' => 'We accept Visa, Mastercard, American Express, PayPal, and Apple Pay. All payments are processed securely.',
            'status' => true,
            'order' => 1,
        ]);

        Faq::create([
            'question' => 'How long does shipping take?',
            'answer' => 'Standard shipping takes 5-7 business days within the continental US. Express shipping is available for 2-3 business days. International shipping times vary by destination.',
            'status' => true,
            'order' => 2,
        ]);

        Faq::create([
            'question' => 'What is your return policy?',
            'answer' => 'We offer a 30-day return policy on all unused items in their original packaging. Simply contact our support team to initiate a return.',
            'status' => true,
            'order' => 3,
        ]);

        Faq::create([
            'question' => 'Do you ship internationally?',
            'answer' => 'Yes, we ship to over 50 countries worldwide. Shipping costs and delivery times vary by destination. You can see the estimated shipping cost at checkout.',
            'status' => true,
            'order' => 4,
        ]);

        Faq::create([
            'question' => 'How can I track my order?',
            'answer' => 'Once your order is shipped, you will receive a confirmation email with a tracking number. You can use this number on our website or the carrier\'s website to track your package.',
            'status' => true,
            'order' => 5,
        ]);

        $this->command->info('FAQs seeded successfully!');
    }
}
