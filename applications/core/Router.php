<?php
namespace applications\core;
use applications\core\View;

class Router
{

    protected $routes = [];
    protected $params = [];
    public function __construct()
    {
        $arr = require "applications/config/routers.php";
        foreach ($arr as $key => $value) {
            $this->add($key, $value);
        }
        // debug($this->routes);

    }
    public function add($route, $params)
    {
        $route = '#^' . $route . '$#';
        $this->routes[$route] = $params;
    }

    public function match()
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $param) {
            if (preg_match($route, $uri, $matches)) {
                $this->params = $param;
                return true;
            }
        }
        return false;

    }

    public function run()
    {
        if ($this->match()) {
            $path = "applications\controllers\\" . ucfirst($this->params["controller"]) . "Controller";
            if (class_exists($path)) {
                $action = $this->params["action"] ."Action";
                if(method_exists($path, $action )){
                    $controller = new $path($this->params);
                    $controller->$action();
                }else{
                    View::errorCode(404);
                }
            } else {
                View::errorCode(404);
            }
        } else {
            View::errorCode(404);
        }

        // echo"start";
    }
}