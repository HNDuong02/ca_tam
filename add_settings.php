<?php
use Illuminate\Support\Facades\DB;

$settings = [
    [
        'key'          => 'site.director',
        'display_name' => 'Giám đốc / Người đại diện',
        'value'        => 'Nguyễn Văn A',
        'details'      => '',
        'type'         => 'text',
        'order'        => 7,
        'group'        => 'Site',
    ],
    [
        'key'          => 'site.tax_code',
        'display_name' => 'Mã số thuế',
        'value'        => '0101234567',
        'details'      => '',
        'type'         => 'text',
        'order'        => 8,
        'group'        => 'Site',
    ],
    [
        'key'          => 'site.main_business',
        'display_name' => 'Ngành nghề chính',
        'value'        => 'Nuôi trồng thủy sản nội địa',
        'details'      => '',
        'type'         => 'text',
        'order'        => 9,
        'group'        => 'Site',
    ],
];

foreach ($settings as $setting) {
    if (!DB::table('settings')->where('key', $setting['key'])->exists()) {
        DB::table('settings')->insert($setting);
    }
}

echo "Successfully added site settings.";
