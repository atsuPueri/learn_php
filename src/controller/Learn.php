<?php

namespace Controller;
use function Util\view;

class Learn extends Controller
{
    public function show() {
        view('learn_top.html', [
            'learn_list' => [
                'php_basic' => 'PHPの基本'
            ],
        ]);
    }

    public function php_basic() {
        $arr = require __DIR__ . '/../app/learn/message/php_basic.php';
        $title   = $arr['title'];
        $message = $arr['message'];

        view('learn.html', [
            'title'      => $title,
            'message'    => $message,
            'dir_info'   => [
                "TEST" => [
                    "TEST" => [
                        "TEST" => [
                            "A.php" => ""
                        ]
                    ]
                ],
                'index.php' => "<?php\necho 'hello world';"
            ],
        ]);
    }

    public function php_basic_exec() {
        $arr = require __DIR__ . '/../app/learn/message/php_basic.php';
        $title   = $arr['title'];
        $message = $arr['message'];
        $sample  = [
            __DIR__ . '/../app/learn/sample/php_basic.php',
        ];

        view('learn.html', [
            'title'      => $title,
            'message'    => $message,
            'dir_info'   => [

            ],
        ]);
    }
}