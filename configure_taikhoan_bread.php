<?php

use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;

// Create DataType
$dataType = DataType::firstOrNew(['slug' => 'taikhoans']);
if (!$dataType->exists) {
    $dataType->fill([
        'name'                  => 'taikhoans',
        'display_name_singular' => 'Tài khoản khách hàng',
        'display_name_plural'   => 'Tài khoản khách hàng',
        'icon'                  => 'voyager-people',
        'model_name'            => 'App\\Models\\Taikhoan',
        'controller'            => '',
        'generate_permissions'  => 1,
        'description'           => '',
    ])->save();
}

// Ensure DataRows exist for this DataType
if ($dataType->exists) {
    $fields = [
        'id' => ['type' => 'number', 'display_name' => 'ID', 'required' => 1, 'browse' => 1, 'read' => 1, 'edit' => 0, 'add' => 0, 'delete' => 1, 'details' => ''],
        'phone' => ['type' => 'text', 'display_name' => 'Số điện thoại', 'required' => 1, 'browse' => 1, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 1, 'details' => ''],
        'password' => ['type' => 'password', 'display_name' => 'Mật khẩu', 'required' => 1, 'browse' => 0, 'read' => 0, 'edit' => 1, 'add' => 1, 'delete' => 1, 'details' => ''],
        'fullname' => ['type' => 'text', 'display_name' => 'Họ và tên', 'required' => 1, 'browse' => 1, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 1, 'details' => ''],
        'address' => ['type' => 'text', 'display_name' => 'Địa chỉ', 'required' => 0, 'browse' => 1, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 1, 'details' => ''],
        'created_at' => ['type' => 'timestamp', 'display_name' => 'Ngày tạo', 'required' => 0, 'browse' => 1, 'read' => 1, 'edit' => 0, 'add' => 0, 'delete' => 0, 'details' => ''],
        'updated_at' => ['type' => 'timestamp', 'display_name' => 'Ngày cập nhật', 'required' => 0, 'browse' => 0, 'read' => 0, 'edit' => 0, 'add' => 0, 'delete' => 0, 'details' => ''],
    ];

    $order = 1;
    foreach ($fields as $field => $options) {
        $dataRow = DataRow::firstOrNew([
            'data_type_id' => $dataType->id,
            'field'        => $field,
        ]);
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => $options['type'],
                'display_name' => $options['display_name'],
                'required'     => $options['required'],
                'browse'       => $options['browse'],
                'read'         => $options['read'],
                'edit'         => $options['edit'],
                'add'          => $options['add'],
                'delete'       => $options['delete'],
                'details'      => $options['details'],
                'order'        => $order++,
            ])->save();
        }
    }
}

// Add Menu Item
$menu = Menu::where('name', 'admin')->firstOrFail();
$menuItem = MenuItem::firstOrNew([
    'menu_id' => $menu->id,
    'title'   => 'Tài khoản khách hàng',
    'url'     => '',
    'route'   => 'voyager.taikhoans.index',
]);
if (!$menuItem->exists) {
    $menuItem->fill([
        'target'     => '_self',
        'icon_class' => 'voyager-people',
        'color'      => null,
        'parent_id'  => null,
        'order'      => 10,
    ])->save();
}

// Add Permissions to Admin Role
$permissions = Permission::where('table_name', 'taikhoans')->get();
$role = Role::where('name', 'admin')->first();
if ($role) {
    foreach ($permissions as $permission) {
        if (!$role->hasPermission($permission->key)) {
            $role->permissions()->attach($permission->id);
        }
    }
}

echo "BREAD for Taikhoan configured successfully.";
