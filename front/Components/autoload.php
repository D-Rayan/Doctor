<?php

include __DIR__ . "/Alert/Alert.php";

/*
 *
// Will autoload all Components
spl_autoload_register(function ($class) {
    $prefix = 'Doctor\\Front\\Components\\';
    $base_dir = __DIR__ . '/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $className = str_replace('\\', '/', $relative_class);
    $file = $base_dir . $className . "/" . $className . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});
 */