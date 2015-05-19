<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 15/05/15
 * Time: 22:47
 */?>

    <!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Transversal
    </title>
    <link rel="stylesheet" href="asset/css/style.css"/>
    <link rel="stylesheet" href="asset/css/reset.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
    <script src="asset/js/script.js"></script>
</head>
<body>
<div class="nav">
    <ul>
        <li><a id="catalog" href="#">Catalogue</a></li>
        <li><a id="profil" href="#">Profil</a></li> <!-- href="?p=show_profilUser" -->
        <li><a href="index.php#"></a></li>
        <?php if(isset($_SESSION['user'])) {echo '<li><a href="?p=user_logout">Deconnexion</a></li>';}else{echo '<li><a href="?p=user_login">Connexion</a></li><li><a href="?p=show_addUser">Inscription</a></li>';}?>
        <li><a href="?p=show_contact">Contact</a></li>
    </ul>
</div>
<div class="wrapper">
    <div class="wrapperLeft">
        <div  id="contentWL">
            <img src="" alt="Logo"/>
            <div id="navWL"></div>

        </div>
    </div>
        <div class="alert">
       <?php
        if (isset($_SESSION['flashBag'])) {
            foreach ($_SESSION['flashBag'] as $type => $flash) {
                foreach ($flash as $key => $message) {
                    echo '<div class="flashBag" role="'.$type.'" >';
                 echo  $message.'<br>';
                    echo'</div>';
                    // un fois affiché le message doit être supprimé
                    unset($_SESSION['flashBag'][$type][$key]);
                }

            }
        }

?></div><div class="wrapperRight" >

