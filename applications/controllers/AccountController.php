<?php 
namespace applications\controllers;
use applications\core\Controller;
class AccountController extends Controller{
    public function loginAction(){
        if(!empty($_POST)){
            $this->view->getMesage("success", "text of message"); 
            // $this->view->location("/account/register"); 
        }
        // $this->view->rederect('/');
        $this->view->render("loggin");

    }

    public function registerAction(){
        $this->view->render("register");

    }
}