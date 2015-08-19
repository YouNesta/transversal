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
    <link rel="stylesheet" media="screen and (max-width: 700px)" href="asset/css/smallstyle.css" type="text/css" />
    <script src="asset/js/jquery/2.1.3/jquery.js"></script>
    <script src="asset/js/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="asset/js/script.js"></script>
</head>
<body>
<div class="wrapper">
    <div class="nav">
        <a id="logo" href="index.php#"><img src="asset/images/logoWhite.png" alt=""/></a>
        <ul>
            <li><a id="home" href="?p=show_home">Accueil</a></li>
            <li><a id="catalog" href="?p=product_list">Galerie</a></li>
            <!-- href="?p=show_profilUser" -->
            <?php if(isset($_SESSION['user'])) {echo '<li><a id="profil" href="?p=show_profilUser">Mon Compte</a></li> <li><a id="userLogout" href="?p=user_logout">Déconnexion</a></li>';}else{echo '<li><a id="userLogin" href="?p=user_login">Se connecter</a></li><li><a id="UserAdd" href="?p=user_add">Inscription</a></li>';}?>
            <li><a id="contact" href="?p=show_contact">Contact</a></li>
        </ul>
        
        <ul >
            <li class="socialMedia"><a href="http://facebook.fr"><img src="asset/images/socialMedia/facebook.png" alt=""/></a></li>
            <li class="socialMedia"><a href="http://twitter.fr"><img src="asset/images/socialMedia/twitter.png" alt=""/></a></li>
            <li class="socialMedia"><a href="http://pinterest.fr"><img src="asset/images/socialMedia/pinterest.png" alt=""/></a></li>
        </ul>
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

