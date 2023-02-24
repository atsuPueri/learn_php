<?php

namespace App\Login\Adapter;

use App\Container\Container;
use App\Login\Exception\ExistsIdException;
use App\Login\Port\SignUpPort;
use PDO;
use PDOException;

class SignUpAdapter implements SignUpPort
{
    public function exec(string $login_id, string $password, string $user_name)
    {
        $container = new Container();

        try {
            /** @var PDO */
            $pdo = $container->get(PDO::class);

            $sql =
            <<<SQL
            SELECT COUNT(*) as count
            FROM user
            WHERE login_id = :login_id
            SQL;

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':login_id', $login_id, PDO::PARAM_STR);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($row['count'] !== 0) {
                throw new ExistsIdException();
            }
            
            
            $sql = 
            <<<SQL
            INSERT INTO user
            (login_id, user_name, hash_password)
            VALUE (:login_id, :name, :hash);
            SQL;


            $hash_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':login_id', $login_id,      PDO::PARAM_STR);
            $stmt->bindValue(':name',     $user_name,     PDO::PARAM_STR);
            $stmt->bindValue(':hash',     $hash_password, PDO::PARAM_STR);
            $stmt->execute();
            
        } catch (PDOException $e) {
            throw $e;
        }
    }
}