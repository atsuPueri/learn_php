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
                'index.php' => "<?php\necho 'hello world';"
            ],
        ]);
    }

    public function php_basic_exec() {
        $sample  = [
            __DIR__ . '/../app/learn/sample/php_basic.php',
        ];
        
        $file_info_json = $_POST['files_info'];
        $now_file       = $_POST['now_file'];
        $file_info_array = json_decode($file_info_json, true);
        
        foreach ($file_info_array as $file_info) {
            $this->file_put_contents(__DIR__ . "/../public/storage" . $file_info['file_path'], $file_info['content']);
        }

        // エラー取得
        // 実際に出力はさせない為に
        ob_start();
        $error = [];
        try {
            require __DIR__ . "/../public/storage" . $now_file;
        } catch (\ParseError $e) {
            $error['line']    = $e->getLine();
            $error['message'] = $e->getMessage();
        } catch (\Error $e) {
            $error['line']    = $e->getLine();
            $error['message'] = $e->getMessage();
        } catch (\Exception $e) {
            $error['line']    = $e->getLine();
            $error['message'] = $e->getMessage();
        }
        ob_clean();
        echo json_encode($error);
    }
}