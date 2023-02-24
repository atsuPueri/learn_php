<?php

namespace App\Login\UseCase;

use App\Login\Port\SignUpPort;

class SignUp
{
    public function __construct(
        private SignUpPort $port
    ){}

    public function exec(string $user_name, string $login_id, string $password)
    {
        $this->port->exec($user_name, $login_id, $password);
    }
}