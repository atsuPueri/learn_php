<?php

use Controller\Top;
use Controller\Learn;

$request_path = require(__DIR__ . '/route.php');
$method = $_SERVER['REQUEST_METHOD'];

var_dump($request_path);
echo "<br>file:" . __FILE__;

return match ([$request_path, $method]) {
    ['/',      'GET']           => [Top::class, 'show'],
    ['/learn', 'GET']           => [Learn::class, 'show'],
    ['/learn/php_basic', 'GET'] => [Learn::class, 'php_basic'],
    default => '404',
};