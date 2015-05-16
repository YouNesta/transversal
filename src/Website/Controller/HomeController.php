<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 15/05/15
 * Time: 21:57
 */

namespace Website\Controller;


class HomeController extends AbstractBaseController{

    function __construct(){
        $this->getConnection();
    }

    function addMessageFlash($type, $message)
    {
        $types = ['success','error','alert','info'];
        if (!isset($types[$type])){
            return false;
        }

        if (!isset($_SESSION['flashBag'][$type])) {
            $_SESSION['flashBag'][$type] = [];
        }

        // on ajoute le message
        $_SESSION['flashBag'][$type][] = $message;
    }

    function showHomeAction(){

        return [
            'view' => 'src/Website/View/home.html.php'
        ];
    }

    function showLoginAction(){

        return [
            'view' => 'src/Website/View/login.html.php'
        ];
    }

    function showContactAction(){

        return [
            'view' => 'src/Website/View/contact.html.php'
        ];
    }
}