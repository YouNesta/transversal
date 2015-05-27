<?php
session_start();

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;
$routes = Yaml::parse(file_get_contents(__DIR__.'/app/config/routing.yml'));

if(!empty($_GET['p'])){
    $page = $_GET['p'];
} else {
    $page = 'show_home';
}

if (!empty($routes[$page]['controller'])) {
    list($controller_class,$action_name) = explode(':', $routes[$page]['controller']);
} else {
    throw new Exception('add routing config for '.$page.' in routing.yml');
}

$controller = new $controller_class();
if (
    $routes[$page]['secure'] === true && !isset($_SESSION['user'])) {
    //Met en session un message informatif
    $controller->addMessageFlash(3, 'Veuillez-vous connecter afin d\'accéder à cette page');
    //redirection
    header("location: index.php?p=user_login");
    exit;
}
$request['request'] = &$_POST;
$request['query'] = &$_GET;
$request['session'] = &$_SESSION;
$response = $controller->$action_name($request);

if(isset($response['redirect_to'])){  /** Test Redirection */
    header('Location: '.$response['redirect_to']);
    exit;
} elseif (!empty($response['view'])) {
    require_once 'src/Website/View/Body/header.html.php';
    require_once $response['view'];
    require_once 'src/Website/View/Body/footer.html.php';
} elseif (!empty($response['ajax']) ){
    require_once $response['ajax'];
}else {
    throw new Exception('your action "'.$page.'" do not return a correct response array, should have "view" or "redirect_to"');
}

