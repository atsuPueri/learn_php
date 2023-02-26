<?php

namespace App\Project;

use App\Container\Container;
use PDO;

class SaveProject
{
    public function exec(int $user_id, string $project_name)
    {
        $container = new Container();

        $sql = 
        <<<SQL
        INSERT INTO project
        (user_id, name)
        VALUE (:user_id, :project_name)
        SQL;

        /** @var \PDO */
        $pdo = $container->get(PDO::class);

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':user_id',      $user_id,  PDO::PARAM_INT);
        $stmt->bindValue(':project_name', $project_name, PDO::PARAM_STR);
        $stmt->execute();
    }
}