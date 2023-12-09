<?php

namespace Doctor\Front\Pages\Editor;

use Doctor\Front\Components\Alert;

class Editor {

    private $path;
    public function __construct() {
        $this->path = plugin_dir_url(__FILE__);
    }

    public function enqueueScripts() {
        wp_enqueue_script("doctor-editor", $this->path . "Editor.js", [], DOCTOR_VERSION, true);
    }

    public function loadAssetsAdmin() {
        add_action("admin_enqueue_scripts", [$this, "enqueueScripts"]);
    }

    public function loadAssetsClient() {
        // nothing to load
    }
    public function loadAssets()
    {
        if (is_admin()) {
            $this->loadAssetsAdmin();
        } else {
            $this->loadAssetsClient();
        }
    }
    public function init() {
        $this->loadAssets();
    }
}

$editor = new Editor();
$editor->init();