<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MailSetting;

class MailSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MailSetting::create([
            'mail_transport'            => 'smtp',
            'mail_host'                 => 'mail.reigeeky.com',
            'mail_port'                 => '465',
            'mail_username'             => 'support@reigeeky.com',
            'mail_password'             => 'HRBO0aObLuw',
            'mail_encryption'           => 'ssl',
            'mail_from'                 => 'support@reigeeky.com',
        ]);
    }
}
