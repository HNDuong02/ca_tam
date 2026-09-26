<?php
use TCG\Voyager\Models\Setting;

$settings = [
    [
        'key' => 'farm.image',
        'display_name' => 'Ảnh Trang trại',
        'value' => '',
        'details' => '',
        'type' => 'image',
        'order' => 1,
        'group' => 'Farm'
    ],
    [
        'key' => 'farm.title',
        'display_name' => 'Tiêu đề Trang trại',
        'value' => 'Từ trang trại Đông Bắc<br>đến bàn ăn của bạn',
        'details' => '',
        'type' => 'text',
        'order' => 2,
        'group' => 'Farm'
    ],
    [
        'key' => 'farm.bullet_1',
        'display_name' => 'Gạch đầu dòng 1',
        'value' => 'Chủ động nguồn cá',
        'details' => '',
        'type' => 'text',
        'order' => 3,
        'group' => 'Farm'
    ],
    [
        'key' => 'farm.bullet_2',
        'display_name' => 'Gạch đầu dòng 2',
        'value' => 'Quy trình nuôi khép kín kiểm soát khắt khe',
        'details' => '',
        'type' => 'text',
        'order' => 4,
        'group' => 'Farm'
    ],
    [
        'key' => 'farm.bullet_3',
        'display_name' => 'Gạch đầu dòng 3',
        'value' => 'Cung cấp cá giống, cá thương phẩm',
        'details' => '',
        'type' => 'text',
        'order' => 5,
        'group' => 'Farm'
    ],
    [
        'key' => 'farm.bullet_4',
        'display_name' => 'Gạch đầu dòng 4',
        'value' => 'Giao nhận chuyên nghiệp cho đối tác',
        'details' => '',
        'type' => 'text',
        'order' => 6,
        'group' => 'Farm'
    ],
];

foreach ($settings as $setting) {
    Setting::updateOrCreate(['key' => $setting['key']], $setting);
}
echo "Done";
