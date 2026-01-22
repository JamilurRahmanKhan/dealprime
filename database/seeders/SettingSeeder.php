<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            'company_name' => 'Deal prime',
            'contact_phone' => '01715023222 ',
            'support_phone' => '01712450000',
            'contact_email' => 'dealprime@gmail.com ',
            'support_email' => 'dealsupport@gmail.com ',
            'support_hours' => '24 ',
            'facebook' => 'https://facebook.com ',
            'twitter' => ' https://twitter.com',
            'instagram' => 'https://instagram.com ',
            'google_map' => 'https://google map link ',
            'company_address' => ' Dhaka, Bangladesh',
            'logo_png' => 'https://demo.unitechsolution.net/website/assets/images/logo/DealPrimeLogo.png',
            'favicon' => 'https://cdn.vectorstock.com/i/500p/67/82/smartphone-logo-design-gadget-logotype-in-a-frame-vector-45996782.jpg ',
            'payment_method_image' => 'https://www.kindpng.com/picc/m/47-479391_payment-method-icons-png-png-download-transparent-payment.png ',
        ]);
    }
}