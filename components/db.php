<?php

/**
 * Компонент для работы с базой данных
 */

/**
 * Устанавливает соединение с базой данных
 * @return \PDO <p>Объект класса PDO для работы с БД</p>
 */
function getConnection()
{
    include_once(ROOT . '/config/dbconfig.php');
    //Параметры подключения
    $host = DB_HOST;
    $dbname = DB_NAME;
    $username = DB_USERNAME;
    $password = DB_PASSWORD;

    // Устанавливаем соединение
    $dsn = "mysql:host=$host;dbname=$dbname";
    $db = new PDO($dsn, $username, $password);

    // Задаем кодировку
    $db->exec("set names utf8");

    //Возвращаем обьект подключения
    return $db;
}
