// 色変え動作
window.addEventListener('load', () => {
    const input_code  = document.getElementById('input_code');
    const view_code   = document.getElementById('view_code');
    const editor_form = document.getElementById('editor_form');

    // 初期動作
    hljs.highlightAll(view_code, editor_form);
    
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

// --------------------------------------------------------

/**
 * シンタックスハイライトを実行させる
 * @param {HTMLElement} view_code 
 * @param {HTMLFormElement} editor_form 
 */
function loadEditor(view_code, editor_form) {
    const data = new FormData(editor_form);
    view_code.textContent = data.get('input');
    hljs.highlightAll();
}

/**
 * 指定ファイルまでのパスを取得
 * @param {HTMLElement} file_element 
 * @returns 
 */
function get_file_path(file_element) {
    const folder = file_element.parentElement.parentElement;
    const p_HTMLColection = folder.getElementsByTagName('p');

    if (p_HTMLColection.length <= 0) {
        return "";
    }

    const folder_name = p_HTMLColection[0].textContent;

    if (folder.tagName !== 'LI') {
        return "";
    }

    return get_file_path(folder) + "/" + folder_name;
}

/**
 * 指定したファイルを開く
 */
function open_file(file) {

    const input_code = document.getElementById('input_code');
    
    // 現在のinputの内容を保存
    writeFile();
    
    // inputを選択したものに切り替え
    input_code.value = file.dataset.content;
    input_code.dataset.now_file = get_file_path(file) + '/' + file.textContent;
    loadEditor(view_code, editor_form);

    document.getElementById('play_file').textContent = input_code.dataset.now_file + 'を実行';
}

/**
 * 現在のinputの内容を保存
 */
function writeFile() {
    const input_code         = document.getElementById('input_code');
    const file_HTMLColection = document.getElementsByClassName('file');
    
    // 現在のinputの内容を保存
    const old_now_file = input_code.dataset.now_file;
    // 現在編集中のファイルを探索
    for (const file_element of file_HTMLColection) {

        const file_path = get_file_path(file_element) + '/' + file_element.textContent;
        
        if (old_now_file === file_path) {
            file_element.dataset.content = input_code.value;
            break;
        }
    }
}