<?php

namespace App\Login\Port;

interface LoginPort
{
    /**
     * ログインを実行
     * 成功時にidを返却
     * 失敗時に-1
     * @return int id
     */
    public function exec(string $login_id, string $password): int;
}