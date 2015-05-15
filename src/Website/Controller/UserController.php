<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 15/05/15
 * Time: 22:54
 */
namespace Website\Controller;
use Website\Model\UserManager;

class UserController extends AbstractBaseController
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
            }
            else{

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
}
