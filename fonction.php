<?php
    // Accès à la base de données.
    function myownlink()
    {
        $user="arep_CATB";
        $host="142.4.214.101";
        $password="arep-sa";
        $database="RESO";

        $myownlink = mysqli_connect("$host", "$user", "$password", "$database") or die ("Connexion impossible au serveur");
    
        return $myownlink;
    }

    // Chargement données de la table PROFIL.
    function chargement_profil($pro_num){

        $sql = 'SELECT * FROM PROFIL WHERE PRO_NUM = "'.$pro_num.'"';
        $result = mysqli_query(myownlink(),$sql);
        $donnees = mysqli_fetch_array($result);
              
            $profil = array(
                "PRO_CIVILITE" => $donnees["PRO_CIVILITE"],
                "PRO_NOM" => $donnees["PRO_NOM"],
                "PRO_PRENOM" => $donnees["PRO_PRENOM"],
                "PRO_MDP" => $donnees["PRO_MDP"],
                "PRO_JOUR_NAISSANCE" => $donnees["PRO_JOUR_NAISSANCE"],
                "PRO_MOIS_NAISSANCE" => $donnees["PRO_MOIS_NAISSANCE"],
                "PRO_ANNEE_NAISSANCE" => $donnees["PRO_ANNEE_NAISSANCE"],
                "PRO_NAISSANCE" => $donnees["PRO_NAISSANCE"],
                "CORRES_ADRESSE1" => $donnees["CORRES_ADRESSE1"],
                "CORRES_ADRESSE2" => $donnees["CORRES_ADRESSE2"],
                "CORRES_CP" => $donnees["CORRES_CP"],
                "CORRES_VILLE" => $donnees["CORRES_VILLE"],
                "CORRES_PAYS" => $donnees["CORRES_PAYS"],
                "PRO_EMAIL" => $donnees["PRO_EMAIL"],
                "PRO_TEL" => $donnees["PRO_TEL"],
                "PRO_MOB" => $donnees["PRO_MOB"],
                "PRO_FAX" => $donnees["PRO_FAX"],
                "SOC_NOM" => $donnees["SOC_NOM"],
                "SOC_SIREN" => $donnees["SOC_SIREN"],
                "SOC_STRUCTURE_JURIDIQUE" => $donnees["SOC_STRUCTURE_JURIDIQUE"],
                "SOC_ADRESSE1" => $donnees["SOC_ADRESSE1"],
                "SOC_ADRESSE2" => $donnees["SOC_ADRESSE2"],
                "SOC_CP" => $donnees["SOC_CP"],
                "SOC_VILLE" => $donnees["SOC_VILLE"],
                "SOC_PAYS" => $donnees["SOC_PAYS"],
                "SOC_TEL" => $donnees["SOC_TEL"],
                "SOC_FAX" =>  $donnees["SOC_FAX"],
                "SOC_MOB" => $donnees["SOC_MOB"],
                "SOC_EMAIL" => $donnees["SOC_EMAIL"],
                "SOC_SITE_WEB" => $donnees["SOC_SITE_WEB"],
                "SOC_NB_EMPLOYES" => $donnees["SOC_NB_EMPLOYES"],
                "SOC_ACHETEUR" => $donnees["SOC_ACHETEUR"],
                "SOC_ACHETEUR_EMAIL" => $donnees["SOC_ACHETEUR_EMAIL"],
                "SOC_ACHETEUR_MOB" => $donnees["SOC_ACHETEUR_MOB"]                
            );
        
            return $profil;
            
    }
    
    // Chargement de la table HOBBIE.
    function chargement_hobbie($pro_num){
        $sql = 'SELECT * FROM HOBBIES WHERE HOB_PRO_NUM = "'.$pro_num.'"';
        $result = mysqli_query(myownlink(), $sql);
        $donnees = mysqli_fetch_array($result);

        $sql = 'SELECT * FROM PARAMETRES';
        $result = mysqli_query(myownlink(), $sql);
        $donnees2 = mysqli_fetch_array($result);
                
            $hobbies = array(
                $donnees2["HOB_NAME1"] => $donnees["HOB_VAL1"],
                $donnees2["HOB_NAME2"] => $donnees["HOB_VAL2"],
                $donnees2["HOB_NAME3"] => $donnees["HOB_VAL3"],
                $donnees2["HOB_NAME4"] => $donnees["HOB_VAL4"],
                $donnees2["HOB_NAME5"] => $donnees["HOB_VAL5"],
                $donnees2["HOB_NAME6"] => $donnees["HOB_VAL6"]
            );
        
            return $hobbies;    
    }

    
    // Chargement de la table ACTIVITE_NAME ET ACTIVITE_VAL
    function get_activity_name(){
        $sql = 'SELECT * FROM PARAMETRES';
        $result = mysqli_query(myownlink(), $sql);
        $donnees = mysqli_fetch_array($result);
        
        $activite = array(
            "SOC_ACTIVITE1" => utf8_encode($donnees["ACTIVITY_NAME1"]),
            "SOC_ACTIVITE2" => utf8_encode($donnees["ACTIVITY_NAME2"]),
            "SOC_ACTIVITE3" => utf8_encode($donnees["ACTIVITY_NAME3"]),
            "SOC_ACTIVITE4" => utf8_encode($donnees["ACTIVITY_NAME4"]),
            "SOC_ACTIVITE5" => utf8_encode($donnees["ACTIVITY_NAME5"])
        );
        
        return $activite;
    }

    function get_activity_val($id){
        $sql = 'SELECT * FROM ACTIVITE WHERE SOC_PRO_NUM = "'.$id.'"';
        $result = mysqli_query(myownlink(), $sql);
        $donnees = mysqli_fetch_array($result);
        
        $activite = array(
            "SOC_QUOTE1" => $donnees["ACTIVITY_VAL1"],
            "SOC_QUOTE2" => $donnees["ACTIVITY_VAL2"],
            "SOC_QUOTE3" => $donnees["ACTIVITY_VAL3"],
            "SOC_QUOTE4" => $donnees["ACTIVITY_VAL4"],
            "SOC_QUOTE5" => $donnees["ACTIVITY_VAL5"]
        );
        
        return $activite;
    }


    function message_return($return){
        
        // Tableau des messages d'erreurs.
        // 100 - 199 messages success. VERT
        // 200 - 299 messages error. ROUGE
        // 300 - 399 messages error/success. ORANGE 
        $messageErreur = array(
        '100' => 'Modification effectuée avec succès.',
        '101' => 'Email envoyé avec succès, pensez à verifier vos spams.',
        '201' => 'Les deux mots de passe ne sont pas identiques.',
        '202' => 'Votre ancien mot de passe est incorrect.',
        '203' => 'Des champs ne sont pas remplis.',
        '204' => 'La somme des activités doit faire 100%.',
        '205' => 'Le fichier est trop volumineux',   
        '206' => 'Format de fichier non pris en charge.',   
        '207' => 'Vous devez charger un fichier.',   
        '208' => 'Les identifiants sont incorrects.',   
        '209' => 'Une erreur est survenue',   
        '301' => 'Attention, certains champs ne sont pas remplis.',
        '302' => 'La somme des activités doit faire 100%.'
        );
        
        $message = $messageErreur[$return];
        return $message;
        
    }

    function chargement_fidelite($id){
        // On charge les paramètres essentiels
        include('parametres.php');
        $parametres = chargement_parametres();

        $sql = 'SELECT * FROM RESULTATS WHERE RES_PRO_NUM = "'.$id.'" AND RES_PRO_MOIS != 0 ORDER BY RES_PRO_MOIS';
        $result = mysqli_query(myownlink(), $sql);
        
        $CA_TOTAL = 0;
        while($donnees = mysqli_fetch_array($result)) {
            $CA_TOTAL += $donnees['RES_PRO_RESULTAT'];
            $resultats[$donnees['RES_PRO_MOIS']] = $donnees['RES_PRO_RESULTAT'];
        }

        // Chargement resultats



        $sql = 'SELECT RES_PRO_RESULTAT FROM RESULTATS WHERE RES_PRO_NUM = "'.$id.'" AND RES_PRO_MOIS = 0';
        $result = mysqli_query(myownlink(), $sql);
        $donnees = mysqli_fetch_array($result);
        $donnees["RES_CA_REFERENCE"] = $donnees[0];
        //Pour modifier les pourcentages => TABLE PARAMETRE
        $euro_fidelite = $parametres["REGLE_FIDELITE"]*$CA_TOTAL;
        
        if($euro_fidelite > $parametres["REGLE_FIDELITE"]*$donnees["RES_CA_REFERENCE"])
        {
            $euro_fidelite = $parametres["REGLE_FIDELITE"]*$donnees["RES_CA_REFERENCE"];
        }
        
        
        //Progress bar
        $cout_voyage = cout_voyage($id);
        $euro_fidelite_percent = ($euro_fidelite * 100 ) / $cout_voyage;

        
        $euro_progression = $parametres["REGLE_PROGRESSION"]*($CA_TOTAL - $donnees['RES_CA_REFERENCE']);
        if($euro_progression < 0){$euro_progression = 0;}


        
        $euro_progression_percent = ($euro_progression*100)/($cout_voyage);
        $percent_total = $euro_fidelite_percent + $euro_progression_percent;      
        if($percent_total > 100){
            $euro_fidelite_percent = ($euro_fidelite_percent*100)/$percent_total;
            $euro_progression_percent = ($euro_progression_percent*100)/$percent_total;
        }
        
        //Chart 1
        $euro_fidelite_percent2 = (100*$CA_TOTAL)/$donnees['RES_CA_REFERENCE'];
        if($euro_fidelite_percent2 > 100){
            $euro_fidelite_percent2 = 100;
        }
        
        // Chart 2
        $euro_progression_percent2 = ($euro_progression*100)/($cout_voyage - $euro_fidelite);
        if($euro_progression_percent2 > 100){
            $euro_progression_percent2 = 100;    
        }
              
        //Calcul du pourcentage pour marqueur.
        $cout_restant = $cout_voyage - $euro_fidelite;
        $x = $cout_restant / $parametres["REGLE_PROGRESSION"];
        $total_ca = $donnees['RES_CA_REFERENCE'] + $x;
        $marqueur = (100*$CA_TOTAL)/$total_ca;
        
        $fidelite = array(
            "RES_CA_REFERENCE" => $donnees["RES_CA_REFERENCE"],
            "RES_CA_TOTAL" => $CA_TOTAL,
            "EURO_FIDELITE" => $euro_fidelite,
            "EURO_FIDELITE_PERCENT" => $euro_fidelite_percent,
            "EURO_PROGRESSION" => $euro_progression,
            "EURO_PROGRESSION_PERCENT" => $euro_progression_percent,
            "COUT_VOYAGE" => $cout_voyage,
            "EURO_PROGRESSION_PERCENT2" => $euro_progression_percent2, 
            "EURO_FIDELITE_PERCENT2" => $euro_fidelite_percent2, 
            "MARQUEUR" => $marqueur,
            "RESULTATS" => $resultats,
            "PARAMETRES" => $parametres
        );
        
        return $fidelite;
    }


    function cout_voyage($id){
        $sql = "SELECT * FROM VOYAGE WHERE VOY_PRO_NUM LIKE '".$id."'";
        $result = mysqli_query(myownlink(), $sql);
        $donnees = mysqli_fetch_array($result);
        
        $cout_voyage = $donnees['VOY_COUT'];
        
        return $cout_voyage;
    }

    function french_number($number){
        $frenchNumber = number_format($number, 2, ',', ' ');
        
        return $frenchNumber;
    }

    function chargement_voyage($id){
        $sql = 'SELECT * FROM OPERATION JOIN VOYAGE ON OPERATION.OPE_DOSSIER = VOYAGE.VOY_OPE WHERE VOYAGE.VOY_PRO_NUM = "'.$id.'"';
        $result = mysqli_query(myownlink(), $sql);
        while($donnees = mysqli_fetch_array($result)){
            $voyage = $donnees['OPE_WEB'];
        }

        return $voyage;
    }
	
	function chargement_voyage2($id){
        $sql = 'SELECT * FROM OPERATION JOIN VOYAGE ON OPERATION.OPE_DOSSIER = VOYAGE.VOY_OPE WHERE VOYAGE.VOY_PRO_NUM = "'.$id.'"';
        $result = mysqli_query(myownlink(), $sql);
        while($donnees = mysqli_fetch_array($result)){
            $baseline = $donnees['OPE_BASELINE'];
        }

        return $baseline;
    }

    function chargement_preference_voyage($id){
        $sql = 'SELECT * FROM VOYAGEUR WHERE VOY_PRO_NUM = "'.$id.'"';
        $result = mysqli_query(myownlink(), $sql);
        $i = 0;
        while($donnees = mysqli_fetch_array($result)){
            $accompagnant[$i] = array('id'=> $donnees['VOY_ID'], 'pro_num' => $donnees['VOY_PRO_NUM'], 'genre' => $donnees['VOY_ACC_GENRE'], 'nom' => $donnees['VOY_ACC_NOM'], 'prenom' => $donnees['VOY_ACC_PRENOM'], 'nationalite' => $donnees['VOY_ACC_NAT'], 'remarque' => $donnees['VOY_REMARQUE']);
            $i++;    
        }  

        return $accompagnant;    
    }

    function chargement_preference_voyage2($id){
        $sql = 'SELECT * FROM VOYAGE WHERE VOY_PRO_NUM = "'.$id.'"';
        $result = mysqli_query(myownlink(), $sql);
        while($donnees = mysqli_fetch_array($result)){
            $informations = array('date' => $donnees['VOY_DATE'], 'room' => $donnees['VOY_ROOM'], 'supplement' => $donnees['VOY_SUPSGL'], 'nb_acc' => $donnees['VOY_NB_ACC'], 'tarif' => $donnees['VOY_TARIF'], 'assurance' => $donnees['VOY_ASSURANCE'], 'cout_assurance' => $donnees['VOY_COUT_ASSURANCE'], 'total_assurance' => $donnees['VOY_TOTAL_ASSURANCE']);
        }

        return $informations;
    }

?>