<?php

$dsn = "mysql:";

// データベースサーバーが存在するホスト名
$host = "192.168.45.4";
$dsn .= "host={$host};";

// データベースサーバーが待機しているポート
$port = "3306";
$dsn .= "port={$port};";

// データベース名
$dbname = "Nt32";
$dsn .= "dbname={$dbname};";

// 文字セット
$charset = "utf8";
$dsn .= "charset={$charset};";

return [
    'dsn'       => $dsn,
    'user_name' => 'root',
    'password'  => '',
];