<?php
/**
 * Mail - модель для отправки почты
 */


/*
 * Отправляет админу письмо с данными о заказе
 * @param array $data <p>Массив параметров</p>
 * @return boolean <p>Результат отправки письма</p>
 */
function sendOrder($order)
{
    $adminEmail = ADMIN_EMAIL;
    $siteUrl = SITE_URL;
    ob_start(); //Начать буферизацию вывода
    include(ROOT . '/views/mail/order.html'); //Включить ваш файл шаблона
    $message = ob_get_clean(); //Получить текущее содержимое буфера и удалить текущий выходной буфер
    $subject = "Новый заказ c сайта < ${siteUrl} >";
    if (mail($adminEmail, $subject, $message)) {
        return true;
    };
    return false;
}

/*
 * Отправляет админу письмо с данными обратной связи
 * @param array $contact <p>Массив данных пользователя</p>
 * @return boolean <p>Результат отправки письма</p>
 */
function sendContact($contact)
{
    $adminEmail = ADMIN_EMAIL;
    $message = $contact['userText'];
    $subject = "Новое сообщение от пользователя < ${contact['userEmail']} >";
    if (mail($adminEmail, $subject, $message)) {
        return true;
    };
    return false;
}

