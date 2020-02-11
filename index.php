<?php

// Общие настройки
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Подключение файлов системы и конфигурации
define('ROOT', dirname(__FILE__));
include_once(ROOT . '/config/site.php');
include_once(ROOT . '/components/autoload.php');

// Путь к файлу с роутами
$routesPath = ROOT . '/config/routes.php';

// Получаем роуты из файла
$routes = include($routesPath);
//Запускаем роутер
run($routes);
