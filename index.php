<?php

header("Content-Type: application/json");

$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$resource = array_shift($request);
$method = $_SERVER['REQUEST_METHOD'];

include 'db.php';

switch ($resource) {
    case 'paesi':
        include 'api/paesi.php';
        break;
    case 'viaggi':
        include 'api/viaggi.php';
        break;
    default:
        http_response_code(404);
        echo json_encode(["message" => "Risorsa non trovata"]);
        break;
}

?>
