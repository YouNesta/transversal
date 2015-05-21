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
   public function showHomeAction(){

        return [
            'view' => 'src/Website/View/home.html.php'
        ];
    }
   public function showContactAction(){

        return [
            'view' => 'src/Website/View/contact.html.php'
        ];
    }
}