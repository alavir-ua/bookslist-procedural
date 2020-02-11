<?php
/**
 * Router - компонент для работы с маршрутами
 *
 */

/**
 * Возвращает строку запроса
 */
function getURI()
{
    if (!empty($_SERVER['REQUEST_URI'])) {
        return trim($_SERVER['REQUEST_URI'], '/');
    }
}

/**
 * Функция для обработки запроса
 */
function run($routes)
{
    // Получаем строку запроса
    $uri = getURI();

    // Проверяем наличие такого запроса в массиве маршрутов (routes.php)
    foreach ($routes as $uriPattern => $path) {

        // Сравниваем $uriPattern и $uri
        if (preg_match("~$uriPattern~", $uri)) {

            // Получаем внутренний путь из внешнего согласно правилу.
            $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

            // Определяем контроллер, функцию, параметры
            $segments = explode('/', $internalRoute);

            $controllerName = array_shift($segments) . 'Controller';
            $controllerName = ucfirst($controllerName);

            $functionName = array_shift($segments);

            $parameters = $segments;

            // Получаем путь к файлу контроллера
            $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

            //Если файл контроллера существует, подлючаем его
            if (!file_exists($controllerFile)) {
                trigger_error('Invalid Controller');
                exit;
            }
            require_once($controllerFile);

            //Если функция в контроллере существует, вызываем ее с массивом параметров(если они есть)
            if (!function_exists($functionName)) {
                trigger_error('Invalid Controller Function');
                exit;
            }

            $result = call_user_func_array($functionName, $parameters);

            //Если функция контроллера успешно вызвана, завершаем работу функции роутера
            if ($result != null) {
                break;
            }
        }
    }
}





