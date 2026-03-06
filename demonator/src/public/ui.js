editor = null;
currentFileIndex = null;

const loadEditor = () => {
    require(['vs/editor/editor.main'], function () {
        editor = monaco.editor.create(document.getElementById('editor'));
        editor.updateOptions({ readOnly: true });

        window.addEventListener('resize', () => {
            editor.layout();
        });
    });

}

$(document).ready(function() {
      $('.menu .item').tab();
      loadEditor();
});
