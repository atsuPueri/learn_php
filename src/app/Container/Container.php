<?php

namespace App\Container;

use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    
    public function get(string $id)
    {
        $map = require(__DIR__ . '/ContainerMap.php');
        return $map[$id]();
    }
    
    public function has(string $id): bool
    {
        $map = require(__DIR__ . '/ContainerMap.php');
        $isset = isset($map[$id]);
        return $isset;
    }
}