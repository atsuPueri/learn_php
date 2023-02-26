window.addEventListener('load', () => {
    const save_button = document.getElementById('save_button');
    
    const file_HTMLColection = document.getElementsByClassName('file');

    save_button.addEventListener('click', () => {
        
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
        send_data.append('user_id', document.getElementById('user_id').dataset.user_id);
        send_data.append('project_name', document.getElementById('project_name').textContent);


        fetch(window.location.pathname + '/../update', {
            method: 'POST',
            body:   send_data,
        })
        .then(r => r.text())
        .then(r => {
            console.log(r);
        });


        window.location.href = window.location.pathname + '/../';
    });
});