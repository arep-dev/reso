<?php
	session_start();
	require 'fonction.php';
	// On récupère la liste des accompagnants avec le PRO_NUM
	$accompagnant = chargement_preference_voyage($_SESSION['PRO_NUM']);
	$informations = chargement_preference_voyage2($_SESSION['PRO_NUM']);
	$cout_voyage = cout_voyage($_SESSION['PRO_NUM']);
	$voyage = chargement_voyage($_SESSION['PRO_NUM']);
?>

<link rel="stylesheet" href="css/mes-preferences-voyage.css">

<style>
#voyage{
        /* On utilise la variable $voyage pour charger le background en fonction du bon voyage */
        background: url(img/background<?php echo $voyage; ?>.jpg); 
        background-size: cover;
		}
</style>

<div id="container" style="float:left; width:calc(100% - 10px); margin:10px;" class="fadeIn animated">
<div id="voyage">
	<?php echo ucfirst($voyage); ?><br>
	<span id="datevoyage"><?php echo $informations['date']; ?></span>
</div>


<div id="blocinfos">
<div class="infos">
	<div><i class="fa fa-bed"></i></div>
	<div><span class="titre">Type de chambre</span><?php echo $informations['room']; if($informations['supplement'] > 0){echo ' + suppl. SGL';} ?></div>
</div>
<div class="infos">
	<div><i class="fa fa-users"></i></div>
	<div><span class="titre">Nombre de voyageurs</span><?php echo $informations['nb_acc']; ?></div>
</div>
<div class="infos">
	<div><i class="fa fa-eur"></i></div>
	<div><span class="titre">Tarif voyage / personne</span><?php echo french_number($informations['tarif']); ?> €</div>
</div>
<div class="infos">
	<div><i class="fa fa-pencil-square-o"></i></div>
	<div><span class="titre">Assurance annulation</span><?php if($informations['assurance'] == 0){echo 'NON';}else{echo 'OUI';} ?>
	<?php 
		if($informations['assurance'] >= 1){
		?>	
		<br><?php echo $informations['nb_acc']; ?> x <?php echo french_number($informations['cout_assurance']); ?> € soit <?php echo french_number($informations['cout_assurance']*$informations['nb_acc']); ?>
		€
		<?php
		}
		?></div>
</div>
<div class="infos">
	<div><i class="fa fa-eur"></i></div>
	<div><span class="titre">Coût total (hors assurance annulation)</span><?php echo french_number($cout_voyage); if($informations['supplement'] > 0){echo '(dont suppl. SGL = '.french_number($informations['supplement']).'';} ?> €
		<?php
		if($informations['assurance'] >= 1){
		?>	
		<br><?php echo french_number(($informations['cout_assurance']*$informations['nb_acc'])+$cout_voyage); ?> €
		<?php
		}
		?></div>
</div>
</div>

<div class="voyageurs" id="moncompte-1">
	<div class="card"> 
    	<div class="face front"> 
			<div class="voyageurs_header">
				<div class="voyageurs_ligne voyageurs_titre">Voyageurs</div>
			</div>
			<div class="voyageurs_informations" id="data-bloc-1">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<?php 
					// On charge les infos des accompagnants stockés dans un tableau à deux dimensions. voir fonction.php
					for($i = 0; $i < count($accompagnant); $i++){
						echo '<tr>
						<td style="width:30px;"><img src="img/pays/'.$accompagnant[$i]['nationalite'].'.gif"></td>
						<td>'.$accompagnant[$i]['genre'].' '.$accompagnant[$i]['prenom'].' '.$accompagnant[$i]['nom'].'</td>
						<td class="options" id="btn2_'.$i.'" bloc="upload" acc="'.$i.'"><i class="fa fa-upload"></i></td>
						<td class="options" id="btn1_'.$i.'" bloc="remarque" acc="'.$i.'"><i class="fa fa-info-circle"></i></td>
						</tr>
						';
					}
				?>
				</table>
			</div>
		</div>
		<div class="face back" id="back1"> 
				<div class="voyageurs_header">
					<div class="voyageurs_ligne voyageurs_titre">Remarques</div>
				</div>
				<div class="voyageurs_informations" id="data-bloc-2">
					<button id="btn2">Annuler</button>
					<form method="post">
						<input type="hidden" name="acc" value="">
 						<div id="textarea">

						</div>
					</form>
				</div>
		</div>
		<div class="face back" id="back2"> 
				<div class="voyageurs_header">
					<div class="voyageurs_ligne voyageurs_titre">Envoyer votre pièce d'identité</div>
				</div>
				<div class="voyageurs_informations" id="data-bloc-3">
					<button id="btn4">Annuler</button>
			</div>
		</div> 
	</div>
</div>
<div id="liencontact">
	Si vous souhaitez modifier ces informations, merci de contacter Maria Manuel RIVIERE de l'agence AREP au 01 85 74 00 33 ou par en utilisant <a href="#">le formulaire de contact</a>.
</div>
</div>
<script src="js/mon-compte-flip.js"></script>
<script>

$(function(){
	
	//count = <?php echo count($accompagnant);?>;

	$('.options').click(function(){
		bloc = $(this).attr('bloc');
		acc = $(this).attr('acc');
		backFlip(bloc, acc);
	});

	function backFlip(bloc, acc) {

		accompagnant = <?php echo json_encode($accompagnant) ?> ; 
		id = accompagnant[acc]['id'];
		remarque = accompagnant[acc]['remarque'];
		pronum = accompagnant[acc]['pro_num'];

		if(bloc == 'remarque') {
			
			$(".back").css("display","none");
			$('#back1 input[type=hidden]').attr('value', id);
			$('#back1 #textarea').html('<textarea>'+remarque+'</textarea>');
			$("#back1").css("display","block");
			$("#moncompte-1").css("z-index","9999999999");
			$("#moncompte-1").find(".card").addClass("flipped");
			setTimeout(function(){
				$("#moncompte-1").css("z-index","1");
			},2000);
			return false;	
		}	

		if(bloc == 'upload') {

			$.ajax({
				url: 'get-img-id.php',
				data: 'GET',
				data: 'id='+pronum+'&acc='+acc,
				success: function(response) {
					console.log(response);
				},
				error: function(a,b,c) {
					console.log('Ajax error: '+ a +' / '+ b + '/ '+ c);
				}
			});




			$(".back").css("display","none");
			$("#back2").css("display","block");
			$("#moncompte-1").css("z-index","9999999999");
			$("#moncompte-1").find(".card").addClass("flipped");
			setTimeout(function(){
				$("#moncompte-1").css("z-index","1");
			},2000);
			return false;		
		}
	}

});	
</script>



