<?php
if(!empty($_POST)){
    if($_POST['pseudo'] == 'younes' && $_POST['password'] == 'younes'){
        addMessageFlash('success', 'Vous vous etes connecté avec succés');
        var_dump($_SESSION);
    }else{

    }
}
?>
<form action="#" method="post">
    <input type="text" name="pseudo"/>
    <input type="password" name="password"/>
    <input type="submit" value="Valider"/>
</form>