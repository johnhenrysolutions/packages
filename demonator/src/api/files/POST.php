<?php
    $app_index = $payload['app'];
    $file_index = $payload['file'];

    $file = $apps[$app_index]['files'][$file_index]['path'];

    if (file_exists($file)) {
        $content = file_get_contents($file);
        echo json_encode([
            'message' => 'File retrieved successfully',
            'status' => 0,
            'content' => $content
        ]);
    } else {
        echo json_encode([
            'message' => 'File not found',
            'status' => 1
        ]);
    }
?>