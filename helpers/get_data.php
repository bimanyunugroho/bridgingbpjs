<?php

$dataFiles = glob('temp/*.json');
$data = [];
foreach ($dataFiles as $file) {
    $data[] = [
        'filename' => basename($file),
        'content' => json_decode(file_get_contents($file), true)
    ];
}
echo json_encode($data);

?>