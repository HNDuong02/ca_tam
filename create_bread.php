<?php

use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Permission;
use Illuminate\Support\Facades\DB;

$dataType = DataType::firstOrNew(['slug' => 'quotes']);
if (!$dataType->exists) {
    $dataType->fill([
        'name'                  => 'quotes',
        'display_name_singular' => 'Báo giá',
        'display_name_plural'   => 'Danh sách báo giá',
        'icon'                  => 'voyager-receipt',
        'model_name'            => 'App\\Models\\Quote',
        'controller'            => '',
        'generate_permissions'  => 1,
        'description'           => 'Quản lý yêu cầu báo giá',
    ])->save();
}

$columns = ['id', 'customer_name', 'phone_number', 'email', 'product_id', 'note', 'status', 'created_at', 'updated_at'];
foreach($columns as $col) {
    $row = DataRow::firstOrNew(['data_type_id' => $dataType->id, 'field' => $col]);
    $type = 'text';
    $details = '{}';
    $displayName = $col;
    $browse = 1;
    $read = 1;
    $edit = 1;
    $add = 1;
    $delete = 1;
    $order = array_search($col, $columns) + 1;
    
    if($col == 'id') { $type = 'number'; $displayName = 'ID'; $edit = 0; $add = 0; }
    if($col == 'customer_name') { $displayName = 'Tên KH'; }
    if($col == 'phone_number') { $displayName = 'SĐT'; }
    if($col == 'email') { $displayName = 'Email'; }
    if($col == 'product_id') { $displayName = 'Mã Sản Phẩm'; $browse = 0; $read = 0; $edit = 0; $add = 0;}
    if($col == 'note') { $type = 'text_area'; $displayName = 'Ghi chú'; }
    if($col == 'created_at') { $type = 'timestamp'; $displayName = 'Ngày tạo'; $edit = 0; $add = 0; }
    if($col == 'updated_at') { $type = 'timestamp'; $displayName = 'Ngày cập nhật'; $browse = 0; $read = 1; $edit = 0; $add = 0; }
    if($col == 'status') { 
        $type = 'select_dropdown'; 
        $displayName = 'Trạng thái'; 
        $details = '{"default":"new","options":{"new":"Mới","processing":"Đang tư vấn","completed":"Chốt","canceled":"Hủy"}}';
    }
    
    $row->fill([
        'type' => $type,
        'display_name' => $displayName,
        'required' => in_array($col, ['customer_name', 'phone_number', 'status']) ? 1 : 0,
        'browse' => $browse,
        'read' => $read,
        'edit' => $edit,
        'add' => $add,
        'delete' => $delete,
        'details' => $details,
        'order' => $order
    ])->save();
}

$rel = DataRow::firstOrNew(['data_type_id' => $dataType->id, 'field' => 'quote_belongsto_product_relationship']);
$rel->fill([
    'type' => 'relationship',
    'display_name' => 'Sản phẩm',
    'required' => 0,
    'browse' => 1,
    'read' => 1,
    'edit' => 1,
    'add' => 1,
    'delete' => 1,
    'details' => '{"model":"App\\\\Models\\\\Product","table":"products","type":"belongsTo","column":"product_id","key":"id","label":"name","pivot_table":"categories","pivot":"0","taggable":"0"}',
    'order' => 5
])->save();

Permission::generateFor('quotes');
$permissions = Permission::where('table_name', 'quotes')->pluck('id')->all();
$role = TCG\Voyager\Models\Role::where('name', 'admin')->first();
if($role) {
    $role->permissions()->syncWithoutDetaching($permissions);
}

$menu = Menu::where('name', 'admin')->firstOrFail();
$menuItem = MenuItem::firstOrNew([
    'menu_id' => $menu->id,
    'title' => 'Danh sách báo giá',
    'url' => '',
    'route' => 'voyager.quotes.index',
]);
if (!$menuItem->exists) {
    $menuItem->fill([
        'target' => '_self',
        'icon_class' => 'voyager-receipt',
        'color' => null,
        'parent_id' => null,
        'order' => 10,
    ])->save();
}

echo "BREAD for Quotes configured successfully.\n";
