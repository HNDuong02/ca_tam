<?php

$keys = [
    'site.home_banner',
    'site.home_banner_2',
    'site.home_banner_3',
    'site.home_banner_mobile',
    'site.home_banner_mobile_2',
    'site.home_banner_mobile_3'
];

foreach ($keys as $key) {
    $setting = TCG\Voyager\Models\Setting::where('key', $key)->first();
    if ($setting) {
        $setting->group = 'Banner';
        $setting->save();
        echo 'Updated: ' . $key . PHP_EOL;
    } else {
        $newSetting = new TCG\Voyager\Models\Setting();
        $newSetting->key = $key;
        $newSetting->display_name = ucwords(str_replace('_', ' ', str_replace('site.', '', $key)));
        $newSetting->value = '';
        $newSetting->details = '';
        $newSetting->type = 'image';
        $newSetting->order = 1;
        $newSetting->group = 'Banner';
        $newSetting->save();
        echo 'Created: ' . $key . PHP_EOL;
    }
}
