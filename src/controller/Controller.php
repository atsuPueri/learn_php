<?php

namespace Controller;

class Controller
{
    /**
     * 保存ファイルのパス
     * @param string $file_path フルパスを書く
     * @param string $content 書き込む内容
     */
    protected function file_put_contents(string $file_path, string $content)
    {

        $explode = explode("/", $file_path);
        unset($explode[count($explode) - 1]);

        $check_path = "";
        foreach ($explode as $val) {
            $check_path .= $val . "/";

            echo "<BR>", __DIR__ . "/" . $check_path, "<BR>";
            if (!file_exists(__DIR__ . "/" . $check_path)) {
                mkdir($check_path);
            }
        }

        file_put_contents(__DIR__ . $file_path, $content);
    }

