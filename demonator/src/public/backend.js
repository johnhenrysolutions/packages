let currentAppIndex = null;
let currentFileIndex = null;

const loadFile = (appIndex, fileIndex) => {

    const resetButton = document.getElementById('reset');
    const saveButton = document.getElementById('save');

    const enableEdit = () => {
        resetButton.disabled = false;
        saveButton.disabled = false;
        saveButton.classList.add('blue');
        saveButton.classList.remove('red');
        saveButton.classList.remove('green');
        editor.updateOptions({ readOnly: false });
    }

    const disableEdit = () => {
        resetButton.disabled = true;
        saveButton.disabled = true;
        saveButton.classList.add('blue');
        saveButton.classList.remove('red');
        saveButton.classList.remove('green');
        editor.updateOptions({ readOnly: true });
    }

    fetch('/api/files', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            app: appIndex,
            file: fileIndex
        })
    })
        .then(response => response.json())
        .then(data => {

            disableEdit();

            setTimeout(() => {
                
                if (data['status'] !== 0) {
                    editor.setValue('');
                    disableEdit();

                    setTimeout(() => {
                        alert('Error loading file content: ' + data['message']);
                    }, 500);

                    return;
                }

                currentAppIndex = appIndex;
                currentFileIndex = fileIndex;
                enableEdit();
                editor.setValue(data['content']);

            }, 500);
            
        }).catch((error) => {
            editor.setValue('');
            disableEdit();

            setTimeout(() => {
                alert('Error loading file content');
            }, 500);

        });

};

const doResetFile = () => {

    if (currentAppIndex === null || currentFileIndex === null) {
        alert('Please load a file before resetting');
        return;
    }

    loadFile(currentAppIndex, currentFileIndex);
};

const doSaveFile = () => {

    if (currentAppIndex === null || currentFileIndex === null) {
        alert('Please load a file before saving');
        return;
    }

    saveFile(currentAppIndex, currentFileIndex, editor.getValue());
};

const saveFile = (appIndex, fileIndex, content) => {

    const saveButton = document.getElementById('save');

    const enableEdit = () => {
        saveButton.disabled = false;
        saveButton.classList.add('blue');
        saveButton.classList.remove('red');
        saveButton.classList.remove('green');
        editor.updateOptions({ readOnly: false });
    }
    
    const successEdit = () => {
        enableEdit();
        saveButton.classList.remove('blue');
        saveButton.classList.remove('red');
        saveButton.classList.add('green');
    }

    const errorEdit = () => {
        enableEdit();
        saveButton.classList.remove('blue');
        saveButton.classList.remove('green');
        saveButton.classList.add('red');
    }

    const disableEdit = () => {
        saveButton.disabled = true;
        saveButton.classList.remove('blue');
        saveButton.classList.remove('red');
        saveButton.classList.remove('green');
        editor.updateOptions({ readOnly: true });
    }

    fetch('/api/files', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            app: appIndex,
            file: fileIndex,
            content: content
        })
    })
        .then(response => response.json())
        .then(data => {
            disableEdit();

            setTimeout(() => {
                successEdit();
            }, 500);
            
        }).catch((error) => {
            editor.updateOptions({ readOnly: true });
            errorEdit();

            setTimeout(() => {
                alert('Error saving file content');
            }, 500);

        });

};

const executeCommand = (appIndex, commandIndex) => {

    const button = document.getElementById(`commandbutton-${appIndex}-${commandIndex}`);

    const setLoadingState = () => {
        button.classList.remove('blue');
        button.classList.remove('red');
        button.classList.remove('green');
        button.disabled = true;
    }

    const setErrorState = () => {
        button.classList.remove('blue');
        button.classList.add('red');
        button.classList.remove('green');
        button.disabled = false;
    }

    const setSuccessState = () => {
        button.classList.remove('blue');
        button.classList.remove('red');
        button.classList.add('green');
        button.disabled = false;
    }


    setLoadingState();

    setTimeout(() => {

        fetch('/api/commands', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                app: appIndex,
                command: commandIndex
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data['status'] === 0) {
                    setSuccessState();
                } else {
                    setErrorState();
                }
            }).catch((error) => {
                setErrorState();
            });

    }, 500);

}
