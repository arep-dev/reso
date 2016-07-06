<link rel="stylesheet" href="css/mon-compte.css">

	
	
<div class="cols-1">
			
    <div class="bloc_container" id="moncompte-1">
	
        <div class="card"> 
            <div class="face front"> 
			
			
			
			
			
        <div class="title">
            <i class="fa fa-user"></i>
            <h2>Mon compte</h2>
        </div>
        <div class="data" id="data-bloc-1">
            <div id="photo">
                <?php
                    session_start();

                    $filename = 'img/profil/v_'.$_SESSION['PRO_NUM'].'.jpg';
                    if(file_exists($filename)){
                        $file = 'v_'.$_SESSION['PRO_NUM'].'.jpg';    
                    }else{
                        $filename = 'img/profil/v_'.$_SESSION['PRO_NUM'].'.png';
                        if(file_exists($filename)){
                            $file = 'v_'.$_SESSION['PRO_NUM'].'.png';        
                        }else{
							$filename = 'img/photo.jpg';
							echo '<div id="photo_carre" style="background:url(img/photo.jpg) no-repeat center; background-size:cover;"></div>';
						}
                    }
                ?>
				<div id="photo_carre" style="background:url(img/profil/<?php echo $file; echo '?'; echo time(); ?>) no-repeat center; background-size:cover;">
				</div>
            </div>
			<div class="btn_right">
				<button id="btn1">Modifier ma photo</button>
            	<button id="btn3">Modifier mes informations</button>
			</div>
            <div class="data-contain">
			
			<div class="data-contain-load">
                <?php
                    require('fonction.php');
                    $profil = chargement_profil($_SESSION["PRO_NUM"]);
                ?>
                <h3><?php echo $profil["PRO_CIVILITE"].' '.$profil["PRO_NOM"].' '.$profil["PRO_PRENOM"]; ?></h3><span>Né le <?php if($profil["PRO_NAISSANCE"] != ""){echo $profil["PRO_NAISSANCE"] ;}else{echo 'NC';}?></span>
                <h3>Adresse</h3><span><?php if(($profil["CORRES_ADRESSE1"] == "") && ($profil["CORRES_CP"] == "") && ($profil["CORRES_VILLE"] == "") && ($profil["CORRES_PAYS"] == "")){echo 'NC';}else{echo $profil["CORRES_ADRESSE1"].', '.$profil["CORRES_CP"].',  '.$profil["CORRES_VILLE"].', '.strtoupper($profil["CORRES_PAYS"]);}?></span>
				<span><iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style="width:calc(100% - 50px); margin-right:50px;" height="80" src="https://maps.google.com/maps?hl=en&q=<?php echo $profil["CORRES_ADRESSE1"].', '.$profil["CORRES_CP"].',  '.$profil["CORRES_VILLE"].', '.strtoupper($profil["CORRES_PAYS"]);?>&ie=UTF8&t=m&z=14&iwloc=B&output=embed" style="margin-top:4px;"></iframe></span>
                <h3>E-mail</h3><span><?php if($profil["PRO_EMAIL"] != ""){echo $profil["PRO_EMAIL"] ;}else{echo 'NC';}?></span>
                <h3>Téléphone fixe</h3><span><?php if($profil["PRO_TEL"] != ""){echo $profil["PRO_TEL"] ;}else{echo 'NC';}?></span>
                <h3>Téléphone mobile</h3><span><?php if($profil["PRO_MOB"] != ""){echo $profil["PRO_MOB"] ;}else{echo 'NC';}?></span>
				<h3>Vos centres d'intêrets</h3>
			</div>
				
            </div>
            <?php
                $hobbies = chargement_hobbie($_SESSION["PRO_NUM"]);
            ?>
            <form method="post" action="traitement.php" id="form_hobbies">
            <div id="hobbies_container">

                <?php
                    $i = 1;
                    foreach ($hobbies as $name => $value) {
                        if($value == 1) {
                            $var = 'style="display:block !important"';
                            $var2 = 'checked';
                        }else{
                            $var = 'style="display:none !important"';
                            $var2 = '';
                        }
                        echo '<div class="bloc_hobbies">
                                <div class="icon_hobbies golf"><i class="fa fa-map-pin"></i></div>
                                <i class="fa fa-check" '.$var.'></i>
                                <label for="hob'.$i.'" class="label_hobbies">
                                     '.$name.'
                                </label>
                                <input type="checkbox" name="hob'.$i.'" id="hob'.$i.'" value="value" '.$var2.'>
                            </div>';
                        $i++;    
                    }
                ?>
                
                <div class="clear"></div>
            <input type="hidden" name="traitement" value="hobbie">
            </form>
        </div>
		
		
    </div>
	</div>
            <div class="face back" id="back1"> 
				<div class="title">
					<i class="fa fa-user"></i>
					<h2>Mon compte</h2>
				</div>
				<div class="data" id="data-bloc-2">
					<iframe src="upload-photo.php" class="iframe" frameborder="0" height="300" width="100%" id="iframe-photo"></iframe>
	<button id="btn2">Annuler</button>
				</div>
            </div>
			<div class="face back" id="back2"> 
				<div class="title">
					<i class="fa fa-user"></i>
					<h2>Mon compte</h2>
				</div>
				<div class="data" id="data-bloc-3">
					<form method="post" id="form_moncompte">
					<h4>Identité</h4>
        <select name="civil" class="largeur4">
            <option value="M." <?php if($profil['PRO_CIVILITE'] == 'M.'){echo 'selected';}?>>M.</option>
            <option value="Mme" <?php if($profil['PRO_CIVILITE'] == 'Mme'){echo 'selected';}?>>Mme</option>
        </select>
        <input type="text" name="nom" maxlength="30" placeholder="Nom" class="largeur5" value="<?php echo $profil['PRO_NOM']; ?>">
        <input type="text" name="prenom" maxlength="30" placeholder="Prénom" class="largeur6" value="<?php echo $profil['PRO_PRENOM']; ?>"><br>
		<h4>Date de naissance</h4>
        <input type="text" name="date" placeholder="Date de naissance" class="largeur1" value="<?php echo $profil['PRO_NAISSANCE']; ?>"><br>
		<h4>Adresse</h4>
        <input type="text" name="adresse" placeholder="Adresse" class="largeur2" value="<?php echo $profil['CORRES_ADRESSE1']; ?>"><br>
        <input type="text" name="adresse2" placeholder="Adresse (suite)"  class="largeur3" value="<?php echo $profil['CORRES_ADRESSE2']; ?>"><br>
        <input type="text" name="cp" placeholder="Code Postal" class="largeur4" value="<?php echo $profil['CORRES_CP']; ?>"><br>
        <input type="text" name="ville" maxlength="30" placeholder="Ville" class="largeur5" value="<?php echo $profil['CORRES_VILLE']; ?>"><br>
        <input type="text" name="pays" maxlength="30" placeholder="Pays" class="largeur6" value="<?php echo $profil['CORRES_PAYS']; ?>"><br>
		<h4>Contact</h4>
        <input type="email" name="email" placeholder="E-mail" class="largeur7" value="<?php echo $profil['PRO_EMAIL']; ?>"><br>
        <input type="text" name="fixetel" placeholder="Téléphone fixe" class="largeur7" value="<?php echo $profil['PRO_TEL']; ?>"><br>
        <input type="text" name="mobtel" placeholder="Téléphone mobile" class="largeur8" value="<?php echo $profil['PRO_MOB']; ?>"><br>
        <input type="hidden" name="traitement" value="moncompte">
        <input type="submit" name="send" value="Modifier mes informations" form="form_moncompte" class="largeur2">
	<button id="btn4" class="largeur3">Annuler</button>
    </form>
				</div>
            </div> 
        </div> 
	</div>
    
    <div class="bloc_container">
        <div class="title">
            <i class="fa fa-lock"></i>
            <h2>Mes identifiants</h2>
        </div>
                <form method="post" id="form_pass">
			<div class="btn_right">
                <input type="submit" id="modif_id" name="" value="Modifier mes identifiants" form="form_pass">
			</div>
        <div class="data-id">
            <div class="data-contain">
                <h3>Votre identifiant</h3><span>Client</span>
                <h3>Ancien mot de passe</h3><span><input type="password" name="pass1"></span>
                <h3>Nouveau mot de passe</h3><span><input type="password" name="pass2"></span>
                <h3>Confirmer nouveau mot de passe</h3><span><input type="password" name="pass3"></span>
                    <br>
                    <br>
                    <input type="hidden" name="traitement" value="changepassword">
            </div>
            <div class="clear"></div>
        </div>
                </form>
    </div>
    

