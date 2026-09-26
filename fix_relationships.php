<?php
use TCG\Voyager\Models\DataRow;

$rows = DataRow::where('type', 'relationship')->get();

foreach ($rows as $row) {
    // details could be array/object because of casting
    $detailsJson = json_encode($row->details);
    if (strpos($row->field, 'product') !== false || strpos($detailsJson, 'products') !== false) {
        $details = (array) $row->details;
        echo "Row field: " . $row->field . "\n";
        if (isset($details['column']) && $details['column'] !== 'product_id') {
            echo "Before column: " . $details['column'] . "\n";
            $details['column'] = 'product_id';
            $row->details = $details;
            $row->save();
            echo "Fixed column for " . $row->field . "\n";
        }
    }
}
echo "Done.\n";
