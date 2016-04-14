<?php

spl_autoload_register(function($class) {
    $parts = explode('_', $class);
    array_walk($parts, function($value) {
        ucfirst(strtolower($value));
    });
    $path = implode('/', $parts) . '.php';
    $includePath = __DIR__ . '/';
    if (file_exists($includePath . $path)) {
        include_once $includePath . $path;
        return;
    }
});