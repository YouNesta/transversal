<?php

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="?page=home">Accueil</a></li>
            <li><a href="?page=login">Connexion</a></li>
            <li><a href="?page=contact">Contact</a></li>
        </ul>
    </nav>
    <div class="wrapper">
        <?php
            if(isset($_GET['page'])){
                include('src/View/'.$_GET['page'].'.php');
            }else{
                include('src/View/home.php');
            }

        ?>
    </div>
</body>
</html>