window.addEventListener('load', ()=>{
    
    const file_HTMLColection   = document.getElementsByClassName('file');
    const folder_HTMLColection = document.getElementsByClassName('folder');
    const folders = document.getElementById('folders').getElementsByTagName('ul')[0];

    let cnt = document.getElementById('cnt').dataset.cnt;

    folders.addEventListener('contextmenu', menu_func);

    for (const file of file_HTMLColection) {
        file.addEventListener('contextmenu', menu_func);

    }
    for (const folder of folder_HTMLColection) {
        folder.addEventListener('contextmenu', menu_func)
    }

    function menu_func(e) {
        e.preventDefault();
        const menu = document.createElement('menu');
        menu.style.top  = (e.pageY - 30) + 'px';
        menu.style.left = (e.pageX - 10) + 'px';
        

        const create_file   = document.createElement('button');
        const create_folder = document.createElement('button');
        const rename_button = document.createElement('button');
        const delete_button = document.createElement('button');

        if (!e.target.classList.contains('file')) {
            create_file.textContent = '新しいファイル';
            menu.appendChild(create_file);

            create_folder.textContent = '新しいフォルダー'
            menu.appendChild(create_folder);
        }
        
        if (e.target.parentElement.id !== 'folders') {
            rename_button.textContent = '名前を変更';
            menu.appendChild(rename_button);

            delete_button.textContent = '削除';
            menu.appendChild(delete_button);
        }

        // 新しいファイル
        create_file.addEventListener('click', () => {
            const new_file = document.createElement('li');
            new_file.classList.add('file');
            new_file.dataset.content = '';
            
            const ul = e.target.parentElement.parentElement.getElementsByTagName('ul')[0];
            ul.appendChild(new_file);
            
            const input_name = document.createElement('input');
            input_name.type = 'text';
            input_name.style.border = 'solid 1px black';

            new_file.appendChild(input_name);
            
            input_name.addEventListener('blur', () => {
                if (input_name.value === '') {
                    new_file.remove();
                    return;
                }
                
                new_file.textContent = input_name.value;
                input_name.remove();
            });

            input_name.focus();
            menu.remove();
        });

        console.log(e.target);

        // フォルダ作成
        create_folder.addEventListener('click', () => {
            const new_folder = document.createElement('li');
            new_folder.innerHTML = 
            `<input type="checkbox" id="folder${cnt}">
            <label for="folder${cnt}">
            <p></p>
            </label>
            <ul></ul>`
            cnt++;
            const p = new_folder.getElementsByTagName('p')[0];
            const input_name = document.createElement('input');
            p.appendChild(input_name);

            const ul = e.target.parentElement.parentElement.getElementsByTagName('ul')[0];
            ul.appendChild(new_folder);

            input_name.addEventListener('blur', () => {
                if (input_name.value === '') {
                    new_folder.remove();
                    return;
                }
                p.textContent = input_name.value;
                input_name.remove();
            });

            input_name.focus();
            menu.remove();            
        });

        // 名前変更
        rename_button.addEventListener('click', () => {
            const name = e.target.textContent;

            const name_input = document.createElement('input');
            name_input.type = 'text';
            name_input.value = name;
            name_input.style.border = 'solid 1px black';

            e.target.textContent = '';
            e.target.appendChild(name_input);

            name_input.focus();
            
            // フォーカスが離れたら
            name_input.addEventListener('blur', () => {
                e.target.textContent = name_input.value;
                name_input.remove();
            });
            
            menu.remove();
        });

        // 削除ボタンが押されたら
        delete_button.addEventListener('click', () => {
            
            if (e.target.classList.contains('folder')) {
                e.target.parentElement.parentElement.innerHTML = '';
                e.target.parentElement.parentElement.remove();
            }
            e.target.remove();
            menu.remove();
        });

        // メニューから外れたら
        menu.addEventListener('pointerleave', () => {
            menu.remove();
        });

        document.getElementById('folders').appendChild(menu);
    }
});