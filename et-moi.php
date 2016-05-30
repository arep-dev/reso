<?php
	session_start();
	require 'fonction.php';
?>

<link rel="stylesheet" href="css/et-moi.css">

<div id="container" style="float:left; width:calc(100% - 10px); margin:10px; height:calc(100% - 20px);" class="fadeIn animated">

<div style="float:left; width:50%; margin:14px;">

	<div id="premessage">
	Déplacez votre curseur sur la carte ci-dessous pour afficher les agences par régions.
	</div>

    <div id="francemap" style="width: 100%; height: 500px;"></div>

</div>

<div class="etmoi_bloc">
	<div class="etmoi_header">
		<div class="title">
            <i class="fa fa-users"></i>
            <h2>Mes contacts</h2>
        </div>
	</div>
	<div class="etmoi_informations">
		<div class="photo">
			<div class="photo_carre">
				<iframe class="iframemap" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style="width:100px; height:100px;" src="https://maps.google.com/maps?hl=en&q=Île de France&ie=UTF8&t=m&z=14&iwloc=B&output=embed"></iframe>
			</div>
		</div>
		<div style="float:left; width:calc(100% - 140px); margin-left:20px; margin-bottom:20px; height:120px;">
		<h3>Ma région</h3>
		ÎLE DE FRANCE
		</div>
		<div class="photo">
			<div class="photo_carre">
				<iframe class="iframemap" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style="width:100px; height:100px;" src="https://maps.google.com/maps?hl=en&q=94110 Arcueil&ie=UTF8&t=m&z=14&iwloc=B&output=embed"></iframe>
			</div>
		</div>
		<div style="float:left; width:calc(100% - 140px); margin-left:20px; margin-bottom:20px; height:120px;">
		<h3>Mon secteur</h3>
		ARCUEIL
		</div>
		<div class="photo"> 
			<div class="photo_carre">
				<iframe class="iframemap" src="https://www.google.com/maps/embed?pb=!1m0!3m2!1sfr!2sfr!4v1456146508448!6m8!1m7!1sHUAauzgoDZmIECXlaFA1jg!2m2!1d48.76117532132638!2d2.299236028173028!3f245.53334273299484!4f-6.087429209336065!5f0.400414248925198" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style="width:100px; height:100px;"></iframe>
			</div>
		</div>
		<div style="float:left; width:calc(100% - 140px); margin-left:20px; margin-bottom:20px; height:120px;">
		<h3>Mon agence</h3>
		ARCUEIL SECTEUR SUD<br>33 avenue Paul Doumer<br>94110 Arcueil<br>01 46 85 95 96<br>contact-arcueil@siplast.fr
		</div>
		<div class="photo">
			<div class="photo_carre" style="background:url(img/photo.jpg) no-repeat center; background-size:cover;">
			</div>
		</div>
		<div style="float:left; width:calc(100% - 140px); margin-left:20px; margin-bottom:20px; height:120px;">
		<h3>Mon ATC</h3>
		COFFIN ERIC<br>06 33 51 51 86<br>eric.coffin@siplast.fr
		</div>
	</div>
</div>

</div>

<script src="js/jquery.vmap.js" type="text/javascript"></script>
<script src="js/jquery.vmap.france.js" type="text/javascript"></script>
<script src="js/jquery.vmap.colorsFrance.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	
	var $head = $("iframe").contents().find("head");                
