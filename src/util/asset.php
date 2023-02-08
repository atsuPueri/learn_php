<?php

namespace Util;

/**
 * パブリックフォルダまでのパスを返す関数
 */
function asset(string $url) {
    $domain_name = require(__DIR__ . "/../settings/path.php")["domain_name"];
    $public_path = $domain_name;
    echo urlencode($public_path . $url);
}
