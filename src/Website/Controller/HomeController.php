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
}