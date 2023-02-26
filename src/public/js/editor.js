// 色変え動作
window.addEventListener('load', () => {
    const input_code  = document.getElementById('input_code');
    const view_code   = document.getElementById('view_code');
    const editor_form = document.getElementById('editor_form');

    // 初期動作
    // hljs.highlightAll(view_code, editor_form); // todo loadEditor(view_code, editor_form)
    
    loadEditor(view_code, editor_form);
    
    // 入力時
    input_code.addEventListener('input', e => {
        loadEditor(view_code, editor_form);
    });

    // スクロールした時に表示も移動
    input_code.addEventListener('scroll', e => {
        view_code.scrollTop = e.target.scrollTop;
    });

    // windowサイズ変更時
    window.addEventListener('resize', e => {
        loadEditor(view_code, editor_form);
    });
});

// ファイル選択動作
window.addEventListener('load', () => {
    const input_code  = document.getElementById('input_code');
    const view_code   = document.getElementById('view_code');
    const editor_form = document.getElementById('editor_form');

    const file_HTMLColection = document.getElementsByClassName('file');

    for (const file_element of file_HTMLColection) {

        if (get_file_path(file_element) + '/' + file_element.textContent === "/index.php") {
            open_file(file_element);
        }

        // クリックされたらinputの表示切替
        file_element.addEventListener('click', e => {
            open_file(e.target);
        });
    }
});

// PHPとの通信関係
window.addEventListener('load', () => {
    const play               = document.getElementById('play');
    const play_button        = play.getElementsByTagName('button')[0];
    const file_HTMLColection = document.getElementsByClassName('file');

    play_button.addEventListener('click', () => {
        
        const input_code = document.getElementById('input_code');
        writeFile();
        const files_info = [];
        for (const file_element of file_HTMLColection) {
            const file_path = get_file_path(file_element) + '/' + file_element.textContent;
            files_info.push({
                file_path: file_path,
                content:   file_element.dataset.content,
            });
        }

        const send_data = new FormData();
        send_data.append('files_info', JSON.stringify(files_info));
        send_data.append('now_file', input_code.dataset.now_file);


        fetch(window.location.href, {
            method: 'POST',
            body:   send_data,
        })
        .then(r => r.text())
        .then(r => {
            // 実行後にsrcに結果を反映
            const result_code = document.getElementById('result_code');
            result_code.src = window.location.href + '/../../public/storage/learn' + input_code.dataset.now_file;

            const error = JSON.parse(r);
            const error_element = document.getElementById('error');

            error_element.addEventListener('click', e => {
                e.target.style.display = 'none';
            });
            
            if (error.line !== undefined) {
                error_element.style.display = 'block';
                error_element.style.top     = (error.line * 16) + 'px';
                error_element.textContent = error.message;
            } else {
                error_element.style.display = 'none';

                // エラーが起きずにサンプルが問題なければ
                if (error.is_sample_ok === true) {
                    const success = document.getElementById('success');
                    success.style.display = 'block';
                }
            }
        });
    });
});
