<?php

/**
 * Plugin Name: Doctor Otter
 * Plugin URI: https://www.seo-sans-migraine.fr/doctor-otter
 * Description: Doctor is a plugin to help you improve your multilingual SEO.
 * Version: 0.0.1
 * Author: Seo Sans Migraine
 * Author URI: https://www.seo-sans-migraine.fr
 * License: GPL2
 */


if (!defined("ABSPATH")) {
    exit;
}

define("DOCTOR_PHP_REQUIREMENT", "7.0");
define("DOCTOR_NAME", "Doctor Otter");
define("DOCTOR_SLUG", "doctor-otter");
define("DOCTOR_TEXT_DOMAIN", "doctor-otter");
define("DOCTOR_ABSOLUTE_PATH", __DIR__);
define("DOCTOR_RELATIVE_PATH", plugin_dir_url(__FILE__));
define("DOCTOR_VERSION", "0.0.2");

require_once DOCTOR_ABSOLUTE_PATH . "/includes/Settings.php";
class Doctor {

    private $settings;
    public function __construct() {
        $this->settings = new Doctor\Settings();
        $this->init();
    }

    public function checkRequirements() {
        if (!$this->settings->checkRequirements()) {
            deactivate_plugins( plugin_basename( __FILE__ ) );
            if ( isset( $_GET['activate'] ) ) {
                unset( $_GET['activate'] );
            }
        }
    }

    public function loadComponents() {
        require_once DOCTOR_ABSOLUTE_PATH . "/front/Components/autoload.php";
    }

    public function loadPages() {
        require_once DOCTOR_ABSOLUTE_PATH . "/front/Pages/autoload.php";
    }

    public function loadTextDomain() {
        load_plugin_textdomain(DOCTOR_TEXT_DOMAIN, false, DOCTOR_RELATIVE_PATH . "/languages");
    }

    public function init() {
        $this->loadTextDomain();
        $this->loadComponents();
        $this->loadPages();
        add_action("admin_init", [$this, "checkRequirements"]);
    }
}

$doctor = new Doctor();