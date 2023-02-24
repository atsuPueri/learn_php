<?php

namespace App\Project;

use App\Container\Container;
use PDO;
use PDOException;

class GetAll
{
    /**
     * Projectを全権取得
     */
    public function exec(string $user_id): array
    {
        $container = new Container();
        $project_list = [];

        try {
            /** @var PDO */
            $pdo = $container->get(PDO::class);
            $sql = 
            <<<SQL
            SELECT *
            FROM project
            WHERE user_id = :user_id
            SQL;

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            $project_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw $e;
        }

        return $project_list;
    }
}