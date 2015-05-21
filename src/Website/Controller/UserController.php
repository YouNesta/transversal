<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 15/05/15
 * Time: 22:54
 */
namespace Website\Controller;
use Website\Model\UserManager;

class UserController extends HomeController
{

    public function __construct()
    {
        $this->bdd = $this->getConnection();
    }
    public function addMessageFlash($type, $message)
    {
        $types = ['success','error','alert','info'];
        if (!isset($types[$type])){
            return false;
        }

        if (!isset($_SESSION['flashBag'][$type])) {
            $_SESSION['flashBag'][$type] = [];
        }

        // on ajoute le message
        $_SESSION['flashBag'][$type][] = $message;
    }
    public function listUsersAction()
    {

        $userManager = new UserManager($this->getConnection());
        $users = $userManager->getUsers();

        return [
            'view' => '../src/WebSite/View/user/listUser.html.php',
            'users' => $users
        ];
    }
    public function showUserAction($request)
    {
        $userManager = new UserManager($this->getConnection());
        $users = $userManager->getUser($request['session']['id']);

        return [
            'view' => '../src/WebSite/View/user/showUser.html.php',
            'users' => $users
        ];
    }

    public function addUserAction($request)
    {
        if ($request['request']) {
            $userManager = new UserManager($this->getConnection());
            $verifForm = $userManager->addUser(
                $request['request']['lastname'],
                $request['request']['firstname'],
                $request['request']['year'].'-'.$request['request']['month'].'-'.$request['request']['day'],
                $request['request']['email'],
                $request['request']['password'],
                $request['request']['passwordCheck'],
                $request['request']['adress'],
                $request['request']['city'],
                $request['request']['postalCode'],
                $request['request']['subscription']
            );
            if($verifForm == 'ok'){
                return [
                    'redirect_to' => 'index.php?p=show_home'
                ];
            }else{
                return [
                    'redirect_to' => 'index.php?p=user_add'
                ];
            }
        }
        return [
            'view' => 'src/Website/View/adduser.html.php'
        ];
    }

    public function deleteUserAction($request)
    {
        $userManager = new UserManager($this->getConnection());
        $userManager->deleteUser($request['request']['email']);
        return [
            'redirect_to' => 'index.php',
        ];
    }

    public function logUserAction($request)
    {
        if ($request['request']) {
            $userManager = new UserManager($this->getConnection());
            $users = $userManager->logUser($request['request']['email'],$request['request']['password'] );
            if ($users) {
                if($users['stateAccount']== 0){
                    $this->addMessageFlash(1, "Vous n'avez pas encore confirmé votre email");
                    return [
                        'redirect_to' => 'index.php?p=user_login',
                    ];
                }
                $request['session']['user'] = $users;
                $this->addMessageFlash(0, 'Vous vous êtes connecté avec succés');
                return [
                    'redirect_to' => 'index.php?p=show_home',
                ];
            }
            else{
                $this->addMessageFlash(1, 'Identifiants incorrect');
                return [
                    'redirect_to' => 'index.php?p=user_login',
                ];
            }
        }
        return [
            'view' => 'src/Website/View/login.html.php'
        ];

    }

    public function logOutAction($request)
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
            session_start();
            $this->addMessageFlash(1, 'Vous vous êtes correctement déconnecté');
            $request['session']['user'] = array();
            return [
                'redirect_to' => 'index.php?p=show_home',
            ];

        }

    }
    public function enableUserAction($request)
    {
        if ($request['query']['enableUser']) {

            $userManager = new UserManager($this->getConnection());
            $users = $userManager->enableUser($request['query']['enableUser']);
            if ($users == 'ok') {
                $request['session']['user'] = $users;
                $this->addMessageFlash(0, 'Votre adresse email a bien été confirmé');
                return [
                    'redirect_to' => 'index.php?p=show_home',
                ];
            }
            else{
                $this->addMessageFlash(1, 'Erreur Serveur veuillez contacter notre service client');
                return [
                    'redirect_to' => 'index.php?p=show_addUser',
                ];
            }
        }
        $this->addMessageFlash(1, 'Votre lien n\'est pas valide');
        return [
            'redirect_to' => 'index.php?p=show_home'
        ];

    }
}
