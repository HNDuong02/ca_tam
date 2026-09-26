<?php
use TCG\Voyager\Models\DataRow;

$rows = DataRow::where('field', 'product_id')->get();

foreach ($rows as $row) {
    echo "ID: " . $row->id . ", Field: " . $row->field . ", Add: " . $row->add . ", Edit: " . $row->edit . "\n";
    if ($row->add == 0 || $row->edit == 0) {
        $row->add = 1;
        $row->edit = 1;
        $row->save();
        echo "Fixed add/edit for DataRow ID " . $row->id . "\n";
    }
}
echo "Done.\n";
