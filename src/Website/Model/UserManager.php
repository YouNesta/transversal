<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 15/05/15
 * Time: 23:21
 */
namespace Website\Model;


use Website\Controller\UserController;

class UserManager extends UserController{
    function __construct($param){

        $this->bdd = $this->getConnection();
    }
    function getUsers(){

        $sql = 'SELECT *
                FROM Users';

        $statement = $this->bdd->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    function getUser($id){

        $sql = 'SELECT *
                FROM Users
                WHERE id = :id';

        $statement = $this->bdd->prepare($sql);
        $statement->execute([
            'id' => $id
        ]);
        return $statement->fetch();
    }
    function addUser($lastname, $firstname, $birth, $email, $pass, $passCheck,$adress,$ville, $postalCode,$subscription){
        $verifForm = 'ok';

        if(!empty($lastname)){}else{
            $this->addMessageFlash(1, "Vous n'avez pas renseigné votre nom");
            $verifForm = 'no';
        }
        if(!empty($firstname)){}else{
            $this->addMessageFlash(1, "Vous n'avez pas renseigné votre prenom");
            $verifForm = 'no';
        }
        if(!empty($birth)){}else{
            $this->addMessageFlash(1, "Vous n'avez pas renseigné votre Date de naissance");
            $verifForm = 'no';
        }
        if(!empty($email)){

            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            } else {
                $this->addMessageFlash(1, "Vous n'avez pas renseigné un email valide");
                $verifForm = 'no';
            }


        }else{
            $this->addMessageFlash(1, "Vous devez renseigner votre adresse email");
            $verifForm = 'no';
        }
        if(!empty($pass)){
            if($pass != $passCheck){
                $this->addMessageFlash(1, "Votre mot de passe est incorrect");
            }
        }else{
            $this->addMessageFlash(1, "Vous devez renseigner votre un mots de passe");
            $verifForm = 'no';
        }
        if(!empty($adress)){}else{
            $this->addMessageFlash(1, "Vous n'avez pas renseigné votre adresse");
            $verifForm = 'no';
        }
        if(!empty($ville)){}else{
            $this->addMessageFlash(1, "Vous n'avez pas renseigné votre Ville");
            $verifForm = 'no';

        }
        if(!empty($postalCode)){}else{
            $this->addMessageFlash(1, "Vous n'avez pas renseigné votre code postal");
            $verifForm = 'no';
        }
        if(empty($subscription)){
            $this->addMessageFlash(1, "Vous n'avez pas renseigner votre types d'abonnement");
            $verifForm = 'no';
        }
        if($verifForm == 'no'){
            return $verifForm;
        }else{

            $sql = 'INSERT INTO Users (lastname, firstname,birthday, email, password,  adress, city, postalCode, subscription)
                VALUES (:lastname, :firstname,:birthday, :email, :password,  :adress, :city, :postalCode, :subscription)';
            $statement = $this->bdd->prepare($sql);
            $statement->execute([
                'lastname' => $lastname,
                'firstname'=> $firstname,
                'email' => $email,
                'password' => sha1($pass),
                'birthday' => $birth,
                'adress' => $adress,
                'city' => $ville,
                'postalCode' => $postalCode,
                'subscription' => $subscription
            ]);


            $destinataire ='boulkaddid.younes@gmail.com';
            $sujet = "Lien d'activation";
            $message = "Nom : Transversal \r\n";
            $message = $message."Adresse email : boulkaddid.younes@gmail.com\r\n";
            $message = $message."Message : "."Veuillez cliquez sur ce <a href=\"index.php?p=user_enable&enableUser=".sha1($email)."\">lien d'activation</a> pour verifiez votre adresse email\r\n";
            $entete = 'From: '."contact@transversal.fr\r\n".
                'Reply-To: '."contact@transversal.fr\r\n".
                'X-Mailer: PHP/'.phpversion();
            if (mail($destinataire,$sujet,$message,$entete)){
                $this->addMessageFlash(0, "un mail vient d'etre envoyé, pour confirmer votre inscription");

                return $verifForm;
            } else {
                $this->addMessageFlash(1, "Un probleme est survenur lors de l'inscription, veuillez reessayer ultérieurement");
                return $verifForm = 'no';
            }
            echo "'Veuillez cliquez sur ce <a href=\"index.php?p=user_enable&enableUser=".sha1($email)."\">lien d'activation</a>'";
        }
}


    function logUser($email, $pass){
        $sql = 'SELECT id, email ,firstname,email,birthday,adress,city,postalCode,subscription,password, stateAccount
                FROM Users
                WHERE email = :email AND password = :password';
        $request = $this->bdd->prepare($sql);
        $request->execute([
            "email" => $email,
            "password" => sha1($pass),

        ]);
        return $request->fetch();
    }
    function enableUser($hashMail){

        $sql = 'SELECT email, stateAccount,firstname,email,password,birthday,adress,city,postalCode,subscription
                FROM Users';
        $request = $this->bdd->prepare($sql);
        $request->execute();
       $result = $request->fetchAll();

        foreach ($result as $value){

            if(sha1($value['email']) == $hashMail) {
                if($value['stateAccount'] == 1){
                    $this->addMessageFlash(1, "Vous avez déja valider votre email");
                    return [
                        'verif' => 'no'];
                }
                $this->bdd->update('Users', array('stateAccount' => '12'), array('email' => $value['email']));
                return [
                    'verif' => 'yes',
                    'users' => $value];
                break;
            }else{
                $this->addMessageFlash(1, "Votre lien ne correspond a aucun compte");
                return [
                    'verif' => 'no'];
            }
        }


    }
    function deleteUser($email){
        $this->bdd->delete('user', array('name' => $email));
    }

}