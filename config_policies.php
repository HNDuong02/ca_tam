<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use TCG\Voyager\Models\Setting;

$policies = [
    [
        'key' => 'site.policy_terms',
        'display_name' => 'Chính sách & Điều khoản',
        'type' => 'rich_text_box',
        'order' => 20,
    ],
    [
        'key' => 'site.policy_privacy',
        'display_name' => 'Chính sách bảo mật',
        'type' => 'rich_text_box',
        'order' => 21,
    ],
    [
        'key' => 'site.policy_shipping',
        'display_name' => 'Chính sách giao hàng',
        'type' => 'rich_text_box',
        'order' => 22,
    ]
];

foreach ($policies as $policy) {
    Setting::firstOrCreate(
        ['key' => $policy['key']],
        [
            'display_name' => $policy['display_name'],
            'value'        => '<p>Nội dung đang cập nhật...</p>',
            'details'      => '',
            'type'         => $policy['type'],
            'order'        => $policy['order'],
            'group'        => 'Site',
        ]
    );
}

echo "Policy settings configured successfully!\n";
