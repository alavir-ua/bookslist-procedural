<?php

/**
 * Файл для автоматического подключения моделей и компонентов
 */

$array_paths = array(
    '/models/',
    '/components/',
);

foreach ($array_paths as $path) {

    // Формируем имя и путь к файлу
    $dir = ROOT . $path;

    // Если такой файл существует, подключаем его
    $files = scandir($dir);
    foreach ($files as $file) {
        if (($file !== '.') && ($file !== '..')) {
            require_once $dir . $file;
        }
    }
}




