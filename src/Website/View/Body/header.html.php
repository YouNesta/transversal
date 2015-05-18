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
</head>
<body>
<div class="nav">
    <ul>
        <li><a href="?p=show_home">Accueil</a></li>
        <?php if(isset($_SESSION['user'])) {
                    echo '<li><a href="?p=user_logout">Deconnexion</a></li>
                        <li><a href="?p=show_profilUser">Profil</a></li>';
                ?>
        <li><a href="?p=show_contact">Contact</a></li>
        <? }else {
                echo '<li><a href="?p=show_login">Connexion</a></li><li><a href="?p=show_addUser">Inscription</a></li>';


            }
            ?>

    </ul>
</div>
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