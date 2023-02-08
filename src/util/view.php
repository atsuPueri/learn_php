<?php

namespace Util;

/**
 * @param string $file_path
 */
function view(string $file_path)
{
    $path = require(__DIR__ . '/../settings/path.php');
    $view_path = $path['view_path'];
    
    $open_path = $view_path . $file_path;

    $fp = fopen($open_path, 'r');
    while (! feof($fp)) {
        echo fgets($fp, 4);
    }
}
