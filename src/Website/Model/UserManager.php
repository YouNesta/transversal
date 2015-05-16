<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 15/05/15
 * Time: 23:21
 */
namespace Website\Model;

use Website\Controller\HomeController;

class UserManager extends HomeController{
    function __construct($param){

        $this->bdd = $this->getConnection();
    }
    function addUser($name, $pass, $email){
        $sql = 'INSERT INTO Users (name, password, email)
                VALUES (:name, :password, :email)';
        $statement = $this->bdd->prepare($sql);
        $statement->execute([
            'name' => $name,
            'password' => sha1($pass),
            'email' => $email
        ]);
    }

    function logUser($name, $pass){
        $sql = 'SELECT id,name ,password
                FROM users
                WHERE name = :name AND password = :password';
        $request = $this->bdd->prepare($sql);
        $request->execute([
            "name" => $name,
            "password" => $pass
        ]);
        return $request->fetch();
    }

    public function logOutAction($request)
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
            $request['session'] = array();
            return [
                'redirect_to' => 'index.php?p=home',
            ];

        }

    }
}