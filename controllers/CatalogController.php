<?php

/**
 * Контроллер CatalogController
 * Каталог книг
 */

/**
 * Функция для страницы "Каталог"
 */
function index($page = 1)
{
    // Список категорий для левого меню
    $genres = getGenresList();

    // Список авторов для левого меню
    $authors = getAuthorsList();

    // Массив книг страницы в каталоге
    $booksList = getBooksLimit($page);

    // Общее количетсво книг (необходимо для постраничной навигации)
    $total = getCountBooks();

    $pagination = getPagination($total, $page, SHOW_BY_DEFAULT, 'page-');

    // Подключаем вид
    require_once(ROOT . '/views/catalog/index.php');
    return true;
}

/**
 * Функция для страницы "Каталог по автору"
 */
function genre($genreId, $page = 1)
{
    // Список категорий для левого меню
    $genres = getGenresList();

    //Список авторов для левого меню
    $authors = getAuthorsList();

    //Массив книг книг жанра для страницы (пагинация)
    $genreBooks = getBooksLimitByGenre($genreId, $page);

    // Общее количетсво книг жанра (пагинация)
    $total = getCountBooksInGenre($genreId);

    $pagination = getPagination($total, $page, SHOW_BY_DEFAULT, 'page-');

    // Подключаем вид
    require_once(ROOT . '/views/catalog/genre.php');
    return true;
}

/**
 * Функция для страницы "Каталог по автору"
 */
function author($authorId, $page = 1)
{
    // Список категорий для левого меню
    $genres = getGenresList();

    //Список авторов для левого меню
    $authors = getAuthorsList();

    //Массив книг книг жанра для страницы (пагинация)
    $authorBooks = getBooksLimitByAuthor($authorId, $page);

    // Общее количетсво книг жанра (пагинация)
    $total = getCountBooksByAuthor($authorId);

    $pagination = getPagination($total, $page, SHOW_BY_DEFAULT, 'page-');

    // Подключаем вид
    require_once(ROOT . '/views/catalog/author.php');
    return true;
}

