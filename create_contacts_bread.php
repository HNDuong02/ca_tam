<?php
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Menu;

$dataType = DataType::firstOrCreate([
    'slug'                  => 'contacts',
], [
    'name'                  => 'contacts',
    'display_name_singular' => 'Liên hệ',
    'display_name_plural'   => 'Danh sách liên hệ',
    'icon'                  => 'voyager-mail',
    'model_name'            => 'App\\Models\\Contact',
    'controller'            => '',
    'generate_permissions'  => 1,
    'description'           => 'Quản lý liên hệ khách hàng',
]);

$rows = [
    ['field' => 'id', 'type' => 'number', 'display_name' => 'ID', 'required' => 1, 'browse' => 0, 'read' => 0, 'edit' => 0, 'add' => 0, 'delete' => 0, 'details' => '', 'order' => 1],
    ['field' => 'name', 'type' => 'text', 'display_name' => 'Tên khách hàng', 'required' => 1, 'browse' => 1, 'read' => 1, 'edit' => 0, 'add' => 0, 'delete' => 1, 'details' => '', 'order' => 2],
    ['field' => 'phone', 'type' => 'text', 'display_name' => 'Số điện thoại', 'required' => 0, 'browse' => 1, 'read' => 1, 'edit' => 0, 'add' => 0, 'delete' => 1, 'details' => '', 'order' => 3],
    ['field' => 'email', 'type' => 'text', 'display_name' => 'Email', 'required' => 0, 'browse' => 1, 'read' => 1, 'edit' => 0, 'add' => 0, 'delete' => 1, 'details' => '', 'order' => 4],
    ['field' => 'content', 'type' => 'text_area', 'display_name' => 'Nội dung', 'required' => 0, 'browse' => 1, 'read' => 1, 'edit' => 0, 'add' => 0, 'delete' => 1, 'details' => '', 'order' => 5],
    ['field' => 'status', 'type' => 'select_dropdown', 'display_name' => 'Trạng thái', 'required' => 1, 'browse' => 1, 'read' => 1, 'edit' => 1, 'add' => 0, 'delete' => 1, 'details' => '{"default": "NEW", "options": {"NEW": "Chưa đọc", "READ": "Đã đọc"}}', 'order' => 6],
    ['field' => 'created_at', 'type' => 'timestamp', 'display_name' => 'Ngày gửi', 'required' => 0, 'browse' => 1, 'read' => 1, 'edit' => 0, 'add' => 0, 'delete' => 0, 'details' => '', 'order' => 7],
];

foreach ($rows as $row) {
    DataRow::firstOrCreate([
        'data_type_id' => $dataType->id,
        'field'        => $row['field'],
    ], $row);
}

Permission::generateFor('contacts');

$menu = Menu::where('name', 'admin')->firstOrFail();
$menuItem = MenuItem::firstOrNew([
    'menu_id' => $menu->id,
    'title'   => 'Liên hệ',
    'url'     => '',
    'route'   => 'voyager.contacts.index',
]);
if (!$menuItem->exists) {
    $menuItem->fill([
        'target'     => '_self',
        'icon_class' => 'voyager-mail',
        'color'      => null,
        'parent_id'  => null,
        'order'      => 10,
    ])->save();
}

echo "BREAD configured successfully.\n";
