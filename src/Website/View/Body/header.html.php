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
    <script src="asset/js/jqueryui/1.11.3/jquery-ui.min.js"></script>
    <script src="asset/js/script.js"></script>
</head>
<body>
<div class="nav">
    <ul>

        <li><a id="catalog" href="#"></a></li>
        <li><a id="profil" href="#"></a></li> <!-- href="?p=show_profilUser" -->
        <li><a id="logo" href="index.php#"></a></li>
        <?php if(isset($_SESSION['user'])) {echo '<li><a id="userLogout" href="?p=user_logout"></a></li>';}else{echo '<li><a id="userLogin" href="?p=user_login"></a></li><li><a id="UserAdd" href="?p=user_add"></a></li>';}?>
        <li><a id="contact" href="?p=show_contact"></a></li>
    </ul>
</div>
<div class="wrapper">
    <div class="wrapperLeft">
        <div  id="contentWL" is-open='false'>
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

