<?php

use Controller\Top;
use Controller\Learn;

$request_path = require(__DIR__ . '/route.php');
$method = $_SERVER['REQUEST_METHOD'];

return match ([$request_path, $method]) {
    ['/',      'GET']            => [Top::class, 'show'],
    ['/learn', 'GET']            => [Learn::class, 'show'],
    ['/learn/php_basic', 'GET']  => [Learn::class, 'php_basic'],
    ['/learn/php_basic', 'POST'] => [Learn::class, 'php_basic_exec'],
    default => '404',
};