<?php

/**
 * Containerで返される値のマッピングをするファイル
 */

$db_info = require __DIR__ . '/../../settings/db_info.php';
return [
    App\Login\UseCase\Login::class  => fn() => new App\Login\UseCase\Login(new App\Login\Adapter\LoginAdapter()),
    App\Login\UseCase\SignUp::class => fn() => new App\Login\UseCase\SignUp(new App\Login\Adapter\SignUpAdapter()),
    App\Project\GetAll::class       => fn() => new App\Project\GetAll(),
    App\Project\SaveProject::class  => fn() => new App\Project\SaveProject(),
    Controller\Free::class          => fn() => new Controller\Free(),
    Controller\Top::class           => fn() => new Controller\Top(),
    Controller\Learn::class         => fn() => new Controller\Learn(),
    Controller\Login::class         => fn() => new Controller\Login(),
    \PDO::class                     => function () use ($db_info) {
        $pdo = new \PDO($db_info['dsn'], $db_info['user_name'], $db_info['password']);
        
        // PDOExceptionを発生させるようにする
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    },

];