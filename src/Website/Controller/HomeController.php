<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 15/05/15
 * Time: 21:57
 */

namespace Website\Controller;


class HomeController extends AbstractBaseController{

   public function __construct(){
        $this->getConnection();
    }

    public function addMessageFlash($type, $message)
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

   public function showHomeAction(){

        return [
            'view' => 'src/Website/View/home.html.php'
        ];
    }

    public function showAddUserAction(){

        return [
            'view' => 'src/Website/View/adduser.html.php'
        ];
    }

   public function showContactAction(){

        return [
            'view' => 'src/Website/View/contact.html.php'
        ];
    }
}