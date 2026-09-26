<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;

$dataType = DataType::where('name', 'categories')->first();

if ($dataType) {
    DataRow::firstOrCreate([
        'data_type_id' => $dataType->id,
        'field'        => 'order',
    ], [
        'type'         => 'number',
        'display_name' => 'Thứ tự hiển thị',
        'required'     => 1,
        'browse'       => 1,
        'read'         => 1,
        'edit'         => 1,
        'add'          => 1,
        'delete'       => 1,
        'details'      => '{"default": 1}',
        'order'        => 6,
    ]);
    
    echo "Category BREAD updated with order field.\n";
} else {
    echo "Category BREAD not found.\n";
}
