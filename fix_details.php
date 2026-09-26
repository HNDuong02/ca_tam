<?php
use Illuminate\Support\Facades\DB;
$dataType = TCG\Voyager\Models\DataType::where('name', 'quotes')->first();
if($dataType) {
    $rows = DB::table('data_rows')->where('data_type_id', $dataType->id)->get();
    foreach($rows as $row) {
        $decoded = json_decode($row->details, true);
        if(is_string($decoded)) {
            DB::table('data_rows')->where('id', $row->id)->update(['details' => $decoded]);
        }
    }
    echo "Fixed details column.\n";
}
