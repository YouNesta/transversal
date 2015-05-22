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
                FROM users';

        $statement = $this->bdd->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    function getUser($id){

        $sql = 'SELECT *
                FROM users
                WHERE id = :id';

        $statement = $this->bdd->prepare($sql);
        $statement->execute([
            'id' => $id
        ]);
        return $statement->fetch();
    }
    function addUser($lastname, $firstname, $birth, $email, $pass, $passCheck,$adress,$ville, $postalCode,$subscription){
        $verifForm = 'ok';
        $errorLog = [];
        if(!empty($lastname)){}else{
            $errorLog[]="Vous n'avez pas renseigné votre nom";
            $verifForm = 'no';
        }
        if(!empty($firstname)){}else{

            $errorLog[]="Vous n'avez pas renseigné votre prenom";
            $verifForm = 'no';
        }
        if(!empty($birth)){}else{
            $errorLog[]="Vous n'avez pas renseigné votre Date de naissance";
            $verifForm = 'no';
        }
        if(!empty($email)){

            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            } else {
                $errorLog[]="Vous n'avez pas renseigné un email valide";
                $verifForm = 'no';
            }

        }else{
            $errorLog[]="Vous devez renseigner votre adresse email";
            $verifForm = 'no';
        }
        if(!empty($pass)){
            if($pass != $passCheck){
                $errorLog[]="Votre mot de passe est incorrect";
            }
        }else{
            $errorLog[]="Vous devez renseigner votre un mots de passe";
            $verifForm = 'no';
        }
        if(!empty($adress)){}else{
            $errorLog[]="Vous n'avez pas renseigné votre adresse";
            $verifForm = 'no';
        }
        if(!empty($ville)){}else{
            $errorLog[]="Vous n'avez pas renseigné votre Ville";
            $verifForm = 'no';

        }
        if(!empty($postalCode)){}else{
            $errorLog[]="Vous n'avez pas renseigné votre code postal";
            $verifForm = 'no';
        }
        if(empty($subscription)){
            $errorLog[]="Vous n'avez pas renseigner votre types d'abonnement";
            $verifForm = 'no';
        }
        if($verifForm == 'no'){
            return [
                'verifForm'=> $verifForm,
                'errorLog' => $errorLog
            ];
        }else{

            $sql = 'INSERT INTO users (lastname, firstname,birthday, email, password,  adress, city, postalCode, subscription)
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
                return [
                    'verifForm'=> $verifForm,
                    'mailCheck' => 'yes'
                ];
            } else {
                return [
                    'verifForm'=> $verifForm,
                    'mailCheck' => 'no'
                ];
            }
            echo "'Veuillez cliquez sur ce <a href=\"index.php?p=user_enable&enableUser=".sha1($email)."\">lien d'activation</a>'";
        }
}


    function logUser($email, $pass){
        $sql = 'SELECT id, email,lastname ,firstname,email,birthday,adress,city,postalCode,subscription,stateAccount, stateSubscription
                FROM users
                WHERE email = :email AND password = :password';
        $request = $this->bdd->prepare($sql);
        $request->execute([
            "email" => $email,
            "password" => sha1($pass),

        ]);
        $result = $request->fetch();
        if( $result){
            $sql = 'SELECT *
                FROM subscription
                WHERE id = :id';
            $request = $this->bdd->prepare($sql);
            $request->execute([
                "id" => $result['subscription']
            ]);
            $result['subscription'] = $request->fetch();
        }
        return $result;
    }
    function enableUser($hashMail){

        $sql = 'SELECT email, stateAccount,firstname,email,password,birthday,adress,city,postalCode,subscription
                FROM users';
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
                $this->bdd->update('users', array('stateAccount' => '12'), array('email' => $value['email']));
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

    function updateAccount($lastname,$firstname, $birthday, $id){
        $update = $this->bdd->update('users', array('lastname'=>$lastname,'firstname'=>$firstname,'birthday'=> $birthday), array('id' => $id));
        if($update){
            return [
                'verif' => 'ok'];
        }else{
            return [
                'verif' => 'no'];
        }

        }
    function updateAdress($email, $adress, $postalCode, $city, $id){
        $update = $this->bdd->update('users', array('email'=>$email,'adress' => $adress,'postalCode' => $postalCode,'city' => $city), array('id' => $id));
        if($update){
            return [
                'verif' => 'ok'];
        }else{
            return [
                'verif' => 'no'];
        }
    }
    function updateSubscription($subscription, $subscriptionState, $id){
        $update = $this->bdd->update('users', array('subscription'=>$subscription,'stateSubscription'=>$subscriptionState), array('id' => $id));
        if($update){
            return [
                'verif' => 'ok'];
        }else{
            return [
                'verif' => 'no'];
        }
    }
}