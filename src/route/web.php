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

    ['/learn/calc', 'GET']       => [Learn::class, 'calc'],
    ['/learn/calc', 'POST']      => [Learn::class, 'calc_exec'],

    ['/learn/while', 'GET']      => [Learn::class, 'while'],
    ['/learn/while', 'POST']     => [Learn::class, 'while_exec'],

    ['/learn/require', 'GET']    => [Learn::class, 'require'],
    ['/learn/require', 'POST']   => [Learn::class, 'require_exec'],

    
    default => '404',
};