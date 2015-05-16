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
    <title>Document</title>
</head>
<body>
<nav>
    <ul>
        <li><a href="?p=show_home">Accueil</a></li>
        <li><a href="?p=show_contact">Contact</a></li>
        <li><?php if(isset($_SESSION['user'])){echo '<a href="?p=user_logout">Deconnexion</a>';}else{echo '<a href="?p=show_login">Connexion</a></li><li><a href="?p=show_addUser">Inscription</a></li>';} ?></li>
    </ul>
</nav>
<div class="wrapper">
       <?php
        if (isset($_SESSION['flashBag'])) {
            foreach ($_SESSION['flashBag'] as $type => $flash) {
                foreach ($flash as $key => $message) {
                    echo '<div class="'.$type.'" role="'.$type.'" >'.$message.'</div>';
                    // un fois affiché le message doit être supprimé
                    unset($_SESSION['flashBag'][$type][$key]);
                }
            }
        }
?>