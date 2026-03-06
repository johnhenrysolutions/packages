<?php
    $app_index = $payload['app'];
    $command_index = $payload['command'];

    $command = $apps[$app_index]['commands'][$command_index]['command'];

    $output=null;
    $retval=null;
    exec($command, $output, $retval);
    
    $message = 'Command ' . ($retval === 0 ? 'executed successfully' : 'failed');

    echo json_encode([
        'message' => $message,
        'status' => $retval
    ]);
?>