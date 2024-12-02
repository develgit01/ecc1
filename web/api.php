<?php
require 'controllers/ResourceController.php';

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$segments = explode('/', trim($request, '/'));

print_r($segments);

$tableName = $segments[0] ?? null;
$id = $segments[1] ?? null;

$response = false;

if ($tableName) {
    $controller = new ResourceController($tableName);
    switch ($method) {
        case 'GET':
            if (isset($id) && ctype_digit($id)) {
                $response = $controller->getResource($id);
            } else {
                $response = $controller->getResources();
            }
            break;
        case 'POST':
            $response = $controller->createResource();
            break;
        default:
            http_response_code(405);
            $response = json_encode(['message' => 'Method Not Allowed']);
            break;
    }
} else {
    http_response_code(404);
    $response = json_encode(['message' => 'Request: ' . $request . ', Method: ' . $method]);
}

echo json_encode($response);
