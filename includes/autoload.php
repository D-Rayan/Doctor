<?php

require_once DOCTOR_ABSOLUTE_PATH . "/includes/Settings.php";

// Will autoload all Components
spl_autoload_register(function ($class) {
    $prefix = 'Doctor\\Languages\\';
    $base_dir = __DIR__ . '/Languages/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $className = str_replace('\\', '/', $relative_class);
    $file = $base_dir . $className . '.php';

    if (file_exists($file)) {
        require_once $file;
    }

    $prefix = 'Doctor\\SeoSansMigraine\\';
    $base_dir = __DIR__ . '/SeoSansMigraine/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $className = str_replace('\\', '/', $relative_class);
    $file = $base_dir . $className . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});