<?php

namespace Doctor\Front\Components;

class Modal {
    private $path;
    public function __construct() {
        $this->path = plugin_dir_url(__FILE__);
    }

    public function enqueueScripts() {
        wp_enqueue_script(DOCTOR_SLUG . "-" . get_class(), $this->path . "Modal.js", [], DOCTOR_VERSION, true);
    }

    public function enqueueStyles() {
        wp_enqueue_style(DOCTOR_SLUG . "-" . get_class(), $this->path . "Modal.css", [], DOCTOR_VERSION);
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

    public static function render($title = "Doctor Otter", $message = "Doctor Otter is a plugin to help you improve your multilingual SEO.") {
        ?>
        <div class="doctor-modal">
            <div class="doctor-modal__overlay"></div>
            <div class="doctor-modal__content">
                <div class="doctor-modal__content-header">
                    <span class="doctor-modal__content-header-title"><?php echo $title; ?></span>
                    <span class="doctor-modal__content-header-close">X</span>
                </div>
                <div class="doctor-modal__content-body">
                    <div class="doctor-modal__content-body-text">
                        <?php echo $message; ?>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            initModalEvents();
        </script>
        <?php
    }
}

$modal = new Modal();
$modal->loadAssets();