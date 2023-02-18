<?php

return [
    "title"   => "PHPの基礎",
    "message" => 
    <<<MESSAGE
    <h2>この章では、PHPで何ができるかを知りましょう</h2>
    <p>
    PHPはHTMLを生成する事に特化したプログラミング言語です、HTML等については分からない時はMDNの<a href="https://developer.mozilla.org/ja/docs/Web/Tutorials">ウェブ開発者向けチュートリアル</a>やプロゲートの<a href="https://prog-8.com/lessons/html/study/1">HTML & CSS</a>等を利用してください。<br>
    PHPでは基本的に出力したものがHTMLとして出力されます、試しに以下のコードを実行し、結果を確認してみましょう。<br>
    実行するには右の▶ボタンを押してください。
    </p>
    MESSAGE,

    "success_message" => <<<SUCCESS_MESSAGE
    <h2>上手く表示できましたね！</h2><br>
    <p>この`echo`というモノの後に「'」「"」のいずれかで囲った文字列がHTMLとして出力されます</p>
    SUCCESS_MESSAGE,

    "next_path" => "./require",
];