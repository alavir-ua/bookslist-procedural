<?php

/**
 * Контроллер AdminBookController
 * Управление книгами в админпанели
 */

/**
 * Функция для страницы "Управление книгами"
 */
function index($page = 1)
{
    // Получаем список книг
    $allBooks = getAdminBooksLimit($page);

    // Общее количетсво книг (необходимо для постраничной навигации)
    $total = getCountBooks();

    // Создаем объект Pagination - постраничная навигация
    $pagination = getPagination($total, $page, SHOW_FOR_ADMIN, 'page-');

    // Подключаем вид
    require_once(ROOT . '/views/admin/admin_book/index.php');
    return true;
}

/**
 * Функция для страницы "Добавить книгу"
 */
function create()
{
    //Получаем список жанров для выпадающего списка
    $genres = getGenresList();

    //Получаем список авторов для выпадающего списка
    $authors = getAuthorsList();

    // Обработка формы
    if (isset($_POST['submit'])) {

        // Если форма отправлена получаем данные из формы
        $options['code'] = $_POST['code'];
        $options['name'] = $_POST['name'];
        $options['price'] = $_POST['price'];
        $options['description'] = $_POST['description'];
        $options['is_new'] = $_POST['is_new'];
        $options['is_recommended'] = $_POST['is_recommended'];
        $options['status'] = $_POST['status'];
        if (isset($_POST['author_id']) || !empty($_POST['author_id'])) {
            $options['authors'] = $_POST['author_id'];  //массив ids выбранных авторов
        } else {
            $options['authors'] = false;
        }
        if (isset($_POST['genre_id']) || !empty($_POST['genre_id'])) {
            $options['genres'] = $_POST['genre_id'];  //массив ids выбранных жанров
        } else {
            $options['genres'] = false;
        }


        // Флаг ошибок в форме
        $errors = false;

        // При необходимости можно валидировать значения нужным образом
        if (!isset($options['code']) || empty($options['code'])) {
            $errors[] = 'Заполните поле "Код"';
        }
        if (!isset($options['name']) || empty($options['name'])) {
            $errors[] = 'Заполните поле "Название книги"';
        }
        if (!isset($options['price']) || empty($options['price'])) {
            $errors[] = 'Заполните поле "Стоимость"';
        }
        if (!isset($options['price']) || empty($options['price'])) {
            $errors[] = 'Заполните поле "Описание"';
        }
        if (!isset($options['genres']) || empty($options['genres'])) {
            $options['genres'] = false;
            $errors[] = 'Заполните поле "Жанр"';
        }
        if (!isset($options['authors']) || empty($options['authors'])) {
            $options['authors'] = false;
            $errors[] = 'Заполните поле "Автор"';
        }

        if ($errors == false) {
            // Если ошибок нет то обавляем новую книгу
            $id = createBook($options);

            // Если запись добавлена
            if ($id) {
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                    move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/books/{$id}.jpg");
                }
            };
            // Перенаправляем админа на страницу управлениями товарами
            header("Location: /admin/book");
        }
    }

    // Подключаем вид
    require_once(ROOT . '/views/admin/admin_book/create.php');
    return true;
}

/**
 * Функция для страницы "Редактировать книгу"
 */
function update($id)
{
    //Получаем список жанров для выпадающего списка
    $genres = getGenresList();

    //Получаем список авторов для выпадающего списка
    $authors = getAuthorsList();

    //Получаем запись о книге
    $book = getBookById($id);

    // Обработка формы
    if (isset($_POST['submit'])) {
        // Если форма отправлена получаем данные из формы
        $options['code'] = $_POST['code'];
        $options['name'] = $_POST['name'];
        $options['price'] = $_POST['price'];
        $options['description'] = $_POST['description'];
        $options['authors'] = $_POST['author_id'];  //массив ids выбранных авторов
        $options['genres'] = $_POST['genre_id'];  //массив ids выбранных жанров
        $options['is_new'] = $_POST['is_new'];
        $options['is_recommended'] = $_POST['is_recommended'];
        $options['status'] = $_POST['status'];

        // Сохраняем изменения
        if (updateBookById($id, $options)) {

            // Если запись изменена проверим, загружалось ли через форму изображение
            if (is_uploaded_file($_FILES["image"]["tmp_name"])) {

                //Определяем путь к прежнему изображению
                $img = ROOT . "/upload/images/books/{$id}.jpg";

                //Если существовало изображение, удаляем его
                if (file_exists($img)) {
                    unlink($img);

                    // Перемещаем загруженное в нужную папку, даем новое имя
                    move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/books/{$id}.jpg");
                }
            }
            // Перенаправляем админа на страницу управлениями книгами
            header("Location: /admin/book");
        }
    }
    // Подключаем вид
    require_once(ROOT . '/views/admin/admin_book/update.php');
    return true;
}

/**
 * Функция для страницы "Удалить книгу"
 */
function delete($id)
{

    // Обработка формы
    if (isset($_POST['submit'])) {
        //Если форма отправлена удаляем товар
        $result = deleteBookById($id);

        //определяем путь к изображению
        $img = ROOT . "/upload/images/books/{$id}.jpg";

        //Если книга удалена и сущ.изображение, удаляем его
        if (file_exists($img) && $result) {
            unlink($img);
        }

        // Перенаправляем админа на страницу управлениями товарами
        header("Location: /admin/book");
    }

    // Подключаем вид
    require_once(ROOT . '/views/admin/admin_book/delete.php');
    return true;
}


