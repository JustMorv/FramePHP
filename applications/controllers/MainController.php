<?php
namespace applications\controllers;

use applications\core\Controller;
class MainController extends Controller
{
    public function indexAction()
    {
        $result = $this->model->getNews();
        $vars = [
            "news"=> $result,
        ];
        $this->view->render("главная страница", $vars);
    }


}