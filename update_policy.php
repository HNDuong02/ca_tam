<?php
use TCG\Voyager\Models\Setting;
$settings = Setting::where('key', 'like', '%policy%')->get();
foreach ($settings as $setting) {
    $setting->group = 'Chính sách';
    $setting->save();
}
echo "Done";
