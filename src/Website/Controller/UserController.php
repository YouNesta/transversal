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
                    'redirect_to' => 'index.php?p=show_addUser'
                ];
            }
        }
        return [
            'redirect_to' => 'index.php?p=show_addUser',
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

                return [
                    'redirect_to' => 'index.php?p=show_addUser',
                ];
            }
        }
        return [
            'redirect_to' => 'index.php?p=show_home'
        ];

    }
}