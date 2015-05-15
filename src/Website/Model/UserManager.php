<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 15/05/15
 * Time: 23:21
 */
namespace Website\Model;

class UserManager{
    function __construct($param){
        $this->bdd = $param;
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
}