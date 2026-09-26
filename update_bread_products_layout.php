<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\DataRow;

$dataType = DataType::where('name', 'products')->first();

if (!$dataType) {
    echo "DataType products not found.\n";
    exit;
}

$fields = [
    'id' => ['width' => '12', 'type' => 'hidden'],
    'name' => ['width' => '6', 'display_name' => 'Tên Sản Phẩm'],
    'slug' => ['width' => '6', 'display_name' => 'Đường dẫn (Slug)', 'details' => '{"slugify":{"origin":"name","forceUpdate":true},"display":{"width":"6"}}'],
    'category_id' => ['width' => '6', 'display_name' => 'Chuyên mục'],
    'product_belongsto_category_relationship' => ['width' => '6', 'display_name' => 'Danh Mục', 'details' => '{"model":"App\\\\Models\\\\Category","table":"categories","type":"belongsTo","column":"category_id","key":"id","label":"name","pivot_table":"categories","pivot":"0","taggable":"0","display":{"width":"6"}}'],
    'price_text' => ['width' => '6', 'display_name' => 'Giá (Hiển thị)'],
    'status' => ['width' => '6', 'display_name' => 'Trạng thái (Hiển thị)'],
    'action_type' => ['width' => '6', 'display_name' => 'Loại hành động'],
    'image' => ['width' => '6', 'display_name' => 'Ảnh đại diện'],
    'gallery' => ['width' => '6', 'display_name' => 'Thư viện ảnh'],
    'short_description' => ['width' => '12', 'display_name' => 'Mô tả ngắn (Hiển thị ngoài trang chủ)'],
    'body_html' => ['width' => '12', 'display_name' => 'Thông tin chi tiết'],
    'usage_guide' => ['width' => '12', 'display_name' => 'Hướng dẫn sử dụng'],
    'meta_title' => ['width' => '12', 'display_name' => 'SEO Title'],
    'meta_description' => ['width' => '12', 'display_name' => 'SEO Description'],
    'meta_keywords' => ['width' => '12', 'display_name' => 'SEO Keywords'],
    'created_at' => ['width' => '6'],
    'updated_at' => ['width' => '6'],
];

$order = 1;
foreach ($fields as $field => $config) {
    $row = DataRow::where('data_type_id', $dataType->id)->where('field', $field)->first();
    if ($row) {
        $row->order = $order++;
        if (isset($config['display_name'])) {
            $row->display_name = $config['display_name'];
        }
        
        $details = [];
        if ($row->details) {
            $details = is_string($row->details) ? json_decode($row->details, true) : (array)$row->details;
        }
        
        if (isset($config['details'])) {
            $details = json_decode($config['details'], true);
        } else {
            $details['display'] = ['width' => $config['width']];
        }
        
        $row->details = $details;
        $row->save();
    }
}

echo "BREAD layout for products updated successfully!\n";
