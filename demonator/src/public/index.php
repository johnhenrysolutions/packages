<?php
  include '../app/auth.php';
  $config = json_decode(file_get_contents('../config.json'), true);
  $apps = $config['apps'];

  $path = $_SERVER['REQUEST_URI'];
  $url = explode('/', $path);

  if ($path === '/') {
      header("Location: /?app=0");
      exit();
  } else if ($url[0] === '' && count($url) === 2) {
      include '../app/home.php';
      exit();

  } else {
    
    $api_path = $url[1];
    $resource_path = $url[2];

    if ($api_path === 'api') {

        header("Content-Type: application/json");

        $method = $_SERVER['REQUEST_METHOD'];
        $payload = json_decode(file_get_contents('php://input'), true);

        if (file_exists('../api/' . $resource_path . '/' . $method . '.php')) {
            include '../api/' . $resource_path . '/' . $method . '.php';
            exit();
        } else {
            echo json_encode(['message' => 'Invalid JSON payload.']);
            exit();
        }

    }

  }
?>