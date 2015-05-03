<?php
    if(!empty($_POST)){
        if($_POST['pseudo'] == 'younes' && $_POST['password'] == 'younes'){
            echo 'Bien ouej '.$_POST['pseudo'].' T\'as reussi a te connectey';
        }else{
            echo 'SHIT NEGRO T\'as FAIT DE LA DEMER';
        }
    }
?>
<form action="#" method="post">
    <input type="text" name="pseudo"/>
    <input type="password" name="password"/>
    <input type="submit" value="Valider"/>
</form>