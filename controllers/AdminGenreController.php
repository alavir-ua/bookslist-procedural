<?php

/**
 * Контроллер AdminGenreController
 * Управление жанрами книг в админпанели
 */

/**
 * Функция для страницы "Управление жанрами"
 */
function index()
{
    // Получаем список жанров
    $genresList = getGenresListAdmin();

    // Подключаем вид
    require_once(ROOT . '/views/admin/admin_genre/index.php');
    return true;
}

/**
 * Функция для страницы "Добавить жанр"
 */
function create()
{
    // Обработка формы
    if (isset($_POST['submit'])) {

        // Если форма отправлена получаем данные из формы
        $name = $_POST['name'];
        $status = $_POST['status'];

        // Флаг ошибок в форме
        $errors = false;

        // При необходимости можно валидировать значения нужным образом
        if (!isset($name) || empty($name)) {
            $errors[] = 'Заполните поле "Название"';
        }

        if ($errors == false) {
            // Если ошибок нет добавляем новый жанр
            createGenre($name, $status);

            // Перенаправляем пользователя на страницу управления жанрами
            header("Location: /admin/genre");
        }
    }
    require_once(ROOT . '/views/admin/admin_genre/create.php');
    return true;
}

/**
 * Функция для страницы "Редактировать жанр"
 */
function update($id)
{
    // Получаем данные о жанре
    $genre = getGenreById($id);

    // Обработка формы
    if (isset($_POST['submit'])) {
        // Если форма отправлена получаем данные из формы
        $name = $_POST['name'];
        $status = $_POST['status'];

        // Сохраняем изменения
        updateGenreById($id, $name, $status);

        // Перенаправляем админа на страницу управлениями жанрами
        header("Location: /admin/genre");
    }
    // Подключаем вид
    require_once(ROOT . '/views/admin/admin_genre/update.php');
    return true;
}

