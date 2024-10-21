<?php

spl_autoload_register(function ($className) {

    if (file_exists('src/services/' . $className . '.php')) {
        require_once 'src/services/' . $className . '.php';
    }

    if (file_exists('src/models/' . $className . '.php')) {
        require_once 'src/models/' . $className . '.php';
    }

    if (file_exists('src/controllers/' . $className . '.php')) {
        require_once 'src/controllers/' . $className . '.php';
    }

    if (file_exists('src/views/' . $className . '.php')) {
        require_once 'src/views/' . $className . '.php';
    }
});
