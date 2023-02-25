
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