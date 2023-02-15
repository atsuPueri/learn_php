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
        $sample  = 

        view('learn.html', [
            'title'      => $title,
            'message'    => $message,
            'php_sample' => $sample,
        ]);
    }
}