<?php

/**
 * Управление авторами книг в админпанели
 */

/**
 * Функция для страницы "Управление авторами"
 */
function index()
{
    // Получаем массив авторов
    $authorsList = getAuthorsList();

    // Подключаем вид
    require_once(ROOT . '/views/admin/admin_author/index.php');
    return true;
}

/**
 * Функция для страницы "Добавить автора"
 */
function create()
{
    // Обработка формы
    if (isset($_POST['submit'])) {

        // Если форма отправлена получаем данные из формы
        $name = $_POST['name'];

        // Флаг ошибок в форме
        $errors = false;

        // При необходимости можно валидировать значения нужным образом
        if (!isset($name) || empty($name)) {
            $errors[] = 'Заполните поле "Имя"';
        }

        if ($errors == false) {
            // Если ошибок нет добавляем новый жанр
            createAuthor($name);

            // Перенаправляем пользователя на страницу управления жанрами
            header("Location: /admin/author");
        }
    }
    require_once(ROOT . '/views/admin/admin_author/create.php');
    return true;
}

