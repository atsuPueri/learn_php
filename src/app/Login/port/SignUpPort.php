<?php

namespace App\Login\Port;

interface SignUpPort
{
    public function exec(string $login_id, string $password, string $user_name);
}