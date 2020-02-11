<?php

/**
 * Контроллер SiteController
 */


/**
 * Функция для главной страницы
 */
function index()
{
    // Список жанров для левого меню
    $genres = getGenresList();

    // Список авторов для левого меню
    $authors = getAuthorsList();

    // Список последних книг
    $latestBooks = getLatestBooks(6);

    // Список книг для слайдера
    $sliderBooks = getRecommendedBooks();

    // Подключаем вид
    require_once(ROOT . '/views/site/index.php');
    return true;
}

/**
 * Функция для страницы "Контакты"
 */

function contact()
{
    // Статус успешной отправки контактной информации
    $result = false;

    //Результат обработка формы
    if (isset($_POST['submit'])) {

        //Если форма отправлена получаем данные из формы
        $contact['userEmail'] = $_POST['userEmail'];
        $contact['userText'] = $_POST['userText'];

        // Флаг ошибок
        $errors = false;

        // При необходимости можно валидировать значения нужным образом
        if (!isset($contact['userEmail']) || empty($contact['userEmail'])) {
            $errors[] = 'Заполните поле "Ваша почта"';
        }
        if (!isset($contact['userText']) || empty($contact['userText'])) {
            $errors[] = 'Заполните поле "Сообщение"';
        }

        if ($errors == false) {
            // Если ошибок нет отправляем письмо администратору
            if (sendContact($contact)) {
                $result = true;
            } else {
                $result = false;
            };
        }
    }
    // Подключаем вид
    require_once(ROOT . '/views/site/contact.php');
    return true;
}

/**
 * Action для страницы "О магазине"
 */

function about()
{
    // Подключаем вид
    require_once(ROOT . '/views/site/about.php');
    return true;
}


