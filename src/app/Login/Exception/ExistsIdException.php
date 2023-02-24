<?php

namespace App\Login\Exception;

use Exception;

class ExistsIdException extends Exception
{
    public function __construct()
    {
        parent::__construct('既に存在するIDです');
    }
}