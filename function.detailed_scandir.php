<?php

function detailed_scandir($directory, $detailed = false) {
    $result = [];

    $directory = $directory;
    $scan = scandir($directory);
    $scannedDir = array_splice($scan, 2);

    foreach ($scannedDir as $key => $value) {
        $resultArr = [];

        $path = $value;
        $fullPath = $directory . '/' . $value;
        $isDir = is_dir($fullPath) ? true : false;
        $isFile = is_file($fullPath) ? true : false;

        if ($isDir && !$isFile) {
            foreach (detailed_scandir($fullPath, $detailed) as $key2 => $value2) {
                $result[] = $value2;
            }
        } else {
            if ($detailed) {
                $resultArr['is_dir'] = $isDir;
                $resultArr['is_path'] = $isDir;
                $resultArr['path'] = str_replace('//', '/', $fullPath);
                $resultArr['filename'] = str_replace('//', '/', $path);

                $result[] = $resultArr;
            } else {
                $result[] = str_replace('//', '/', $fullPath);
            }
        }
    }

    return $result;
}

?>
