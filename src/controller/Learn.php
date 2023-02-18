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
}