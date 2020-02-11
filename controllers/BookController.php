<?php

/**
 * Контроллер BookController
 * книга
 */

/**
 * Функция для страницы просмотра книги
 */
function view($bookId)
{
    // Список категорий для левого меню
    $genres = getGenresList();

    // Список авторов для левого меню
    $authors = getAuthorsList();

    // Получаем инфомрацию о товаре
    $book = getBookById($bookId);

    // Подключаем вид
    require_once(ROOT . '/views/book/view.php');
    return true;
}


