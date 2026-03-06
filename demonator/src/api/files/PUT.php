<?php
    $app_index = $payload['app'];
    $file_index = $payload['file'];
    $content = $payload['content'];

    $file = $apps[$app_index]['files'][$file_index]['path'];

    if (file_exists($file)) {
        file_put_contents($file, $content);
        echo json_encode([
            'message' => 'File updated successfully',
            'status' => 0
        ]);
    } else {
        echo json_encode([
            'message' => 'File not found',
            'status' => 1
        ]);
    }
?>