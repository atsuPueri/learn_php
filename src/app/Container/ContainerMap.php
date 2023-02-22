<?php

/**
 * Containerで返される値のマッピングをするファイル
 */

$db_info = require __DIR__ . '/../../settings/db_info.php';
return [
    Controller\Top::class   => fn() => new Controller\Top(),
    Controller\Learn::class => fn() => new Controller\Learn(),
    Controller\Login::class => fn() => new Controller\Login(),
    \PDO::class             => fn() => new \PDO($db_info['dsn'], $db_info['user_name'], $db_info['password']),
];