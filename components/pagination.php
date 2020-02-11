<?php

/**
 * Компонент пагинации
 */

/**
 * Для получения общего числа страниц
 * @return int страниц
 */
function amount($total, $limit)
{
    # Делим и возвращаем
    return ceil($total / $limit);
}

/**
 *  Для получения, откуда стартовать
 * @return array с началом и концом отсчёта
 */
function limits($current_page, $amount)
{
    $max = 10;
    # Вычисляем ссылки слева (чтобы активная ссылка была посередине)
    $left = $current_page - round($max / 2);

    # Вычисляем начало отсчёта
    $start = $left > 0 ? $left : 1;

    # Если впереди есть как минимум $this->max страниц
    if ($start + $max <= $amount) {
        # Назначаем конец цикла вперёд на $this->max страниц или просто на минимум
        $end = $start > 1 ? $start + $max : $max;
    } else {
        # Конец - общее количество страниц
        $end = $amount;

        # Начало - минус $this->max от конца
        $start = $amount - $max > 0 ? $amount - $max : 1;
    }

    # Возвращаем
    return
        array($start, $end);
}

/**
 * Для установки текущей страницы
 * @return int
 */
function setCurrentPage($page, $amount)
{
    $current_page = $page;

    # Если текущая страница больше нуля
    if ($current_page > 0) {
        # Если текущая страница меньше общего количества страниц
        if ($current_page > $amount)
            # Устанавливаем страницу на последнюю
            $current_page = $amount;
    } else {
        # Устанавливаем страницу на первую
        $current_page = 1;
    }
    return $current_page;
}

/**
 * Для генерации HTML-кода ссылки
 * @param integer $page - номер страницы
 * @return string
 */
function generateHtml($page, $index, $text = null)
{
    # Если текст ссылки не указан
    if (!$text)
        # Указываем, что текст - цифра страницы
        $text = $page;

    $currentURI = rtrim($_SERVER['REQUEST_URI'], '/') . '/';
    $currentURI = preg_replace('~/page-[0-9]+~', '', $currentURI);
    # Формируем HTML код ссылки и возвращаем
    return
        '<li><a href="' . $currentURI . $index . $page . '">' . $text . '</a></li>';
}

/**
 *  Для вывода ссылок
 * @return HTML-код со ссылками навигации
 */
function getPagination($total, $page, $limit, $index)
{
    # Для записи ссылок
    $links = null;

    # Вычисляем количество страниц
    $amount = amount($total, $limit);

    # Определяем текущую страницу
    $current_page = setCurrentPage($page, $amount);

    # Получаем ограничения для цикла
    $limits = limits($current_page, $amount);

    $html = '<ul class="pagination">';
    # Генерируем ссылки
    for ($page = $limits[0]; $page <= $limits[1]; $page++) {
        # Если текущая это текущая страница, ссылки нет и добавляется класс active
        if ($page == $current_page) {
            $links .= '<li class="active"><a href="#">' . $page . '</a></li>';
        } else {
            # Иначе генерируем ссылку
            $links .= generateHtml($page, $index);
        }
    }

    # Если ссылки создались
    if (!is_null($links)) {
        # Если текущая страница не первая
        if ($current_page > 1)
            # Создаём ссылку "На первую"
            $links = generateHtml(1, $index, '&lt;') . $links;

        # Если текущая страница не первая
        if ($current_page < $amount)
            # Создаём ссылку "На последнюю"
            $links .= generateHtml($amount, $index, '&gt;');
    }

    $html .= $links . '</ul>';

    # Возвращаем html
    return $html;
}


















