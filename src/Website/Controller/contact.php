<?php
session_start();
    if(!empty($_POST)){
        require_once '../Model/function.php';
        if($_POST['pseudo'] == 'younes' && $_POST['password'] == 'younes'){
            addMessageFlash(0, 'Vous vous etes connecté avec succés');
            $_SESSION['user']['pseudo'] = $_POST['pseudo'];
            header('Location: ../../index.php?page=View/home', 302);

        }else{
            addMessageFlash(1, 'Identifiants incorrect');
            header('Location: ../../index.php?page=View/login', 302);
        }
    }
