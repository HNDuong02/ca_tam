<?php
$rows = TCG\Voyager\Models\DataRow::whereIn('data_type_id', [9, 10])->get();
foreach($rows as $r) {
    if(is_string($r->details)) {
        if ($r->details === '{}') {
            $r->details = null;
        } else {
            $r->details = json_decode($r->details, true);
        }
        $r->save();
    }
}
echo "Fixed";
