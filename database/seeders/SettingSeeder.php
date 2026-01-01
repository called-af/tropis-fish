<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'company_name',
                'value' => 'PT. TROPIS FISH INDONESIA',
            ],
            [
                'key' => 'company_description',
                'value' => 'Export of Ornamental Freshwater Fish',
            ],
            [
                'key' => 'company_logo',
                'value' => null,
            ],
            [
                'key' => 'contact_email',
                'value' => 'sales@tropisfish.com',
            ],
            [
                'key' => 'mail_mailer',
                'value' => 'smtp',
            ],
            [
                'key' => 'mail_host',
                'value' => 'smtp.gmail.com',
            ],
            [
                'key' => 'mail_port',
                'value' => '587',
            ],
            [
                'key' => 'mail_username',
                'value' => '',
            ],
            [
                'key' => 'mail_password',
                'value' => '',
            ],
            [
                'key' => 'mail_encryption',
                'value' => 'tls',
            ],
            [
                'key' => 'mail_from_address',
                'value' => 'noreply@tropisfish.com',
            ],
            [
                'key' => 'mail_from_name',
                'value' => 'PT. TROPIS FISH INDONESIA',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
