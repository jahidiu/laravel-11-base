<?php

namespace App\Services;

use Modules\Base\App\Models\Event;
use Modules\Base\App\Models\GeneralSetting;

class HeaderFooterService
{
    protected $siteData;

    public function __construct()
    {
        $this->siteData = $this->fetchSiteData();
    }

    private function fetchSiteData()
    {
        $settings = GeneralSetting::pluck('value', 'type')->toArray();
        return [
            'site_name' => $settings['site_name'] ?? 'BLIC',
            'site_short_name' => $settings['site_short_name'] ?? 'BLIC',
            'primary_logo' => $settings['primary_logo'] ?? null,
            'secondary_logo' => $settings['secondary_logo'] ?? null,
            'favicon' => $settings['favicon'] ?? null,
            'phone' => $settings['phone'] ?? '',
            'email' => $settings['email'] ?? '',
            'address' => $settings['address'] ?? '',
            'facebook' => $settings['facebook'] ?? '',
            'linkedin' => $settings['linkedin'] ?? '',
            'x' => $settings['x'] ?? '',
            'instagram' => $settings['instagram'] ?? '',
            'pinterest' => $settings['pinterest'] ?? '',
            'youtube' => $settings['youtube'] ?? '',
            'meta_title' => $settings['meta_title'] ?? '',
            'meta_tag' => implode(', ', array_column(json_decode($settings['meta_tag'] ?? '[]'), 'value')),
            'meta_description' => $settings['meta_description'] ?? '',
            'meta_image' => $settings['meta_image'] ?? null,
            'cookies_allow' => $settings['cookies_allow'] ?? 'No',
        ];
    }


    public function getSiteData()
    {
        return $this->siteData;
    }
}
