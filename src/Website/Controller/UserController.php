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

    public function logUserAction($request)
    {
        if ($request['request']) {
            $userManager = new UserManager($this->getConnection());
            $users = $userManager->logUser($request['request']['name'],$request['request']['password'] );
            if ($users) {
                $request['session']['user'] = $users;
                $this->addMessageFlash(0, 'Vous vous êtes connecté avec succés');
            }
            else{
                $this->addMessageFlash(1, 'Identifiants incorrect');
                return [
                    'redirect_to' => 'index.php?p=show_login',
                ];
                exit;
            }
        }
        return [
            'redirect_to' => 'index.php?p=show_home'
        ];

    }
    public function logOutAction($request)
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
            $request['session'] = array();
            return [
                'redirect_to' => 'index.php?p=show_home',
            ];

        }

    }
}
