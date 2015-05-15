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
        <li><?php if(isset($_SESSION['user'])){echo '<a href="?p='.$_GET['p'].'&action=logout">Deconnexion</a>';}else{echo '<a href="?p=show_login">Connexion</a>';} ?></li>
    </ul>
</nav>
<div class="wrapper">