<?php

namespace Doctor\Front\Components;

class Alert {
    private $path;
    public function __construct() {
        $this->path = plugin_dir_url(__FILE__);
    }

    public function enqueueScripts() {
        wp_enqueue_script("doctor-alert", $this->path . "Alert.js", [], DOCTOR_VERSION, true);
    }

    public function enqueueStyles() {
        wp_enqueue_style("doctor-alert", $this->path . "Alert.css", [], DOCTOR_VERSION);
    }

    public function loadAssetsAdmin() {
        add_action("admin_enqueue_scripts", [$this, "enqueueScripts"]);
        add_action("admin_enqueue_scripts", [$this, "enqueueStyles"]);
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

    public static function render($title, $message, $type) {
        ?>
        <div class="notice doctor-alert doctor-alert-<?php echo $type; ?>">
            <div class="doctor-alert__title">
                <span class="doctor-alert__title-text"><?php echo $title; ?></span>
                <span class="doctor-alert__title-close">X</span>
            </div>
            <div class="doctor-alert__body">
                <?php echo $message; ?>
            </div>
        </div>
        <?php
    }
}

$alert = new Alert();
$alert->loadAssets();