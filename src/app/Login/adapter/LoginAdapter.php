<?php

namespace App\Login\Adapter;

use App\Container\Container;
use App\Login\Port\LoginPort;
use PDO;
use PDOException;

class LoginAdapter implements LoginPort
{
    public function exec(string $login_id, string $password): int
    {
        $sql = 
        <<<SQL
        SELECT *
        FROM user
        WHERE login_id = :login_id
        SQL;

        $container = new Container();
    
        $id = -1;
        try {
            /** @var PDO */
            $pdo = $container->get(PDO::class);
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':login_id', $login_id, PDO::PARAM_STR);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (($row['hash_password'] ?? '') === '') {
                return -1;
            }

            $is_equal = password_verify($password, $row['hash_password']);
            if ($is_equal) {
                $id = $row['id'];
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            throw $e;
        }
        
        return $id;
    }
}