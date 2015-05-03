<?php
session_start();
require_once __DIR__.'/src/Model/function.php';
if(isset($_GET['action'])){
    if($_GET['action'] == 'logout'){
        session_destroy();
        addMessageFlash(0, 'Vous vous etes deconnecté avec succé');
    }
}
$routing = [
    'home' => [
        'controller' => 'home',
        'secure' => false,
    ],
    'contact' => [
        'controller' => 'contact',
        'secure' => true,
    ],
    'login' => [
        'controller' => 'login',
        'secure' => false,
    ]
];

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if (!isset($routing[$page])) {
        // la page n'existe pas
        $page = '404';
    }
} else {
    //page par defaut
    $page = 'home';
}
//check pour la sécurité : si la page à la clée 'secure' est true et que $_SESSION['name'] n'est pas définis
if ($routing[$page]['secure'] === true && !isset($_SESSION['user'])) {
    //Met en session un message informatif
    addMessageFlash(3, 'Veuillez-vous connecter afin d\'accéder à cette page');
    //redirection
    header("location: index.php?page=login");
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
            <li><a href="?page=home">Accueil</a></li>
            <li><a href="?page=contact">Contact</a></li>
            <li><?php if(isset($_SESSION['user'])){echo '<a href="?page='.$_GET['page'].'&action=logout">Deconnexion</a>';}else{echo '<a href="?page=login">Connexion</a>';} ?></li>
        </ul>
    </nav>
    <div class="wrapper">
        <?php
            include 'src/View/'.$page.'.php';

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