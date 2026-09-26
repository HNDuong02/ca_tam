<?php

$settings = TCG\Voyager\Models\Setting::get();
$desiredKeys = [
    'site.home_banner' => 'banner.home_banner',
    'site.home_banner_2' => 'banner.home_banner_2',
    'site.home_banner_3' => 'banner.home_banner_3',
    'site.home_banner_mobile' => 'banner.home_banner_mobile',
    'site.home_banner_mobile_2' => 'banner.home_banner_mobile_2',
    'site.home_banner_mobile_3' => 'banner.home_banner_mobile_3',
    // also clean up any duplicate badly named ones like banner.site.home_banner
    'banner.site.home_banner_mobile' => 'banner.home_banner_mobile',
    'banner.site.home_banner_mobile_2' => 'banner.home_banner_mobile_2',
    'banner.site.home_banner_mobile_3' => 'banner.home_banner_mobile_3',
];

foreach ($settings as $setting) {
    if (array_key_exists($setting->key, $desiredKeys)) {
        // Check if the target key already exists to avoid duplicate key errors
        $targetKey = $desiredKeys[$setting->key];
        if ($setting->key !== $targetKey && TCG\Voyager\Models\Setting::where('key', $targetKey)->exists()) {
            // Delete the old one if it's a duplicate
            $setting->delete();
            echo "Deleted duplicate: " . $setting->key . "\n";
        } else {
            $setting->key = $targetKey;
            $setting->group = 'Banner';
            $setting->save();
            echo "Renamed key to: " . $setting->key . "\n";
        }
    }
}

// Clear cache
\Artisan::call('cache:clear');
echo "Cache cleared.\n";
