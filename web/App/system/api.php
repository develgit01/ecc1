<?php
use App\Controllers\ResourceController;

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

print_r($request, $method);

$segments = explode('/', trim($request, '/'));
$tableName = $segments[2] ?? null;
$id = $segments[3] ?? null;

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
    $response = json_encode(['message' => 'Not Found']);
}

echo json_encode($response);
