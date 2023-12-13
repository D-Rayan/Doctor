<?php

namespace Doctor\Front\Pages\Editor;

use Doctor\Languages\LanguageManager;

include "OnSave/OnSave.php";
class Editor {

    private $path;

    public function __construct() {
        $this->path = plugin_dir_url(__FILE__);
    }

    public function enqueueScripts() {
        wp_enqueue_script(DOCTOR_SLUG . "-" . get_class(), $this->path . "Editor.js", [], DOCTOR_VERSION, true);
        wp_localize_script(DOCTOR_SLUG . "-" . get_class(), "doctor", [
            "url" => admin_url("admin-ajax.php") . "?action=doctor_",
        ]);
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
    public function addCheckboxEnableDoctor()
    {
        $languageManager = new LanguageManager();
        try {
            $currentLanguage = $languageManager->getLanguageManager()->getCurrentLanguage();
        } catch (\Exception $e) {
            return;
        }
        $isDefaultChecked = get_option('WPLANG') === $currentLanguage;
        echo get_option('WPLANG');
        echo "<br/>";
        echo $currentLanguage;
        ?>
        <div style="display: flex; gap: 10px; flex-direction: row; align-items: center;">
            <label for="doctor–is-enable">Display Doctor After Save</label>
            <input type="checkbox" name="doctor–is-enable" id="doctor–is-enable" <?php if ($isDefaultChecked) { echo "checked"; } ?> />
        </div>
        <?php
    }

    public function loadHooks() {

    }

    public function loadAdminHooks() {
        add_action( 'post_submitbox_start', [$this, "addCheckboxEnableDoctor"] );
    }

    public function loadClientHooks() {
        // nothing here
    }
    public function init() {
        $this->loadAssets();
        $this->loadAdminHooks();
    }
}

$editor = new Editor();
$editor->init();