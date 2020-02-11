<?php

return array(
    // Книга:
    'book/([0-9]+)' => 'book/view/$1', // функция view в BookController

    // Каталог:
    'catalog/page-([0-9]+)' => 'catalog/index/$1', // функция index в CatalogController
    'catalog' => 'catalog/index', // функция index в CatalogController

    //Каталог по жанру:
    'genre/([0-9]+)/page-([0-9]+)' => 'catalog/genre/$1/$2', // функция genre в CatalogController
    'genre/([0-9]+)' => 'catalog/genre/$1', // функция genre в CatalogController

    //Каталог по автору:
    'author/([0-9]+)/page-([0-9]+)' => 'catalog/author/$1/$2', // функция author в CatalogController
    'author/([0-9]+)' => 'catalog/author/$1', // функция author в CatalogController

    //Заказ:
    'order/([0-9]+)' => 'order/index/$1', // функция index в OrderController

    // Управление книгами:
    'admin/book/create' => 'adminBook/create', // функция create в AdminBookController
    'admin/book/update/([0-9]+)' => 'adminBook/update/$1', //функция update в AdminBookController
    'admin/book/delete/([0-9]+)' => 'adminBook/delete/$1', //функция delete в AdminBookController
    'admin/book/page-([0-9]+)' => 'adminBook/index/$1', // функция index в AdminBookController
    'admin/book' => 'adminBook/index', // функция index в AdminBookController

    // Управление жанрами:
    'admin/genre/update/([0-9]+)' => 'adminGenre/update/$1', //функция update в AdminGenreController
    'admin/genre/create' => 'adminGenre/create', //функция create в AdminGenreController
    'admin/genre' => 'adminGenre/index', //функция index в AdminGenreController

    // Управление авторами:
    'admin/author/create' => 'adminAuthor/create', //функция create в AdminAuthorController
    'admin/author' => 'adminAuthor/index', //функция index в AdminAuthorController

    // Админпанель:
    'admin' => 'admin/index', // функция index в AdminController

    // О магазине
    'contacts' => 'site/contact', // функция contact в SiteController
    'about' => 'site/about', // функция about в SiteController

    // Главная страница
    'index.php' => 'site/index', // функция index в SiteController
    '' => 'site/index', // функция index в SiteController
);
