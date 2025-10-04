<?php

namespace Modules\Base\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['type' => 'site_name', 'value' => 'Civil Engineering Report Generator'],
            ['type' => 'site_short_name', 'value' => 'CERG'],
            ['type' => 'address', 'value' => '123 Main St, City, Country'],
            ['type' => 'phone', 'value' => '+1234567890'],
            ['type' => 'email', 'value' => 'admin@civil.com',],
            ['type' => 'facebook', 'value' => 'https://facebook.com/yourpage'],
            ['type' => 'linkedin', 'value' => 'https://linkedin.com/in/yourprofile'],
            ['type' => 'x', 'value' => 'https://x.com/yourprofile'],
            ['type' => 'instagram', 'value' => 'https://instagram.com/yourprofile'],
            ['type' => 'pinterest', 'value' => 'https://pinterest.com/yourprofile'],
            ['type' => 'youtube', 'value' => 'https://youtube.com/yourchannel'],
            ['type' => 'meta_title', 'value' => 'Civil Engineering Report Generator'],
            ['type' => 'meta_tag', 'value' => json_encode([['value' => 'Civil'], ['value' => 'Engineering'], ['value' => 'Report'], ['value' => 'Generator']])],
            ['type' => 'meta_description', 'value' => 'A comprehensive tool for generating civil engineering reports.'],
            ['type' => 'cookies_allow', 'value' => 'Yes'],
        ];
        DB::table('general_settings')->insert($settings);
    }
}
