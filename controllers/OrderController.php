<?php

/**
 * Контроллер OrderController
 * Заказ
 */

/**
 * Функция для страницы "Заказ"
 */
function index($id)
{
    // Список жанров для левого меню
    $genres = getGenresList();

    // Список авторов для левого меню
    $authors = getAuthorsList();

    //Получаем данные заказываемой книги
    $book = getBookById($id);

    // Статус успешного оформления заказа
    $result = false;

    // Обработка формы
    if (isset($_POST['submit'])) {

        // Если форма отправлена, получаем данные из формы
        $order['code'] = $_POST['book_code'];
        $order['quantity'] = $_POST['book_quant'];
        $order['address'] = $_POST['address'];
        $order['user_name'] = $_POST['full_name'];
        $order['book_name'] = $_POST['book_name'];
        $order['book_price'] = $_POST['book_price'];

        // Флаг ошибок
        $errors = false;

        if (!isset($order['quantity']) || empty($order['quantity'])) {
            $order['amount'] = false;
        } else {
            $order['amount'] = $order['book_price'] * $order['quantity'];

        }

        // При необходимости можно валидировать значения нужным образом
        if (!isset($order['address']) || empty($order['address'])) {
            $errors[] = 'Заполните поле "Ваш адресс"';
        }
        if (!isset($order['user_name']) || empty($order['user_name'])) {
            $errors[] = 'Заполните поле "Ваше ФИО"';
        }
        if (!isset($order['quantity']) || empty($order['quantity'])) {
            $errors[] = 'Заполните поле "Количество экземпляров"';
        }

        if ($errors == false) {
            // Если ошибок нет - отправляем письмо с данными о заказе администратору
            if (sendOrder($order)) {
                $result = true;
            } else {
                $book['name'] = $_POST['book_name'];
                $book['code'] = $_POST['book_code'];
                $book['price'] = $_POST['book_price'];
                $result = false;
            }
        }
    }
    require_once(ROOT . '/views/order/index.php');
    return true;
}

