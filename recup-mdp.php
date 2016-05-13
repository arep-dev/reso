<?php
    include('fonction.php');

    if(isset($_POST['identifiant']) && $_POST['identifiant'] != ''){
        $id = $_POST['identifiant'];
        
        $profil = chargement_profil($id);
        if(isset($profil['PRO_EMAIL']) && $profil['PRO_EMAIL'] != ''){
            
            $to = $profil['PRO_EMAIL'];
            $nom = $profil['PRO_NOM'];
            $prenom = $profil['PRO_PRENOM'];
            $mdp = $profil['PRO_MDP'];
    
            $subject = 'Mot de passe oublié';
            $message = 'Bonjour '.$prenom.' '.strtoupper($nom).'.'."<br>".'Suite à la perte de votre mot de passe, voici vos identifiants :'. "<br><br>" . 'Identifiant : '.$id.''. "<br>" . 'Mot de passe : '.$mdp.'' ;
            

            $headers  = 'MIME-Version: 1.0' . "\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\n";

            $headers .= 'From: Siplast <noreply@arep.co.com>' . "\n";
            
            if(mail($to, $subject, $message, $headers)){
                $message = message_return('101');
                echo '{"msg": "'.$message.'", "code": "101"}';
            }else{
                $message = message_return('209');
                echo '{"msg": "'.$message.'", "code": "209"}';
            }

        }else{
            $message = message_return('208');
            echo '{"msg": "'.$message.'", "code": "208"}';
        }
        
    }else{
        $message = message_return('203');
        echo '{"msg": "'.$message.'", "code": "203"}';
    }

?>