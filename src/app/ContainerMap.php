<?php

/**
 * Containerで返される値のマッピングをするファイル
 */


return [
    Controller\Top::class => fn() => new Controller\Top(),
];