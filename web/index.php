<?php

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

print_r($request, $method);

require './App/system/autoload.php';
require './App/system/api.php';
