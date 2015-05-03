<?php
if(!empty($_POST)){
    if($_POST['pseudo'] == 'younes' && $_POST['password'] == 'younes'){
        addMessageFlash(0, 'Vous vous etes connecté avec succés');
        $_SESSION['user']['pseudo'] = $_POST['pseudo'];
    }else{
        addMessageFlash(1, 'Identifiants incorrect');
    }
}
?>
<form action="#" method="post">
    <input type="text" name="pseudo"/>
    <input type="password" name="password"/>
    <input type="submit" value="Valider"/>
</form>