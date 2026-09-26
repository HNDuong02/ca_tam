<?php

use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Permission;
use Illuminate\Support\Facades\DB;

// ==========================================
// 1. Nutritional Facts
// ==========================================
$dataTypeNF = DataType::firstOrNew(['slug' => 'nutritional-facts']);
if (!$dataTypeNF->exists) {
    $dataTypeNF->fill([
        'name'                  => 'nutritional_facts',
        'display_name_singular' => 'Thành phần dinh dưỡng',
        'display_name_plural'   => 'Thành phần dinh dưỡng',
        'icon'                  => 'voyager-pie-chart',
        'model_name'            => 'App\\Models\\NutritionalFact',
        'controller'            => '',
        'generate_permissions'  => 1,
        'description'           => 'Quản lý thành phần dinh dưỡng của sản phẩm',
    ])->save();
}

$columnsNF = ['id', 'product_id', 'nutrient', 'amount', 'daily_value', 'created_at', 'updated_at'];
foreach($columnsNF as $col) {
    $row = DataRow::firstOrNew(['data_type_id' => $dataTypeNF->id, 'field' => $col]);
    $type = 'text';
    $details = '{}';
    $displayName = $col;
    $browse = 1; $read = 1; $edit = 1; $add = 1; $delete = 1;
    $order = array_search($col, $columnsNF) + 1;
    
    if($col == 'id') { $type = 'number'; $displayName = 'ID'; $edit = 0; $add = 0; }
    if($col == 'product_id') { $displayName = 'Sản phẩm ID'; $browse = 0; $read = 0; $edit = 0; $add = 0;}
    if($col == 'nutrient') { $displayName = 'Tên dưỡng chất'; }
    if($col == 'amount') { $displayName = 'Hàm lượng (Mỗi lỏng)'; }
    if($col == 'daily_value') { $displayName = 'Nguồn năng lượng (%)'; }
    if($col == 'created_at') { $type = 'timestamp'; $displayName = 'Ngày tạo'; $edit = 0; $add = 0; }
    if($col == 'updated_at') { $type = 'timestamp'; $displayName = 'Ngày cập nhật'; $browse = 0; $read = 1; $edit = 0; $add = 0; }
    
    $row->fill([
        'type' => $type,
        'display_name' => $displayName,
        'required' => in_array($col, ['nutrient']) ? 1 : 0,
        'browse' => $browse, 'read' => $read, 'edit' => $edit, 'add' => $add, 'delete' => $delete,
        'details' => $details,
        'order' => $order
    ])->save();
}

$relNF = DataRow::firstOrNew(['data_type_id' => $dataTypeNF->id, 'field' => 'nutritional_fact_belongsto_product_relationship']);
$relNF->fill([
    'type' => 'relationship', 'display_name' => 'Sản phẩm', 'required' => 0,
    'browse' => 1, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 1,
    'details' => '{"model":"App\\\\Models\\\\Product","table":"products","type":"belongsTo","column":"product_id","key":"id","label":"name","pivot_table":"categories","pivot":"0","taggable":"0"}',
    'order' => 2
])->save();

Permission::generateFor('nutritional_facts');

// ==========================================
// 2. Product Reviews
// ==========================================
$dataTypePR = DataType::firstOrNew(['slug' => 'product-reviews']);
if (!$dataTypePR->exists) {
    $dataTypePR->fill([
        'name'                  => 'product_reviews',
        'display_name_singular' => 'Đánh giá',
        'display_name_plural'   => 'Đánh giá khách hàng',
        'icon'                  => 'voyager-star',
        'model_name'            => 'App\\Models\\ProductReview',
        'controller'            => '',
        'generate_permissions'  => 1,
        'description'           => 'Quản lý đánh giá khách hàng',
    ])->save();
}

$columnsPR = ['id', 'product_id', 'customer_name', 'rating', 'comment', 'images', 'status', 'created_at', 'updated_at'];
foreach($columnsPR as $col) {
    $row = DataRow::firstOrNew(['data_type_id' => $dataTypePR->id, 'field' => $col]);
    $type = 'text';
    $details = '{}';
    $displayName = $col;
    $browse = 1; $read = 1; $edit = 1; $add = 1; $delete = 1;
    $order = array_search($col, $columnsPR) + 1;
    
    if($col == 'id') { $type = 'number'; $displayName = 'ID'; $edit = 0; $add = 0; }
    if($col == 'product_id') { $displayName = 'Sản phẩm ID'; $browse = 0; $read = 0; $edit = 0; $add = 0;}
    if($col == 'customer_name') { $displayName = 'Tên khách hàng'; }
    if($col == 'rating') { $type = 'number'; $displayName = 'Số sao'; $details = '{"min":1, "max":5}'; }
    if($col == 'comment') { $type = 'text_area'; $displayName = 'Nội dung đánh giá'; }
    if($col == 'images') { $type = 'multiple_images'; $displayName = 'Hình ảnh'; $browse = 0; }
    if($col == 'status') { 
        $type = 'checkbox'; 
        $displayName = 'Hiển thị'; 
        $details = '{"on":"Bật","off":"Tắt","checked":true}';
    }
    if($col == 'created_at') { $type = 'timestamp'; $displayName = 'Ngày tạo'; $edit = 0; $add = 0; }
    if($col == 'updated_at') { $type = 'timestamp'; $displayName = 'Ngày cập nhật'; $browse = 0; $read = 1; $edit = 0; $add = 0; }
    
    $row->fill([
        'type' => $type,
        'display_name' => $displayName,
        'required' => in_array($col, ['customer_name', 'rating']) ? 1 : 0,
        'browse' => $browse, 'read' => $read, 'edit' => $edit, 'add' => $add, 'delete' => $delete,
        'details' => $details,
        'order' => $order
    ])->save();
}

$relPR = DataRow::firstOrNew(['data_type_id' => $dataTypePR->id, 'field' => 'product_review_belongsto_product_relationship']);
$relPR->fill([
    'type' => 'relationship', 'display_name' => 'Sản phẩm', 'required' => 0,
    'browse' => 1, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 1,
    'details' => '{"model":"App\\\\Models\\\\Product","table":"products","type":"belongsTo","column":"product_id","key":"id","label":"name","pivot_table":"categories","pivot":"0","taggable":"0"}',
    'order' => 2
])->save();

Permission::generateFor('product_reviews');

// Grant permissions to admin
$permissions = Permission::whereIn('table_name', ['nutritional_facts', 'product_reviews'])->pluck('id')->all();
$role = TCG\Voyager\Models\Role::where('name', 'admin')->first();
if($role) {
    $role->permissions()->syncWithoutDetaching($permissions);
}

// Add Menu Items
$menu = Menu::where('name', 'admin')->firstOrFail();

$menuItem1 = MenuItem::firstOrNew([
    'menu_id' => $menu->id, 'title' => 'Thành phần dinh dưỡng', 'route' => 'voyager.nutritional-facts.index',
]);
if (!$menuItem1->exists) {
    $menuItem1->fill(['target' => '_self', 'icon_class' => 'voyager-pie-chart', 'color' => null, 'parent_id' => null, 'order' => 11])->save();
}

$menuItem2 = MenuItem::firstOrNew([
    'menu_id' => $menu->id, 'title' => 'Đánh giá khách hàng', 'route' => 'voyager.product-reviews.index',
]);
if (!$menuItem2->exists) {
    $menuItem2->fill(['target' => '_self', 'icon_class' => 'voyager-star', 'color' => null, 'parent_id' => null, 'order' => 12])->save();
}

echo "BREAD for Nutritional Facts and Product Reviews configured successfully.\n";