$head.append($("<link/>", 
    { rel: "stylesheet", href: "css/et-moi.css", type: "text/css" }));
	
	
	$('#francemap').vectorMap({
		map: 'france_fr',
		hoverOpacity: 0.5,
		hoverColor: "#fff",
		backgroundColor: "#ffffff",
		color: "#239ed6",
		borderColor: "#ffffff",
		selectedColor: "#239ed6",
		enableZoom: true,
		showTooltip: true,
		onRegionOver: function(element, code, region)
		{		 
			if(region == 'Nord-Pas-de-Calais'){
				$('.jqvmap-label').html('<strong>Nord-Pas-de-Calais</strong><br>Agence n°1 - 01 42 36 52 12<br>Agence n°2 - 01 46 88 20 35<br>Agence n°3 - 01 46 11 38 98<br>Agence n°4 - 01 68 36 14 52<br>Agence n°5 - 01 55 68 40 20');
			}
			if(region == 'Picardie'){
				$('.jqvmap-label').html('<strong>Picardie</strong><br>Agence n°1 - 01 42 36 52 12<br>Agence n°2 - 01 46 88 20 35<br>Agence n°3 - 01 46 11 38 98');
			}
			if(region == 'Haute-Normandie'){
				$('.jqvmap-label').html('<strong>Haute-Normandie</strong><br>Agence n°1 - 01 42 36 52 12<br>Agence n°2 - 01 46 88 20 35<br>Agence n°3 - 01 46 11 38 98');
			}
			if(region == 'Basse-Normandie'){
				$('.jqvmap-label').html('<strong>Basse-Normandie</strong><br>Agence n°1 - 01 42 36 52 12<br>Agence n°2 - 01 46 88 20 35<br>Agence n°3 - 01 46 11 38 98<br>Agence n°4 - 01 68 36 14 52');
			}
			if(region == 'Île-de-France'){
				$('.jqvmap-label').html('<strong>Île-de-France</strong><br>Agence n°1 - 01 42 36 52 12<br>Agence n°2 - 01 46 88 20 35');
			}
			if(region == 'Bretagne'){
				$('.jqvmap-label').html('<strong>Bretagne</strong><br>Agence n°1 - 01 42 36 52 12<br>Agence n°2 - 01 46 88 20 35');
			}
			if(region == 'Champagne-Ardenne'){
				$('.jqvmap-label').html('<strong>Champagne-Ardenne</strong><br>Agence n°1 - 01 42 36 52 12<br>Agence n°2 - 01 46 88 20 35<br>Agence n°3 - 01 46 11 38 98');
			}
			if(region == 'Alsace'){
				$('.jqvmap-label').html('<strong>Alsace</strong><br>Agence n°1 - 01 42 36 52 12<br>Agence n°2 - 01 46 88 20 35<br>Agence n°3 - 01 46 11 38 98');
			}
			if(region == 'Pays de la Loire'){
				$('.jqvmap-label').html('<strong>Pays de la Loire</strong><br>Agence n°1 - 01 42 36 52 12<br>Agence n°2 - 01 46 88 20 35<br>Agence n°3 - 01 46 11 38 98<br>Agence n°4 - 01 68 36 14 52<br>Agence n°5 - 01 55 68 40 20');
			}
			if(region == 'Centre'){
				$('.jqvmap-label').html('<strong>Centre</strong><br>Agence n°1 - 01 42 36 52 12<br>Agence n°2 - 01 46 88 20 35<br>Agence n°3 - 01 46 11 38 98<br>Agence n°4 - 01 68 36 14 52');
			}
			if(region == 'Bourgogne'){
				$('.jqvmap-label').html('<strong>Bourgogne</strong><br>Agence n°1 - 01 42 36 52 12<br>Agence n°2 - 01 46 88 20 35<br>Agence n°3 - 01 46 11 38 98<br>Agence n°4 - 01 68 36 14 52');
			}
			if(region == 'Rhône-Alpes'){
				$('.jqvmap-label').html('<strong>Rhône-Alpes</strong><br>Agence n°1 - 01 42 36 52 12<br>Agence n°2 - 01 46 88 20 35');
			}
			if(region == 'Aquitaine'){
				$('.jqvmap-label').html('<strong>Aquitaine</strong><br>Agence n°1 - 01 42 36 52 12<br>Agence n°2 - 01 46 88 20 35<br>Agence n°3 - 01 46 11 38 98');
			}
			if(region == 'Provence-Alpes-Côte d\'Azur'){
				$('.jqvmap-label').html('<strong>Provence-Alpes-Côte d\'Azur</strong><br>Agence n°1 - 01 42 36 52 12<br>Agence n°2 - 01 46 88 20 35<br>Agence n°3 - 01 46 11 38 98');
			}
			if(region == 'Corse'){
				$('.jqvmap-label').html('<strong>Corse</strong><br>Agence n°1 - 01 42 36 52 12<br>Agence n°2 - 01 46 88 20 35<br>Agence n°3 - 01 46 11 38 98');
			}
			if(region == 'Midi-Pyrénées'){
				$('.jqvmap-label').html('<strong>Midi-Pyrénées</strong><br>Agence n°1 - 01 42 36 52 12<br>Agence n°2 - 01 46 88 20 35<br>Agence n°3 - 01 46 11 38 98');
			}
			if(region == 'Languedoc-Roussillon'){
				$('.jqvmap-label').html('<strong>Languedoc-Roussillon</strong><br>Agence n°1 - 01 42 36 52 12<br>Agence n°2 - 01 46 88 20 35<br>Agence n°3 - 01 46 11 38 98<br>Agence n°4 - 01 68 36 14 52<br>Agence n°5 - 01 55 68 40 20');
			}
			if(region == 'Lorraine'){
				$('.jqvmap-label').html('<strong>Lorraine</strong><br>Agence n°1 - 01 42 36 52 12<br>Agence n°2 - 01 46 88 20 35<br>Agence n°3 - 01 46 11 38 98');
			}
			if(region == 'Limousin'){
				$('.jqvmap-label').html('<strong>Limousin</strong><br>Agence n°1 - 01 42 36 52 12<br>Agence n°2 - 01 46 88 20 35<br>Agence n°3 - 01 46 11 38 98');
			}
			if(region == 'Poitou-Charentes'){
				$('.jqvmap-label').html('<strong>Poitou-Charentes</strong><br>Agence n°1 - 01 42 36 52 12<br>Agence n°2 - 01 46 88 20 35');
			}
			if(region == 'Auvergne'){
				$('.jqvmap-label').html('<strong>Auvergne</strong><br>Agence n°1 - 01 42 36 52 12<br>Agence n°2 - 01 46 88 20 35<br>Agence n°3 - 01 46 11 38 98<br>Agence n°4 - 01 68 36 14 52');
			}
			if(region == 'Franche-Comté'){
				$('.jqvmap-label').html('<strong>Franche-Comté</strong><br>Agence n°1 - 01 42 36 52 12<br>Agence n°2 - 01 46 88 20 35<br>Agence n°3 - 01 46 11 38 98<br>Agence n°4 - 01 68 36 14 52');
			}
		}
	});
});
</script>