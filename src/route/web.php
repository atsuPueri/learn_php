<?php

use Controller\Top;
use Controller\Learn;
use Controller\Login;
use Controller\Free;

$request_path = require(__DIR__ . '/route.php');
$method = $_SERVER['REQUEST_METHOD'];

return match ([$request_path, $method]) {
    ['/',      'GET']            => [Top::class,   'show'],
    ['/learn', 'GET']            => [Learn::class, 'show'],
    
    ['/learn/php_basic', 'GET']  => [Learn::class, 'php_basic'],
    ['/learn/php_basic', 'POST'] => [Learn::class, 'php_basic_exec'],

    ['/learn/calc', 'GET']       => [Learn::class, 'calc'],
    ['/learn/calc', 'POST']      => [Learn::class, 'calc_exec'],

    ['/learn/while', 'GET']      => [Learn::class, 'while'],
    ['/learn/while', 'POST']     => [Learn::class, 'while_exec'],

    ['/learn/require', 'GET']    => [Learn::class, 'require'],
    ['/learn/require', 'POST']   => [Learn::class, 'require_exec'],

    ['/free', 'GET']             => [Free::class, 'show_top'],
    ['/free/newProject', 'GET']       => [Free::class, 'new_project'],
    ['/free/newProject', 'POST']       => [Free::class, 'new_project_exec'],
    ['/free/save', 'POST']       => [Free::class, 'save'],


    ['/login', 'GET']           => [Login::class, 'login'],
    ['/login', 'POST']          => [Login::class, 'login_exec'],
    
    ['/sign_up', 'GET']         => [Login::class, 'sign_up'],
    ['/sign_up', 'POST']        => [Login::class, 'sign_up_exec'],
    default => '404',
};