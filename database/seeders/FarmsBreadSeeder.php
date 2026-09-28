<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FarmsBreadSeeder extends Seeder
{
    public function run(): void
    {
        // Thêm DataType (BREAD config)
        $dataType = \TCG\Voyager\Models\DataType::firstOrNew(['slug' => 'farms']);
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'farms',
                'display_name_singular' => 'Trang trại',
                'display_name_plural'   => 'Danh sách Trang trại',
                'icon'                  => 'voyager-nature',
                'model_name'            => 'App\\Models\\Farm',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        // Tạo DataRows cho bảng
        $this->dataRow($dataType, 'id', 'ID', 'number', 1, 0, 0, 0, 0, 0, '{}', 1);
        $this->dataRow($dataType, 'name', 'Tên trang trại', 'text', 1, 1, 1, 1, 1, 1, '{}', 2);
        $this->dataRow($dataType, 'slug', 'Đường dẫn tĩnh', 'text', 1, 1, 1, 1, 1, 1, '{"slugify":{"origin":"name","forceUpdate":true}}', 3);
        $this->dataRow($dataType, 'address', 'Địa chỉ', 'text', 0, 1, 1, 1, 1, 1, '{}', 4);
        $this->dataRow($dataType, 'area', 'Diện tích', 'text', 0, 1, 1, 1, 1, 1, '{}', 5);
        $this->dataRow($dataType, 'description', 'Mô tả ngắn', 'text_area', 0, 1, 1, 1, 1, 1, '{}', 6);
        $this->dataRow($dataType, 'content', 'Nội dung chi tiết', 'rich_text_box', 0, 1, 1, 1, 1, 1, '{}', 7);
        $this->dataRow($dataType, 'images', 'Hình ảnh (Nhiều ảnh)', 'multiple_images', 0, 1, 1, 1, 1, 1, '{}', 8);
        $this->dataRow($dataType, 'video', 'Video / Clip', 'media_picker', 0, 1, 1, 1, 1, 1, '{"base_path":"farms/videos","allowed":["video"]}', 9);
        $this->dataRow($dataType, 'status', 'Trạng thái', 'checkbox', 1, 1, 1, 1, 1, 1, '{"on":"Hiển thị","off":"Ẩn","checked":true}', 10);
        $this->dataRow($dataType, 'created_at', 'Ngày tạo', 'timestamp', 0, 0, 0, 1, 0, 0, '{}', 11);
        $this->dataRow($dataType, 'updated_at', 'Ngày cập nhật', 'timestamp', 0, 0, 0, 0, 0, 0, '{}', 12);

        // Tạo Permissions
        \TCG\Voyager\Models\Permission::generateFor('farms');

        // Gán quyền cho Admin (Role ID = 1)
        $role = \TCG\Voyager\Models\Role::where('name', 'admin')->firstOrFail();
        $permissions = \TCG\Voyager\Models\Permission::where('table_name', 'farms')->get();
        $role->permissions()->syncWithoutDetaching($permissions->pluck('id')->toArray());

        // Thêm vào Menu
        $menu = \TCG\Voyager\Models\Menu::where('name', 'admin')->firstOrFail();
        $menuItem = \TCG\Voyager\Models\MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Trang trại',
            'url'     => '',
            'route'   => 'voyager.farms.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-nature',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 10,
            ])->save();
        }
    }

    protected function dataRow($type, $field, $display_name, $edit_type, $required, $browse, $read, $edit, $add, $delete, $details, $order)
    {
        $dataRow = \TCG\Voyager\Models\DataRow::firstOrNew([
            'data_type_id' => $type->id,
            'field'        => $field,
        ]);
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => $edit_type,
                'display_name' => $display_name,
                'required'     => $required,
                'browse'       => $browse,
                'read'         => $read,
                'edit'         => $edit,
                'add'          => $add,
                'delete'       => $delete,
                'details'      => $details,
                'order'        => $order,
            ])->save();
        }
    }
}
