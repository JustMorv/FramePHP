<?php
namespace applications\core;

use applications\core\View;

abstract class Controller
{
    public $route;
    public $view;
    public $acl;
    public function __construct($route)
    {
        $this->route = $route;
        if(!$this->checkACL()){
            View::errorCode(403);
        }
        $this->view = new View($route);
        $this->model = $this->loadModels($route["controller"]);
    }
    public function loadModels($name)
    {
        $path = "applications\models\\" . ucfirst($name);
        if (class_exists($path)) {
            return new $path;
        }
    }
    public function checkACL()
    {
        $this->acl = require "applications/acl/" . $this->route['controller'] . ".php";
        if ($this->isACL('all')) {
            return "true";
        } elseif (isset($_SESSION['authorize']['id']) and $this->isACL('authorize')) {
            return "true";
        } 
        elseif (!isset($_SESSION['authorize']['id']) and $this->isACL('guest')) {
            return "true";
        }elseif (isset($_SESSION['admin']) and $this->isACL('admin')) {
            return "true";
        }
        return "false";



    }
    public function isACL($key)
    {
        return in_array($this->route["action"], $this->acl[$key]);
    }
}