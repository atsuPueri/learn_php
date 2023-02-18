<?php

return [
    "title"   => "requireで他のhtmlを読み込みましょう",
    "message" => 
    <<<MESSAGE
    <h2>ここではrequireの利用方法を紹介します</h2>
    <p>
    requireは他のファイルを読み込み、評価します。<br>
    共通パーツを一つ作れば複数のページで同じ結果を表示することができるようになります、こうすることで変更があった際にも１つ編集すれば他のページも一気に変更できるようになります。<br>
    下記のコードを確認し、動かしてみましょう。
    </p>
    MESSAGE,

    "success_message" =>
    <<<SUCCESS_MESSAGE
    <h2>上手く表示できましたね！</h2><br>
    <p>この様にHTMLを読み込むことができます、今回は&lt;head&gt;を読み込みましたが他にも&lt;nav&gt;や&lt;footer&gt;などを読み込むことがよくあります</p>
    SUCCESS_MESSAGE,

    "next_path" => "./while",
];