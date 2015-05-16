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
                $this->addMessageFlash(0, "Votre mot de passe est incorrect");
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


            $destinataire =$email;
            $sujet = "Lien d'activation";
            $message = "Nom : Transversal \r\n";
            $message += "Adresse email : contact@transversal.fr\r\n";
            $message += "Message : "."Veuillez cliquez sur ce lien d'activation pour verifiez votre adresse email\r\n";
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
        }
}


    function logUser($email, $pass){
        $sql = 'SELECT email ,password
                FROM Users
                WHERE email = :email AND password = :password';
        $request = $this->bdd->prepare($sql);
        $request->execute([
            "email" => $email,
            "password" => sha1($pass)
        ]);
        return $request->fetch();
    }


}