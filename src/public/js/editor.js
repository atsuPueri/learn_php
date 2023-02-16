// 色変え動作
window.addEventListener('load', () => {
    const input_code = document.getElementById('input_code');
    const view_code = document.getElementById('view_code');
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
    const input_code = document.getElementById('input_code');
    const view_code = document.getElementById('view_code');
    const editor_form = document.getElementById('editor_form');

    const file_HTMLColection = document.getElementsByClassName('file');

    for (const file_element of file_HTMLColection) {
        // クリックされたらinputの表示切替
        file_element.addEventListener('click', e => {
            open_file(e.target);
        });
    }
});

// シンタックスハイライトを実行させる
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
    const file_HTMLColection = document.getElementsByClassName('file');
    
    // 現在のinputの内容を保存
    const old_nowFile = input_code.dataset.nowFile;
    // 現在編集中のファイルを探索
    for (const file_element of file_HTMLColection) {

        const file_path = get_file_path(file_element) + '/' + file_element.textContent;
        
        if (old_nowFile === file_path) {
            file_element.dataset.content = input_code.value;
            break;
        }
    }
    
    // inputを選択したものに切り替え
    input_code.value = file.dataset.content;
    input_code.dataset.nowFile = get_file_path(file) + '/' + file.textContent;
    loadEditor(view_code, editor_form);
}