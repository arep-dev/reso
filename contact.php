<?php
	session_start();
	require 'fonction.php';
?>

<link rel="stylesheet" href="css/contact.css">

<div id="container" style="float:left; width:calc(100% - 10px); margin:10px;" class="fadeIn animated">

<div class="contact_bloc">
	<div class="contact_header">
		<div class="title">
            <i class="fa fa-envelope"></i>
            <h2>Contact</h2>
        </div>
	</div>
	<div class="contact_informations">
		<div id="premessage">
		Si vous rencontrez un problème sur le site ou vous avez une question sur le challenge/voyage, remplissez le formulaire ci-dessous, nous vous répondrons dans les plus brefs délais.
		</div>
		<input type="text" name="adresse" placeholder="Adresse">
		<textarea placeholder="Message" name="message"></textarea>
		<input type="submit" value="Envoyer">
	</div>
</div>

<div class="infos_bloc">
	<div class="adresses">
		<h3>Siplast</h3>
		<div class="ligneinfos"><i class="fa fa-home"></i>12, rue de la Renaissance<br>
		92184 Antony Cedex<br>
		France</div>
		<div class="ligneinfos"><i class="fa fa-phone"></i>+33 (0)1 40 96 35 00</div>
		<div class="ligneinfos"><i class="fa fa-fax"></i>+33 (0)1 46 66 24 85</div>
		<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style="width:100%; margin-top:10px;" height="150" src="https://maps.google.com/maps?hl=en&q=12, rue de la Renaissance, 92184, Antony, France&ie=UTF8&t=m&z=14&iwloc=B&output=embed"></iframe>
	</div>
	<div class="adresses">
		<h3>AREP</h3>
		<div class="ligneinfos"><i class="fa fa-home"></i>131 bis, rue de Billancourt<br>
		92120 Boulogne-Billancourt<br>
		France</div>
		<div class="ligneinfos"><i class="fa fa-phone"></i>+33 (0)1 85 74 00 00</div>
		<div class="ligneinfos"><i class="fa fa-fax"></i>+33 (0)1 85 74 00 70</div>
		<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style="width:100%; margin-top:10px;" height="150" src="https://maps.google.com/maps?hl=en&q=131 bis, rue de Billancourt, 92120, Boulogne-Billancourt, France&ie=UTF8&t=m&z=14&iwloc=B&output=embed"></iframe>
	</div>
</div>

</div>