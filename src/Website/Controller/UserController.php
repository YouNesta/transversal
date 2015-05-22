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
            $response = $userManager->addUser(
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
            if($response['verifForm'] == 'ok'){
                if($response['mailCheck'] == 'yes'){
                    $this->addMessageFlash(0, "un mail vient d'etre envoyé, pour confirmer votre inscription");
                    return [
                        'redirect_to' => 'index.php?p=show_home'
                    ];
                }else{
                    $this->addMessageFlash(1, "Un probleme est survenur lors de l'inscription, veuillez reessayer ultérieurement");
                    return [
                        'redirect_to' => 'index.php?p=user_add'
                    ];
                }

            }else{
                return [
                    'view' => 'src/Website/View/adduser.html.php',
                    'errorLog' => $response['errorLog']
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

    public function ShowProfilAction($request){

        if($request['request']){
            $userManager = new UserManager($this->getConnection());
            if(isset($request['request']['lastname'])){
                $users = $userManager->updateAccount($request['request']['lastname'],$request['request']['firstname'],$request['request']['birthday'],$request['session']['user']['id']);
                if($users['verif'] == 'ok'){
                    $request['session']['user']['lastname'] = $request['request']['lastname'];
                    $request['session']['user']['firstname'] = $request['request']['firstname'];
                    $request['session']['user']['birthday'] = $request['request']['birthday'];
                    $this->addMessageFlash(0,'Vos Infos personnelles ont été changé avec succés');
                }else{
                    $this->addMessageFlash(1,'Vos Infos personnelles n\'ont pu etre modifié');
                }
            }elseif(isset($request['request']['email'])){
                $users = $userManager->updateAdress($request['request']['email'],$request['request']['adress'],$request['request']['postalCode'],$request['request']['city'],$request['session']['user']['id']);
                if($users['verif'] == 'ok'){
                    $request['session']['user']['email'] = $request['request']['email'];
                    $request['session']['user']['adress'] = $request['request']['adress'];
                    $request['session']['user']['postalCode'] = $request['request']['postalCode'];
                    $request['session']['user']['city'] = $request['request']['city'];
                    $this->addMessageFlash(0,'Vos coordonnées a été changé avec succés');
                }else{
                    $this->addMessageFlash(1,'Vos coordonnées n\'ont pu etre modifié');
                }
            }elseif(isset($request['session']['user']['email'])){
                $users = $userManager->updateSubscription($request['request']['subscription'],$request['request']['on'],$request['session']['user']['id']);

                if($users['verif'] == 'ok'){
                    $request['session']['user']['email'] = $request['request']['email'];
                    $request['session']['user']['adress'] = $request['request']['adress'];
                    $request['session']['user']['postalCode'] = $request['request']['postalCode'];
                    $request['session']['user']['city'] = $request['request']['city'];

                    $this->addMessageFlash(1,'Votre abonnement a été changé avec succés');
                }else{
                    $this->addMessageFlash(0,'Votre abonnement n\'a pas pu etre changé');
                }
            }


        }
        return [
            $request,
            'view' => 'src/Website/View/userProfil.html.php'
        ];
    }
}
