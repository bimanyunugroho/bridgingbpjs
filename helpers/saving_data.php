<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $nama_service = $data['service'];

    if (!empty($data)) {
        $filename = 'temp/' . $nama_service . '_' . time() . '.json';
        if (!file_exists('temp')) {
            mkdir('temp', 0777, true);
        }
        file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
        echo json_encode(['status' => 'success', 'message' => 'Data saved successfully', 'filename' => $filename]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No data received']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
