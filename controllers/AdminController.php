<?php

/**
 * Контроллер AdminController
 * Главная страница в админпанели
 */

/**
 * Функция для стартовой страницы "Панель администратора"
 */
function index()
{
    // Подключаем вид
    require_once(ROOT . '/views/admin/index.php');
    return true;
}

