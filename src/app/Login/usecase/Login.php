<?php

namespace App\Login\UseCase;

use App\Login\Port\LoginPort;

class Login
{
    public function __construct(
        private LoginPort $port,
    ){}

    public function exec(string $login_id, string $password): int
    {
        return $this->port->exec($login_id, $password);
    }
}