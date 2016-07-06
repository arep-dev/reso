<?php 
    session_start();
    require('fonction.php');
    $traitement = $_POST['traitement'];
    $id = $_SESSION['PRO_NUM'];
    

    // Fichier d'intéraction entre formulaire et base de données. La variable du switch est déterminée dans chaque formulaires dans la value du champ HIDDEN.

    switch($traitement){
        case 'login':    
            
                if(isset($_POST['login']) && $_POST['login'] != '' && isset($_POST['pass']) && $_POST['pass'] != ''){
                    $login = htmlspecialchars($_POST['login']);
                    $pass = htmlspecialchars($_POST['pass']);

                    $requete = 'SELECT * FROM PROFIL WHERE PRO_NUM = "'.$login.'"';
                    $result = mysqli_query(myownlink(), $requete);
                    while($donnees = mysqli_fetch_array($result)){
                        if($donnees['PRO_MDP'] == $pass){
                            session_start();
                            $_SESSION['log'] = 1;
                            $_SESSION['PRO_NUM'] = $login;
                            
                            echo '{"redirect": "ok"}';
                            exit();
                        }    
                    }
                        $message = message_return('208');
                        echo '{"msg": "'.$message.'", "error": "208"}'; 
                }else{
                        $message = message_return('203');
                        echo '{"msg": "'.$message.'", "error": "203"}'; 
                }
                   
              

            break;
            
        case 'hobbie':
            // Checkbox hobbies
            
            $hob1 = 0;
            $hob2 = 0;
            $hob3 = 0;
            $hob4 = 0;
            $hob5 = 0;
            $hob6 = 0;
            
            if(isset($_POST['hob1'])){
                $hob1 = 1;
            }

            if(isset($_POST['hob2'])){
                $hob2 = 1;
            }

            if(isset($_POST['hob3'])){
                $hob3 = 1;
            }

            if(isset($_POST['hob4'])){
                $hob4 = 1;
            }

            if(isset($_POST['hob5'])){
                $hob5 = 1;
            }

            if(isset($_POST['hob6'])){
                $hob6 = 1;
            }
            
            
            $sql = 'SELECT * FROM HOBBIES WHERE HOB_PRO_NUM = "'.$id.'"';
            $result = mysqli_query(myownlink(),$sql);
            $i = 0;
            while($donnee = mysqli_fetch_array($result)){
                $i++;
            }

            if($i == 0){

                $sql = 'INSERT INTO HOBBIES (HOB_PRO_NUM,HOB_VAL1, HOB_VAL2, HOB_VAL3, HOB_VAL4, HOB_VAL5, HOB_VAL6 ) VALUES ("'.$id.'","'.$hob1.'","'.$hob2.'","'.$hob3.'","'.$hob4.'","'.$hob5.'","'.$hob6.'")'; 

                $result = mysqli_query(myownlink(),$sql);

            }else if($i > 0){

                $sql = 'UPDATE HOBBIES SET HOB_VAL1 = "'.$hob1.'", HOB_VAL2 = "'.$hob2.'", HOB_VAL3 = "'.$hob3.'", HOB_VAL4 = "'.$hob4.'", HOB_VAL5 = "'.$hob5.'", HOB_VAL6 = "'.$hob6.'" WHERE HOB_PRO_NUM = "'.$id.'"';

                $result = mysqli_query(myownlink(),$sql);
            }

            $message = message_return('100');
            echo '{"msg": "'.$message.'", "code": "100"}';
            
            break;
    
    
        case 'changepassword':
            // Changement de mot de passe.
            
            if(isset($_POST['pass1']) && isset($_POST['pass2']) && isset($_POST['pass3']) && $_POST['pass2'] != ''){
                $pass1 = htmlspecialchars($_POST['pass1']);    
                $pass2 = htmlspecialchars($_POST['pass2']);    
                $pass3 = htmlspecialchars($_POST['pass3']);
                
                $sql = 'SELECT PRO_MDP FROM PROFIL WHERE PRO_NUM="'.$id.'"';
                $result = mysqli_query(myownlink(), $sql);
                while($donnees = mysqli_fetch_array($result)){
                    $passtest = $donnees['PRO_MDP'];
                } 
                
                if($pass1 == $passtest){
                    
                    if($pass2 == $pass3){
                        
                        $sql = 'UPDATE PROFIL SET PRO_MDP = "'.$pass2.'" WHERE PRO_NUM="'.$id.'"';
                        $result = mysqli_query(myownlink(),$sql);
                        $message = message_return('100');
                        echo '{"msg": "'.$message.'", "code": "100"}';
                        break;
                        
                    }else{
                        $message = message_return('201');
                        echo '{"msg": "'.$message.'", "code": "201"}';
                        break;
                    }
                    
                }else{
                    $message = message_return('202');
                    echo '{"msg": "'.$message.'", "code": "202"}';
                    break;
                }
                
            }else{
                $message = message_return('203');
                echo '{"msg": "'.$message.'", "code": "203"}';
                break;
            }
            
            
        case 'moncompte':
                
            $civil = $_POST['civil'];
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $date = htmlspecialchars($_POST['date']);
            $adresse = htmlspecialchars($_POST['adresse']);
            $adresse2 = htmlspecialchars($_POST['adresse2']);
            $cp = htmlspecialchars($_POST['cp']);
            $ville = htmlspecialchars($_POST['ville']);
            $pays = htmlspecialchars($_POST['pays']);
            $email = htmlspecialchars($_POST['email']);
            $fixetel = htmlspecialchars($_POST['fixetel']);
            $mobtel = htmlspecialchars($_POST['mobtel']);
            

            if($_POST['email'] != '' && $_POST['nom'] != '' && $_POST['prenom'] != '' && $_POST['date'] != '' && isset($_POST['civil'])){
                if($_POST['adresse'] != '' && $_POST['cp'] != '' && $_POST['pays'] != '' && $_POST['ville'] != ''){
                    
                    $sql = 'UPDATE PROFIL SET PRO_CIVILITE = "'.$civil.'", PRO_NOM = "'.$nom.'", PRO_PRENOM = "'.$prenom.'", PRO_NAISSANCE = "'.$date.'", CORRES_ADRESSE1 = "'.$adresse.'", CORRES_ADRESSE2 = "'.$adresse2.'", CORRES_CP = "'.$cp.'", CORRES_VILLE = "'.$ville.'", CORRES_PAYS = "'.$pays.'", PRO_EMAIL = "'.$email.'", PRO_TEL = "'.$fixetel.'", PRO_MOB = "'.$mobtel.'" WHERE PRO_NUM = "'.$id.'"';
                    
                    $result = mysqli_query(myownlink(), $sql);
                    $message = message_return('100');
                    echo '{"msg": "'.$message.'", "code": "100", "reload": "mon-compte.php"}';
                    
                    break;
                    
                }else{
                    
                    $sql = 'UPDATE PROFIL SET PRO_CIVILITE = "'.$civil.'", PRO_NOM = "'.$nom.'", PRO_PRENOM = "'.$prenom.'", PRO_NAISSANCE = "'.$date.'", PRO_EMAIL = "'.$email.'", PRO_TEL = "'.$fixetel.'", PRO_MOB = "'.$mobtel.'" WHERE PRO_NUM = "'.$id.'"';
                    
                    $result = mysqli_query(myownlink(), $sql);
                    $message = message_return('301');
                    echo '{"msg": "'.$message.'", "code": "301", "reload": "mon-compte.php"}';
                    
                    break;        
                }
            }else{
                $message = message_return('203');
                echo '{"msg": "'.$message.'", "code": "203", "reload": "mon-compte.php"}';
                    
                break;
            }
            
            
            
        case 'entreprise':
            
            $nomentreprise = htmlspecialchars($_POST['nomentreprise']);
            $structure = htmlspecialchars($_POST['structure']);
            $siren = htmlspecialchars($_POST['siren']);
            $adressepro = htmlspecialchars($_POST['adressepro']);
            $adressepro2 = htmlspecialchars($_POST['adressepro2']);
            $cppro = htmlspecialchars($_POST['cppro']);
            $villepro = htmlspecialchars($_POST['villepro']);
            $payspro = htmlspecialchars($_POST['payspro']);
            $site = htmlspecialchars($_POST['site']);
            $fixetelpro = htmlspecialchars($_POST['fixetelpro']);
            $mobtelpro = htmlspecialchars($_POST['mobtelpro']);
            $fax = htmlspecialchars($_POST['fax']);
            
            if($_POST['nomentreprise'] != '' && $_POST['structure'] != '' && $_POST['siren'] != ''){
                if($_POST['adressepro'] != '' && $_POST['cppro'] != '' && $_POST['payspro'] != '' && $_POST['villepro'] != ''){     
                    
                    $sql = 'UPDATE PROFIL SET SOC_NOM = "'.$nomentreprise.'", SOC_STRUCTURE_JURIDIQUE = "'.$structure.'", SOC_SIREN = "'.$siren.'", SOC_ADRESSE1 = "'.$adressepro.'", SOC_ADRESSE2 = "'.$adressepro2.'", SOC_CP = "'.$cppro.'", SOC_VILLE = "'.$villepro.'", SOC_PAYS = "'.$payspro.'", SOC_SITE_WEB = "'.$site.'", SOC_TEL = "'.$fixetelpro.'", SOC_MOB = "'.$mobtelpro.'", SOC_FAX = "'.$fax.'" WHERE PRO_NUM = "'.$id.'"';
                    
                    $result = mysqli_query(myownlink(), $sql);
                    $message = message_return('100');
                    echo '{"msg": "'.$message.'", "code": "100", "reload": "mon-compte.php"}';
                    
                    break;
                    
                }else{
                    
                    $sql = 'UPDATE PROFIL SET SOC_NOM = "'.$nomentreprise.'", SOC_STRUCTURE_JURIDIQUE = "'.$structure.'", SOC_SIREN = "'.$siren.'", SOC_SITE_WEB = "'.$site.'", SOC_TEL = "'.$fixetelpro.'", SOC_MOB = "'.$mobtelpro.'", SOC_FAX = "'.$fax.'" WHERE PRO_NUM = "'.$id.'"';
                    
                    $result = mysqli_query(myownlink(), $sql);
                    $message = message_return('301');
                    echo '{"msg": "'.$message.'", "code": "301", "reload": "mon-compte.php"}';
                    
                    break; 
                    
                }        
            }else{
                $message = message_return('203');
                echo '{"msg": "'.$message.'", "code": "203", "reload": "mon-compte.php"}';
                    
                break;   
            }
            
            
        case 'getActivite':
            $sql = 'SELECT * FROM ACTIVITE WHERE SOC_PRO_NUM = "'.$id.'"';
            $result = mysqli_query(myownlink(), $sql);
            $donnees = mysqli_fetch_array($result);
            $sql2 = 'SELECT * FROM PARAMETRES';
            $result2 = mysqli_query(myownlink(), $sql2);
            $donnees2 = mysqli_fetch_array($result2);
            
            echo '{"quote1": "'.$donnees['ACTIVITY_VAL1'].'", "quote2": "'.$donnees['ACTIVITY_VAL2'].'", "quote3": "'.$donnees['ACTIVITY_VAL3'].'", "quote4": "'.$donnees['ACTIVITY_VAL4'].'", "quote5": "'.$donnees['ACTIVITY_VAL5'].'", "activite1": "'.$donnees2['ACTIVITY_NAME1'].'", "activite2": "'.utf8_encode($donnees2['ACTIVITY_NAME2']).'", "activite3": "'.$donnees2['ACTIVITY_NAME3'].'", "activite4": "'.$donnees2['ACTIVITY_NAME4'].'", "activite5": "'.utf8_encode($donnees2['ACTIVITY_NAME5']).'"}';
            
            break;
            
            
            
        case 'activite':
            $act1 = $_POST['act1'];        
            $act2 = $_POST['act2'];        
            $act3 = $_POST['act3'];        
            $act4 = $_POST['act4'];        
            $act5 = $_POST['act5'];
            
            $nbsalarie = $_POST['nbsalarie'];
            $acheteur = $_POST['acheteur'];
            $mailacheteur = $_POST['mailacheteur'];
            $mobile = $_POST['mobile'];
        
            if($nbsalarie != '' && $acheteur != '' && $mailacheteur != '' && $mobile != ''){
                
                $sql = 'UPDATE PROFIL SET SOC_NB_EMPLOYES = "'.$nbsalarie.'", SOC_ACHETEUR = "'.$acheteur.'", SOC_ACHETEUR_EMAIL = "'.$mailacheteur.'", SOC_ACHETEUR_MOB = "'.$mobile.'" WHERE PRO_NUM = "'.$id.'"';     
               
                $result = mysqli_query(myownlink(), $sql);
                
                if(intval($act1) + intval($act2) + intval($act3) + intval($act4) + intval($act5) == 100){
                    $sql = 'SELECT * FROM ACTIVITE_VAL WHERE SOC_PRO_NUM = "'.$id.'"';
                    $result = mysqli_query(myownlink(), $sql);
                    $count = 0;
                    while($donnees = mysqli_fetch_array($result)){
                        $count++;
                    }
                    
                    if($count == 0){
                        $sql = 'INSERT INTO ACTIVITE_VAL (SOC_PRO_NUM, SOC_QUOTE1, SOC_QUOTE2, SOC_QUOTE3, SOC_QUOTE4, SOC_QUOTE5) VALUES ("'.$id.'", "'.$act1.'", "'.$act2.'", "'.$act3.'", "'.$act4.'", "'.$act5.'")';
                        $result = mysqli_query(myownlink(), $sql);
                        
                        $message = message_return('100');
                        echo '{"msg": "'.$message.'", "code": "100", "reload": "mon-compte.php"}'; 
                        
                    }else{
                        $sql = 'UPDATE ACTIVITE_VAL SET SOC_QUOTE1 = "'.$act1.'", SOC_QUOTE2 = "'.$act2.'", SOC_QUOTE3 = "'.$act3.'", SOC_QUOTE4 = "'.$act4.'", SOC_QUOTE5 = "'.$act5.'"';
                        
                        $result = mysqli_query(myownlink(), $sql);
                        
                        $message = message_return('100');
                        echo '{"msg": "'.$message.'", "code": "100", "reload": "mon-compte.php"}'; 
                    }
                }else{
                    $message = message_return('302');
                    echo '{"msg": "'.$message.'", "code": "302", "reload": "mon-compte.php"}'; 
                }       
            }else{
                if(intval($act1) + intval($act2) + intval($act3) + intval($act4) + intval($act5) == 100){
                    $sql = 'SELECT * FROM ACTIVITE_VAL WHERE SOC_PRO_NUM = "'.$id.'"';
                    $result = mysqli_query(myownlink(), $sql);
                    $count = 0;
                    while($donnees = mysqli_fetch_array($result)){
                        $count++;
                    }
                    
                    if($count == 0){
                        $sql = 'INSERT INTO ACTIVITE_VAL (SOC_PRO_NUM, SOC_QUOTE1, SOC_QUOTE2, SOC_QUOTE3, SOC_QUOTE4, SOC_QUOTE5) VALUES ("'.$id.'", "'.$act1.'", "'.$act2.'", "'.$act3.'", "'.$act4.'", "'.$act5.'")';
                        $result = mysqli_query(myownlink(), $sql);
                        
                        $message = message_return('301');
                        echo '{"msg": "'.$message.'", "code": "301", "reload": "mon-compte.php"}'; 
                        
                    }else{
                        $sql = 'UPDATE ACTIVITE_VAL SET SOC_QUOTE1 = "'.$act1.'", SOC_QUOTE2 = "'.$act2.'", SOC_QUOTE3 = "'.$act3.'", SOC_QUOTE4 = "'.$act4.'", SOC_QUOTE5 = "'.$act5.'"';
                        
                        $result = mysqli_query(myownlink(), $sql);
                        
                        $message = message_return('301');
                        echo '{"msg": "'.$message.'", "code": "301", "reload": "mon-compte.php"}'; 
                    }        
                }else{
                    $message = message_return('204');
                    echo '{"msg": "'.$message.'", "code": "204", "reload": "mon-compte.php"}';     
                } 
            }
            
            break;
            
        case 'upload-photo':
            
            $extension = array('image/jpeg','image/png','image/jpg','image/gif');

            $fichier = $_FILES['file']['name'];
            $extensionFile = pathinfo($fichier, PATHINFO_EXTENSION);
            $ftype = $_FILES['file']['type'];
            
            $uploadfile = 'img/profil/'.$id.'.'.$extensionFile.'';
            $uploadthumb = 'img/profil/v_'.$id.'.'.$extensionFile.'';
            if($_FILES['file']['name'] != ''){
            if(in_array($_FILES['file']['type'], $extension)){
                if($_FILES['file']['size'] < 5000000){
                    
                    unlink('img/profil/'.$id.'.jpg');
                    unlink('img/profil/'.$id.'.png');
                    unlink('img/profil/'.$id.'.gif');
                    unlink('img/profil/v_'.$id.'.jpg');
                    unlink('img/profil/v_'.$id.'.png');
                    unlink('img/profil/v_'.$id.'.gif');
       
                    move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile); 
                    
                    $mySource = $uploadfile;
                    $myThumb = $uploadthumb;

                    // Calcul des nouvelles dimensions
                    list($width, $height) = getimagesize($mySource);

                    $Ratiox = 120/$width;
                    $Ratioy = 120/$height;

                    $percent = ($Ratiox < $Ratioy) ? $Ratiox : $Ratioy; // $percent prend la valeur du plus petit ratio

                    $new_width = $width*$percent;
                    $new_height = $height*$percent;

                    // Redimensionnement
                    $thumb = imagecreatetruecolor($new_width, $new_height);

                    //crée une image à partir du type source
                    if (strstr($ftype, "gif")){$image = imagecreatefromgif($mySource);}
                    else if (strstr($ftype, "jpeg")){$image = imagecreatefromjpeg($mySource);}
                    else if (strstr($ftype, "png")){$image = imagecreatefrompng($mySource);}

                    //Copy le contenu de l'image
                    imagecopyresampled($thumb, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                    // Enregistre le fichier
                    @imagejpeg($thumb, $myThumb,50);
                  
                    
                    $_SESSION['check-upload'] = 'OK';
                    $message = message_return('100');
                    $_SESSION['msg_upload'] = $message;
                    $_SESSION['code_upload'] = 100;
                    
                    header('Location: upload-photo.php');
                    
                }else{
                    $_SESSION['check-upload'] = 'OK';
                    $message = message_return('205');
                    $_SESSION['msg_upload'] = $message;
                    $_SESSION['code_upload'] = 205;
                    
                    header('Location: upload-photo.php');
                }
            }else{
                $_SESSION['check-upload'] = 'OK';
                $message = message_return('206');
                $_SESSION['msg_upload'] = $message;
                $_SESSION['code_upload'] = 206;

                header('Location: upload-photo.php');   
            }
            
            }else{
                $_SESSION['check-upload'] = 'OK';
                $message = message_return('207');
                $_SESSION['msg_upload'] = $message;
                $_SESSION['code_upload'] = 207;

                header('Location: upload-photo.php');    
            }
            
            break;
            
        case 'upload-logo':
            
            $extension = array('image/jpeg','image/png','image/jpg','image/gif');

            $fichier = $_FILES['file']['name'];
            $extensionFile = pathinfo($fichier, PATHINFO_EXTENSION);
            $ftype = $_FILES['file']['type'];
                
            $uploadfile = 'img/entreprise/'.$id.'.'.$extensionFile.'';
            $uploadthumb = 'img/entreprise/v_'.$id.'.'.$extensionFile.'';
            if($_FILES['file']['name'] != ''){
            if(in_array($_FILES['file']['type'], $extension)){
                if($_FILES['file']['size'] < 5000000){
                    
                    unlink('img/entreprise/'.$id.'.jpg');
                    unlink('img/entreprise/'.$id.'.png');
                    unlink('img/entreprise/'.$id.'.gif');
                    unlink('img/entreprise/v_'.$id.'.jpg');
                    unlink('img/entreprise/v_'.$id.'.png');
                    unlink('img/entreprise/v_'.$id.'.gif');
       
                    move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile); 
                    
                    
                    $mySource = $uploadfile;
                    $myThumb = $uploadthumb;

                    // Calcul des nouvelles dimensions
                    list($width, $height) = getimagesize($mySource);

                    $Ratiox = 120/$width;
                    $Ratioy = 120/$height;

                    $percent = ($Ratiox < $Ratioy) ? $Ratiox : $Ratioy; // $percent prend la valeur du plus petit ratio

                    $new_width = $width*$percent;
                    $new_height = $height*$percent;

                    // Redimensionnement
                    $thumb = imagecreatetruecolor($new_width, $new_height);

                    //crée une image à partir du type source
                    if (strstr($ftype, "gif")){$image = imagecreatefromgif($mySource);}
                    else if (strstr($ftype, "jpeg")){$image = imagecreatefromjpeg($mySource);}
                    else if (strstr($ftype, "png")){$image = imagecreatefrompng($mySource);}

                    //Copy le contenu de l'image
                    imagecopyresampled($thumb, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                    // Enregistre le fichier
                    @imagejpeg($thumb, $myThumb,50);
                    
                    
                    $_SESSION['check-upload'] = 'OK';
                    $message = message_return('100');
                    $_SESSION['msg_upload'] = $message;
                    $_SESSION['code_upload'] = 100;
                    
                    header('Location: upload-logo.php');
                    
                }else{
                    $_SESSION['check-upload'] = 'OK';
                    $message = message_return('205');
                    $_SESSION['msg_upload'] = $message;
                    $_SESSION['code_upload'] = 205;
                    
                    header('Location: upload-logo.php');
                }
            }else{
                $_SESSION['check-upload'] = 'OK';
                $message = message_return('206');
                $_SESSION['msg_upload'] = $message;
                $_SESSION['code_upload'] = 206;

                header('Location: upload-logo.php');    
            }
                
            }else{
                $_SESSION['check-upload'] = 'OK';
                $message = message_return('207');
                $_SESSION['msg_upload'] = $message;
                $_SESSION['code_upload'] = 207;

                header('Location: upload-logo.php');    
            }
            
            break;
            
        case 'delete':
            
            $target = $_POST['target'];
            if($target == 'logo'){
                unlink('img/entreprise/'.$id.'.jpg');
                unlink('img/entreprise/'.$id.'.png');
                unlink('img/entreprise/'.$id.'.gif');
                unlink('img/entreprise/v_'.$id.'.jpg');
                unlink('img/entreprise/v_'.$id.'.png');
                unlink('img/entreprise/v_'.$id.'.gif');
                
                $_SESSION['check-upload'] = 'OK';
                $message = message_return('100');
                $_SESSION['msg_upload'] = $message;
                $_SESSION['code_upload'] = 100;

                header('Location: upload-logo.php');
                
            }else if($target == 'photo'){
                unlink('img/profil/'.$id.'.jpg');
                unlink('img/profil/'.$id.'.png');
                unlink('img/profil/'.$id.'.gif');
                unlink('img/profil/v_'.$id.'.jpg');
                unlink('img/profil/v_'.$id.'.png');
                unlink('img/profil/v_'.$id.'.gif');  
                
                $_SESSION['check-upload'] = 'OK';
                $message = message_return('100');
                $_SESSION['msg_upload'] = $message;
                $_SESSION['code_upload'] = 100;

                header('Location: upload-photo.php');
                
            }
            
            break;
            
            
        case 'getCa':
            
            $sql = 'SELECT * FROM FIDELITE WHERE RES_PRO_NUM = "'.$id.'"';
            $result = mysqli_query(myownlink(), $sql);
            
            $donnees = mysqli_fetch_array($result);
            
            $annee = 16;
            
            echo '{"ca1" : "'.$donnees['RES_CA_01_'.$annee.''].'", "ca2" : "'.$donnees['RES_CA_02_'.$annee.''].'", "ca3" : "'.$donnees['RES_CA_03_'.$annee.''].'", "ca4" : "'.$donnees['RES_CA_04_'.$annee.''].'", "ca5" : "'.$donnees['RES_CA_05_'.$annee.''].'", "ca6" : "'.$donnees['RES_CA_06_'.$annee.''].'", "ca7" : "'.$donnees['RES_CA_07_'.$annee.''].'", "ca8" : "'.$donnees['RES_CA_08_'.$annee.''].'", "ca9" : "'.$donnees['RES_CA_09_'.$annee.''].'", "ca10" : "'.$donnees['RES_CA_10_'.$annee.''].'", "ca11" : "'.$donnees['RES_CA_11_'.$annee.''].'", "ca12" : "'.$donnees['RES_CA_12_'.$annee.''].'", "caRef" : "'.$donnees['RES_CA_REFERENCE'].'"}';
            
            break;
    }    
?>