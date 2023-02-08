<?php

use App\Container;
use Util\Util;

require(__DIR__ . '/util/view.php'); // autoloadで読み込めない
require (__DIR__ . '/vendor/autoload.php');
$web = require_once(__DIR__ . '/route/web.php');

$container = new Container();

if ($container->has($web[0])) {
    $get = $container->get($web[0]);
    $web[0] = $get();
    $web();
} else {
    echo "error";
}
