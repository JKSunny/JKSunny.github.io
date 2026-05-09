<?php

header('Content-Type: application/json');

$file = __DIR__ . '/metrics.json';

if (!file_exists($file)) {

    http_response_code(503);

    echo json_encode([
        "error" => "metrics.json not generated yet"
    ]);

    exit;
}

readfile($file);