</div>

<div class="cols-2">
			
    <div class="bloc_container" id="moncompte-2">
	
        <div class="card"> 
            <div class="face front"> 
        <div class="title">
            <i class="fa fa-building"></i>
            <h2>Mon entreprise</h2>
        </div>
        <div class="data" id="data-bloc-4">
            <div id="logo-soc">
				<?php
					session_start();

					$filename = 'img/entreprise/v_'.$_SESSION['PRO_NUM'].'.jpg';
					if(file_exists($filename)){
						$file = 'v_'.$_SESSION['PRO_NUM'].'.jpg';    
					}else{
						$filename = 'img/entreprise/v_'.$_SESSION['PRO_NUM'].'.png';
						if(file_exists($filename)){
							$file = 'v_'.$_SESSION['PRO_NUM'].'.png';        
						}else{
							$filename = 'img/logo.jpg';
							echo '<div id="logo_carre" style="background:url(img/logo.jpg) no-repeat center; background-size:contain;"></div>';
						}
					}
				?>
				<div id="logo_carre" style="background:url(img/entreprise/<?php echo $file; echo '?'; echo time(); ?>) no-repeat center; background-size:contain;">
				</div>
            </div>
			<div class="btn_right">
				<button id="btn5">Modifier mon logo</button>
            	<button id="btn7">Modifier mes informations</button>
			</div>
            <div class="data-contain">
			<div class="data-contain-load">
						
                <h3>Entreprise</h3><span><?php echo $profil["SOC_NOM"]; ?></span>
                <h3>Structure juridique</h3><span><?php echo $profil["SOC_STRUCTURE_JURIDIQUE"]; ?></span>
                <h3>Siren</h3><span><?php echo $profil["SOC_SIREN"]; ?></span>
                <h3>Adresse professionnelle</h3><span><?php echo $profil["SOC_ADRESSE1"].', '.$profil["SOC_ADRESSE2"].', '.$profil["SOC_CP"].',  '.$profil["SOC_VILLE"].', '.strtoupper($profil["SOC_PAYS"]);?></span>
				<span><iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style="width:calc(100% - 50px); margin-right:50px;" height="80" src="https://maps.google.com/maps?hl=en&q=<?php echo $profil["SOC_ADRESSE1"].', '.$profil["SOC_ADRESSE2"].', '.$profil["SOC_CP"].',  '.$profil["SOC_VILLE"].', '.strtoupper($profil["SOC_PAYS"]);?>&ie=UTF8&t=m&z=14&iwloc=B&output=embed" style="margin-top:4px;"></iframe></span>
                <h3>Site web</h3><span><a href="http://<?php echo $profil["SOC_SITE_WEB"]; ?>" target="_blank"><?php echo $profil["SOC_SITE_WEB"]; ?></a></span>
                <h3>Téléphone fixe</h3><span><?php echo $profil["SOC_TEL"]; ?></span>
                <h3>Téléphone mobile</h3><span><?php echo $profil["SOC_MOB"]; ?></span>
                <h3>Fax</h3><span><?php echo $profil["SOC_FAX"]; ?></span>
				
				</div>
				
            </div>
            <div class="clear"></div>
        </div>
	</div>
            <div class="face back" id="back3"> 
				<div class="title">
            <i class="fa fa-building"></i>
            <h2>Mon entreprise</h2>
				</div>
				<div class="data" id="data-bloc-5">
					<iframe src="upload-logo.php" class="iframe" frameborder="0" height="300" width="100%" id="iframe-logo"></iframe>
	<button id="btn6">Annuler</button>
				</div>
            </div>
			<div class="face back" id="back4"> 
				<div class="title">
            <i class="fa fa-building"></i>
            <h2>Mon entreprise</h2>
				</div>
				<div class="data" id="data-bloc-6">
	
	
	
	
    <form method="post" id="form_entreprise">
        <h4>Entreprise</h4>
        <input type="text" name="nomentreprise" maxlength="50" placeholder="Entreprise" class="largeur1" value="<?php echo $profil['SOC_NOM']; ?>"><br>
        <input type="text" name="structure" placeholder="Structure juridique" class="largeur2" value="<?php echo $profil['SOC_STRUCTURE_JURIDIQUE']; ?>"><br>
        <input type="text" name="siren" placeholder="Siren" class="largeur3" value="<?php echo $profil['SOC_SIREN']; ?>"><br>    
        <h4>Adresse professionnelle</h4>
        <input type="text" name="adressepro" placeholder="Adresse professionnelle" class="largeur2" value="<?php echo $profil['SOC_ADRESSE1']; ?>"><br>         
        <input type="text" name="adressepro2" placeholder="Adresse (suite)" class="largeur3" value="<?php echo $profil['SOC_ADRESSE2']; ?>"><br>         
        <input type="text" name="cppro" placeholder="Code postal" class="largeur4" value="<?php echo $profil['SOC_CP']; ?>"><br>
        <input type="text" name="villepro" maxlength="30" placeholder="Ville" class="largeur5" value="<?php echo $profil['SOC_VILLE']; ?>"><br>
        <input type="text" name="payspro" maxlength="30" placeholder="Pays" class="largeur6" value="<?php echo $profil['SOC_PAYS']; ?>"><br>
        <h4>Contact</h4>
        <input type="text" name="site" placeholder="Site web" class="largeur2" value="<?php echo $profil['SOC_SITE_WEB']; ?>"><br>
        <input type="text" name="fixetelpro" placeholder="Téléphone fixe" class="largeur3" value="<?php echo $profil['SOC_TEL']; ?>"><br>
        <input type="text" name="mobtelpro" placeholder="Téléphone mobile" class="largeur2" value="<?php echo $profil['SOC_MOB']; ?>"><br>
        <input type="text" name="fax" maxlength="50" placeholder="Fax" class="largeur3" value="<?php echo $profil['SOC_FAX']; ?>"><br>
        <input type="hidden" name="traitement" value="entreprise">
        <input type="submit" name="send" value="Modifier mes informations" class="largeur2" form="form_entreprise">   
	<button id="btn8" class="largeur3">Annuler</button> 
    </form>
	
	
	
				</div>
            </div> 
        </div> 
	</div>
	
	
	

	
	
	<div class="bloc_container" id="moncompte-4">
	
        <div class="card"> 
            <div class="face front"> 
        <div class="title">
            <i class="fa fa-area-chart"></i>
            <h2>Mon activité</h2>
        </div>
        <div class="data" id="data-bloc-7">
			<div class="btn_right2">
            	<button id="btn9">Modifier mes informations</button>
			</div>
            <div class="data-contain">
			<div class="data-contain-load">
			
			
            <h3>Nombre de salarié</h3><span><?php echo $profil["SOC_NB_EMPLOYES"]; ?></span>
            <h3>Acheteur</h3><span><?php echo $profil["SOC_ACHETEUR"]; ?></span>
            <h3>E-mail</h3><span><?php echo $profil["SOC_ACHETEUR_EMAIL"]; ?></span>
            <h3>Téléphone mobile</h3><span><?php echo $profil["SOC_ACHETEUR_MOB"]; ?></span>
            <h3>N°Client</h3><span><?php echo $_SESSION["PRO_NUM"]; ?></span>
			
            <div id="container" style="width: calc(100% + 130px); margin:0; float:left;"></div>
			<script src="js/plug/highchart.js"></script> 	
				</div>
				
            </div>
            <div class="clear"></div>
        </div>
	</div>
			<div class="face back" id="back5"> 
				<div class="title">
            <i class="fa fa-area-chart"></i>
            <h2>Mon activité</h2>
				</div>
				<div class="data" id="data-bloc-8">
	
	<?php
    $activite = get_activity_name();
    $activite2 = get_activity_val($_SESSION['PRO_NUM']);
    ?>
	
	
	<form method="post" id="form_activite">
        <h4>Nombre de salarié</h4>
        <input type="text" name="nbsalarie" maxlenght="10" placeholder="Nombre de salarié" class="largeur1" value="<?php echo $profil['SOC_NB_EMPLOYES']; ?>">
        <h4>Acheteur</h4>
        <input type="text" name="acheteur" maxlenght="30" placeholder="Acheteur" class="largeur1" value="<?php echo $profil['SOC_ACHETEUR']; ?>">
        <h4>Contact</h4>
        <input type="text" name="mailacheteur" placeholder="E-mail" class="largeur2" value="<?php echo $profil['SOC_ACHETEUR_EMAIL']; ?>">
        <input type="text" name="mobile" placeholder="Téléphone mobile" class="largeur3" value="<?php echo $profil['SOC_ACHETEUR_MOB'] ?>">
        <h4>Activités</h4>
        
        <strong class="largeur9"><?php echo $activite['SOC_ACTIVITE1']; ?> (%)</strong>
        <input type="text" name="act1" maxlength="3" class="largeur10" placeholder="<?php echo $activite['SOC_ACTIVITE1']; ?>" value="<?php echo $activite2['SOC_QUOTE1']; ?>">
        
        <strong class="largeur9"><?php echo $activite['SOC_ACTIVITE2']; ?> (%)</strong>
        <input type="text" name="act2" maxlength="3" class="largeur10" placeholder="<?php echo $activite['SOC_ACTIVITE2']; ?>" value="<?php echo $activite2['SOC_QUOTE2']; ?>">
        
        <strong class="largeur9"><?php echo $activite['SOC_ACTIVITE3']; ?> (%)</strong>
        <input type="text" name="act3" maxlength="3" class="largeur10" placeholder="<?php echo $activite['SOC_ACTIVITE3']; ?>" value="<?php echo $activite2['SOC_QUOTE3']; ?>">
        
        <strong class="largeur9"><?php echo $activite['SOC_ACTIVITE4']; ?> (%)</strong>
        <input type="text" name="act4" maxlength="3" class="largeur10" placeholder="<?php echo $activite['SOC_ACTIVITE4']; ?>" value="<?php echo $activite2['SOC_QUOTE4']; ?>">
        
        <strong class="largeur9"><?php echo $activite['SOC_ACTIVITE5']; ?> (%)</strong>
        <input type="text" name="act5" maxlength="3" class="largeur10" placeholder="<?php echo $activite['SOC_ACTIVITE5']; ?>" value="<?php echo $activite2['SOC_QUOTE5']; ?>">
		
		
        
        <input type="hidden" name="traitement" value="activite">
        <input type="submit" name="send" value="Modifier mes informations" class="largeur2" form="form_activite"> 
	<button id="btn10" class="largeur3">Annuler</button> 
    </form>
	
	
	
				</div>
            </div> 
        </div> 
	</div>
	
	


<script src="js/script.js"></script>
<script src="js/upload.js"></script>
<script src="js/mon-compte-flip.js"></script>