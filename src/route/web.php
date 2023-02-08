<?php

use Controller\Top;

$request_path = require(__DIR__ . '/route.php');
$method = $_SERVER['REQUEST_METHOD'];

return match ([$request_path, $method]) {
    ['/', 'GET']       => [Top::class, 'show'],
    ['/user', 'GET']   => [User::class, 'show'],
    ['/login', 'GET']  => [Login::class, 'show'],
    ['/login', 'POST'] => [Login::class, 'login'],
    default => '404',
};