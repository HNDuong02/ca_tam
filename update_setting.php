<?php
use TCG\Voyager\Models\Setting;
$setting = Setting::where('key', 'site.product_banner_image')->first();
if ($setting) {
    $setting->key = 'product.banner_image';
    $setting->group = 'Product';
    $setting->save();
}
echo "Done";
