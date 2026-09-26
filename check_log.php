<?php
$log = file_get_contents(__DIR__ . '/storage/logs/laravel.log');
$lines = explode("\n", $log);
for ($i = count($lines) - 1; $i >= 0; $i--) {
    if (strpos($lines[$i], 'type" on null') !== false) {
        for ($j = max(0, $i - 5); $j <= min(count($lines) - 1, $i + 15); $j++) {
            echo $lines[$j] . "\n";
        }
        break;
    }
}
