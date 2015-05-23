<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 16/05/15
 * Time: 16:02
 */
?>
<form action="index.php?p=user_add" method="post">
    <input type="text" name="lastname" placeholder="Marley"/><br>
    <input type="text" name="firstname" placeholder="Bob"/><br>
    <input type="number" name="day"/><input type="number" name="month"/><input type="number" name="year"/><br>
    <input type="email" name="email" placeholder="bob.marley@JamaicaMail.jah"/><br>
    <input type="password" name="password" placeholder="Password"/><br>
    <input type="password" name="passwordCheck" placeholder="Password"/><br>
    <input type="text" name="adress" placeholder="21 Jump Street"/><br>
    <input type="text"name="city" placeholder="Kingston"/><br>
    <input type="number"name="postalCode" placeholder="75000"/><br>*<input type="radio" name="subscription" value=1 checked> Basic<br>
    <input type="radio" name="subscription" value=2> Basic Plus<br>
    <input type="radio" name="subscription" value=3> Premium <br/>
    <input type="submit" value="submit"/>
</form>
<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 16/05/15
 * Time: 16:02
 */
        if (isset($response['errorLog'])) {
            echo '<div class="errorLog">';
            foreach ($response['errorLog'] as $flash) {
                    echo  $flash.'<br>';
                }
            echo'</div>';
        }
?>
