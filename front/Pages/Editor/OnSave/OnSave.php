<?php

namespace Doctor\Front\Pages\Editor\OnSave;

use Doctor\Front\Components\Modal;

class OnSave {

    private $path;
    public function __construct() {
        $this->path = plugin_dir_url(__FILE__);
    }

    public function enqueueScripts() {
        wp_enqueue_script(DOCTOR_SLUG . "-" . get_class(), $this->path . "OnSave.js", [], DOCTOR_VERSION, true);
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

    public function loadHooksAdmin() {
        add_action("wp_ajax_doctor_editor_onSave_render", [$this, "render"]);
    }

    public function render() {
        Modal::render("Doctor Otter", "");
    }

    public function loadHooksClient() {
        // nothing to load
    }

    public function loadHooks() {
        if (is_admin()) {
            $this->loadHooksAdmin();
        } else {
            $this->loadHooksClient();
        }
    }
    public function init() {
        $this->loadAssets();
        $this->loadHooks();
    }
}

$onSave = new OnSave();
$onSave->init();