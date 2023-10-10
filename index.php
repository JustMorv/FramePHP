<?php 
require_once "applications/lib/Dev.php";
use applications\core\Router;

spl_autoload_register(function($class){
    // include 'classes/'. $class. 'class.php';
    $path = str_replace('\\','/', $class);
    
    if(!file_exists($class)){
        require $path.'.php';

    }
});
// debug($_SERVER);
$r = new Router();
$r->run();