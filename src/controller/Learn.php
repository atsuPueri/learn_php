<?php

namespace Controller;
use function Util\view;

class Learn extends Controller
{
    public function show() {
        view('learn_top.html', [
            'learn_list' => [
                'PHPの基本を学ぼう' => [
                    'php_basic' => 'PHPの基本',
                    'php_while' => '繰り返し表示してみよう',
                ],
                'TEST' => [
                    '0' => '小タイトル１'
                ]
                
            ],
        ]);
    }

    public function php_basic() {
        $arr = require __DIR__ . '/../app/learn/message/php_basic.php';
        $title   = $arr['title'];
        $message = $arr['message'];
        $success = $arr['success_message'];
        $next    = $arr['next_path'];

        view('learn.html', [
            'title'      => $title,
            'message'    => $message,
            'success'    => $success,
            'next'       => $next,
            'dir_info'   => [
                'index.php' => "<?php\necho 'hello world';"
            ],
        ]);
    }

    public function php_basic_exec()
    {
        // sampleのどれかに一致すればOK
        $sample  = [
            __DIR__ . '/../app/learn/sample/php_basic.php',
        ];
        $error = $this->learn_exec($sample);
        echo json_encode($error);
    }

    public function require()
    {
        $arr = require __DIR__ . '/../app/learn/message/require.php';
        $title   = $arr['title'];
        $message = $arr['message'];
        $success = $arr['success_message'];
        $next    = $arr['next_path'];

        view('learn.html', [
            'title'      => $title,
            'message'    => $message,
            'success'    => $success,
            'next'       => $next,
            'dir_info'   => [
                'index.php' => 
                <<<PHP
                <html>
                    <?php require './head.html'; ?>
                    <body>
                        <h1>Hello</h1>
                    </body>
                </html>
                PHP,

                'head.html' =>
                <<<HEAD
                <head>
                    <link rel="stylesheet" href="./css/style.css">
                <head>
                HEAD,

                'css' => [
                    'style.css' =>
                    <<<CSS
                    h1 {
                        color: red;
                    }
                    CSS,
                ]
            ],
        ]);
    }
}