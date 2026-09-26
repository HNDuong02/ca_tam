<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use TCG\Voyager\Models\Setting;

$settings = [
    [
        'key'          => 'pages.product_story_image',
        'display_name' => 'Ảnh Câu chuyện sản phẩm',
        'value'        => '',
        'details'      => '',
        'type'         => 'image',
        'order'        => 1,
        'group'        => 'Pages',
    ],
    [
        'key'          => 'pages.product_story',
        'display_name' => 'Nội dung Câu chuyện sản phẩm',
        'value'        => 'Nội dung câu chuyện sản phẩm của chúng tôi...',
        'details'      => '',
        'type'         => 'rich_text_box',
        'order'        => 2,
        'group'        => 'Pages',
    ],
    [
        'key'          => 'pages.company_intro_image',
        'display_name' => 'Ảnh Giới thiệu doanh nghiệp',
        'value'        => '',
        'details'      => '',
        'type'         => 'image',
        'order'        => 3,
        'group'        => 'Pages',
    ],
    [
        'key'          => 'pages.company_intro',
        'display_name' => 'Nội dung Giới thiệu doanh nghiệp',
        'value'        => 'Nội dung giới thiệu doanh nghiệp...',
        'details'      => '',
        'type'         => 'rich_text_box',
        'order'        => 4,
        'group'        => 'Pages',
    ],
];

foreach ($settings as $setting) {
    Setting::firstOrCreate(
        ['key' => $setting['key']],
        $setting
    );
}

echo "Settings for pages configured successfully!\n";
