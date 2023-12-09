if (window && window.wp && window.wp.data && window.wp.data.dispatch('core/editor')) {
    const editor = window.wp.data.dispatch('core/editor')
    const savePost = editor.savePost
    editor.savePost = function (options) {
        options = options || {}

        return savePost(options)
            .then(() => {
                if (!options.isAutosave) {
                    showModalDoctor();
                }
            })
    }
} else if (document.querySelector("#message.updated")) {
    showModalDoctor();
}


function showModalDoctor() {

}