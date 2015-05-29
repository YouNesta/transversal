<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 21/05/15
 * Time: 23:50
 */


echo '

    <form action="?p=show_profilUser" method="post">
        <h2>Changer vos Infos Personnelles</h2>
        <input type="text" name="lastname" value="'.$request['session']['user']['lastname'].'"><br>
        <input type="text" name="firstname" value="'.$request['session']['user']['firstname'].'"><br>
        <input type="text" name="birthday" value="'.$request['session']['user']['birthday'].'"><br>
<button type="submit">√</button>
</form>
<form action="?p=show_profilUser" method="post">

<h2>Changer vos coordonnées</h2>
         <input type="text" name="email" value="'.$request['session']['user']['email'].'"><br>
        <input type="text" name="adress" value="'.$request['session']['user']['adress'].'"><br>
        <input type="number" name="postalCode" value="'.$request['session']['user']['postalCode'].'"><br>
        <input type="text" name="city" value="'.$request['session']['user']['city'].'"><br>
        <button type="submit">√</button>
</form>



<form action="?p=show_profilUser" method="post" id="subscription">
<h2>Abonnement Actuel</h2>
<h3>'.$request['session']['user']['subscription']['name'].'</h3>
<h3>'.$request['session']['user']['subscription']['price'].'€/'.$request['session']['user']['subscription']['monthlyPayment'].'mois</h3>
<h2>Changer D\'abonnement</h2>
        <select name="subscription" form="subscription">
            <option value="1"> Basic </option>
            <option value="2"> Premium </option>
            <option value="3"> Premium + </option>
        </select>
        <select name="on" form="subscription">
            <option value="1"> On </option>
            <option value="0"> Off </option>
        </select><br>

        <button type="submit">√</button>
</form>

';

?>

