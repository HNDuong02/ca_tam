<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use TCG\Voyager\Models\Setting;

Setting::firstOrCreate(
    ['key' => 'site.home_banner'],
    [
        'display_name' => 'Banner Trang Chủ',
        'value'        => '',
        'details'      => '',
        'type'         => 'image',
        'order'        => 10,
        'group'        => 'Site',
    ]
);

echo "Home banner setting configured successfully!\n";
