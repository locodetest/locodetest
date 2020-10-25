<?php
namespace App\Services;

class CsvParser {

    public function __construct() {
    }

    public function parse($filename, $rowCallback) {
        if (!is_callable($rowCallback)) {
            throw new \Exception("Not callable callback $rowCallback");
        }

        $skipFirstLine = false;
        $i = 0;

        $handle = fopen($filename, 'r');
        while (($row = fgetcsv($handle)) !== false) {
            if ($skipFirstLine) {
                $skipFirstLine = false;
                continue;
            }
            $row = mb_convert_encoding($row, "UTF-8", "ASCII");
            call_user_func($rowCallback, $row);

            $i++;
            if ($i > 200) break;
        }
    }
}
