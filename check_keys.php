<?php
$settings = TCG\Voyager\Models\Setting::get();
foreach ($settings as $setting) {
    if (str_contains($setting->key, 'banner')) {
        echo $setting->key . ' (' . $setting->group . ')' . PHP_EOL;
    }
}
