<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use TCG\Voyager\Models\Setting;

$settings = [
    [
        'key'          => 'site.company_name',
        'display_name' => 'Tên Công Ty',
        'value'        => 'Công ty Cổ phần Nông nghiệp Đông Bắc',
        'details'      => '',
        'type'         => 'text',
        'order'        => 5,
        'group'        => 'Site',
    ],
    [
        'key'          => 'site.company_address',
        'display_name' => 'Địa chỉ',
        'value'        => '123 Đường Điện Biên Phủ, Quận 1, TP.HCM',
        'details'      => '',
        'type'         => 'text',
        'order'        => 6,
        'group'        => 'Site',
    ],
    [
        'key'          => 'site.hotline',
        'display_name' => 'Hotline',
        'value'        => '0988888888',
        'details'      => '',
        'type'         => 'text',
        'order'        => 7,
        'group'        => 'Site',
    ],
    [
        'key'          => 'site.zalo',
        'display_name' => 'Link Zalo',
        'value'        => 'https://zalo.me/0988888888',
        'details'      => '',
        'type'         => 'text',
        'order'        => 8,
        'group'        => 'Site',
    ],
    [
        'key'          => 'site.facebook',
        'display_name' => 'Link Facebook',
        'value'        => 'https://facebook.com/',
        'details'      => '',
        'type'         => 'text',
        'order'        => 9,
        'group'        => 'Site',
    ],
];

foreach ($settings as $setting) {
    Setting::firstOrCreate(
        ['key' => $setting['key']],
        $setting
    );
}

echo "Settings for company info configured successfully!\n";
