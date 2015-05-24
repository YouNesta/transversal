<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 15/05/15
 * Time: 21:57
 */

namespace Website\Controller;


class HomeController extends AbstractBaseController{

   public function __construct(){
        $this->getConnection();
    }
   public function showHomeAction(){

        return [
            'view' => 'src/Website/View/home.html.php'
        ];
    }
   public function showContactAction($request){
        if($request['request']){
            $destinataire = 'contact@evenir.fr';
            $sujet = "Contact Visiteur:".$request['request']['lastname'].' '.$request['request']['firstname'];
            $message = "Nom :".$request['request']['lastname']." \r\n";
            $message = $message."Adresse email : ".$request['request']['email']."\r\n";
            $message = $message."Message : ".$request['request']['comment'];
            $entete = 'From: '."contact@transversal.fr\r\n".
                'Reply-To: '."contact@transversal.fr\r\n".
                'X-Mailer: PHP/'.phpversion();
            if (mail($destinataire,$sujet,$message,$entete)){
                $this->addMessageFlash(0, 'Message envoyé avec succés');
                return [
                    'view' => 'src/Website/View/contact.html.php'
                ];

            } else {
                $this->addMessageFlash(1, 'Probleme avec l\'envoi du message');
                return [
                    'view' => 'src/Website/View/contact.html.php'
                ];

            }
        }
        return [
            'view' => 'src/Website/View/contact.html.php'
        ];
    }
}