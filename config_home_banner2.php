<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use TCG\Voyager\Models\Setting;

Setting::firstOrCreate(
    ['key' => 'site.home_banner_2'],
    [
        'display_name' => 'Banner Trang Chủ 2',
        'value'        => '',
        'details'      => '',
        'type'         => 'image',
        'order'        => 11,
        'group'        => 'Site',
    ]
);

Setting::firstOrCreate(
    ['key' => 'site.home_banner_3'],
    [
        'display_name' => 'Banner Trang Chủ 3',
        'value'        => '',
        'details'      => '',
        'type'         => 'image',
        'order'        => 12,
        'group'        => 'Site',
    ]
);

echo "Home banner 2 and 3 settings configured successfully!\n";
