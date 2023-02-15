<?php

namespace Util;

/**
 * @param string $file_path
 */
function view(string $file_path, array $aso_array = [])
{
    $path = require(__DIR__ . '/../settings/path.php');
    $view_path = $path['view_path'];

    unset($path);
    $open_path = $view_path . $file_path;

    unset($view_path, $file_path);

    foreach ($aso_array as $key => $val) {
        $$key = $val;
    }

    require $open_path;
}
