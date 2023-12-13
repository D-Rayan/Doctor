if (window && window.wp && window.wp.data && window.wp.data.dispatch('core/editor')) {
    const editor = window.wp.data.dispatch('core/editor')
    const savePost = editor.savePost
    editor.savePost = function (options) {
        options = options || {}

        return savePost(options)
            .then(() => {
                if (!options.isAutosave) {
                    loadModalDoctor();
                }
            })
    }
} else if (document.querySelector("#message.updated")) {
    loadModalDoctor();
}


async function loadModalDoctor() {
    const fetchResponse = await fetch(`${doctor.url}editor_onSave_render`);
    const data = await fetchResponse.text();
    const div = document.createElement('div');
    div.innerHTML = data;
    document.body.appendChild(div);
}