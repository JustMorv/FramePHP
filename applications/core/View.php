<?php
namespace applications\core;

class View
{
    public $path;
    public $route;
    public $layout = 'default';
    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['controller'] . '/' . $route['action'];
    }

    public function render($title, $vars = [])
    {
        extract($vars);
        $path = 'applications/views/' . $this->path . '.php';
        if (file_exists($path)) {
            ob_start();
            require $path;
            $content = ob_get_clean();
            require 'applications/views/layouts/' . $this->layout . '.php';
        } else {
            echo "файл с видом не найден";
        }
    }
    public static function errorCode($code)
    {
        http_response_code($code);
        $path = 'applications/views/errors/' . $code . '.php';
        if (file_exists($path)) {
            require $path;
        }
        exit;
    }
    public function rederect($url)
    {
        header("Location:" . $url);
        exit;
    }
    public function getMesage($status, $message)
    {
        exit(json_encode(['status' => $status, 'message' => $message]));

    }

    public function location($url){
        exit(json_encode(['url' => $url]));
    }
}