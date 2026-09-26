<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\DataRow;

$dataType = DataType::where('name', 'products')->first();

if ($dataType) {
    $exists = DataRow::where('data_type_id', $dataType->id)->where('field', 'usage_guide')->exists();
    if (!$exists) {
        // Get max order
        $maxOrder = DataRow::where('data_type_id', $dataType->id)->max('order');

        DataRow::create([
            'data_type_id' => $dataType->id,
            'field'        => 'usage_guide',
            'type'         => 'rich_text_box',
            'display_name' => 'Hướng Dẫn Sử Dụng',
            'required'     => 0,
            'browse'       => 0,
            'read'         => 1,
            'edit'         => 1,
            'add'          => 1,
            'delete'       => 1,
            'details'      => '{}',
            'order'        => $maxOrder + 1,
        ]);
        echo "BREAD configured for usage_guide!\n";
    } else {
        echo "BREAD for usage_guide already exists.\n";
    }
} else {
    echo "DataType products not found.\n";
}
