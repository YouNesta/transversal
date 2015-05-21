<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 21/05/15
 * Time: 23:50
 */
echo '
    <div>
        <h1>'.$request['session']['user']['lastname'].'</h1>
        <h2>'.$request['session']['user']['firstname'].'</h2>
        <h3>'.$request['session']['user']['birthday'].'</h3>
    </div>
    <div>
        <h1>'.$request['session']['user']['email'].'</h1>
        <h1>'.$request['session']['user']['adress'].'</h1>
        <h1>'.$request['session']['user']['city'].'</h1>
    </div>
     <div>
        <h1>'.$request['session']['user']['subscription']['name'].'</h1>
        <h1>'.$request['session']['user']['subscription']['price'].'€/'.$request['session']['user']['subscription']['monthlyPayment'].'mois</h1>
        <h1></h1>
    </div>
';
?>

