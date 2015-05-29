<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 27/05/15
 * Time: 13:59
 */
namespace Website\Model;

use Website\Controller\PaymentController;

class PaymentManager extends PaymentController
{
    function __construct($param)
    {
        $this->bdd = $param;
    }

    function paymentSuccess($email){
        $payment = $this->bdd->update('users', array('statePayment' => 1), array('email' => $email));
    }

    function paymentOff(){

    }




}