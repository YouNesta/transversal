<?php
session_start();
require_once __DIR__.'/src/Model/function.php';
if(isset($_GET['action'])){
    if($_GET['action'] == 'logout'){
        session_destroy();
        header('Location: index.php?page='.$_GET['page'].'&action=logoutSuccess', 302);
    }elseif($_GET['action'] == 'logoutSuccess'){
        addMessageFlash(0, 'Vous vous etes déconnecté avec succé');
    }
}
$routing = [
    'View/home' => [
        'controller' => 'home',
        'secure' => false,
    ],
    'View/contact' => [
        'controller' => 'contact',
        'secure' => true,
    ],
    'View/login' => [
        'controller' => 'login',
        'secure' => false,
    ],
    'View/404' => [
        'controller' => '404',
        'secure' => false,
    ]
];

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if (!isset($routing[$page])) {
        // la page n'existe pas
        $page = 'View/404';
    }
} else {
    //page par defaut
    $page = 'View/home';
}
//check pour la sécurité : si la page à la clée 'secure' est true et que $_SESSION['name'] n'est pas définis
if ($routing[$page]['secure'] === true && !isset($_SESSION['user'])) {
    //Met en session un message informatif
    addMessageFlash(3, 'Veuillez-vous connecter afin d\'accéder à cette page');
    //redirection
    header("location: index.php?page=View/login");
    exit;
}

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
            <li><a href="?page=View/home">Accueil</a></li>
            <li><a href="?page=View/contact">Contact</a></li>
            <li><?php if(isset($_SESSION['user'])){echo '<a href="?page=View/'.$_GET['page'].'&action=logout">Deconnexion</a>';}else{echo '<a href="?page=View/login">Connexion</a>';} ?></li>
        </ul>
    </nav>
    <div class="wrapper">
        <?php
            include 'src/'.$page.'.php';

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
    </div>
</body>
</html>