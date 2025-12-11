<?php
class Route
{
    private static $route = [];
    public static function get($path, $callback)
    {
        self::$route['GET'][$path] = $callback;
    }
    public static function post($path, $callback)
    {
        self::$route['POST'][$path] = $callback;
    }
    public static function handle()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $URL = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if (isset(self::$route[$method][$URL])) {
            call_user_func(self::$route[$method][$URL]);
            exit();
        } else {
            require_once('view/404.php');
            exit();
        }
    }
}
