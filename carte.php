<?php
    include('fonction.php');
    $profil = chargement_profil($_SESSION['PRO_NUM']);
?>
<div id="carte">
		<div id="deconnexion">
			<a href="deconnexion.php">DÉCONNEXION</a>
		</div>
		<div id="zone_depliable">
			<div id="fleche">
				<img src="img/fleche.png" />
			</div>
			<div id="infos">
				<span class="info"><?php echo $profil["PRO_CIVILITE"].' '.$profil["PRO_NOM"].' '.$profil["PRO_PRENOM"]; ?></span>
				<span class="info"><?php echo $profil["SOC_NOM"]; ?></span>
			</div>
			<div id="compte">
				MON COMPTE
			</div>
		</div>

		<div id="menu2" class="open">
		<?php

			switch($profil["PRO_STATUT"]) {
				case 0:
					?>
						<ul class="menus moncompte"><a href="mon-compte.php" class="load"><span class="ouvrir" id="moncompte">MON COMPTE</span></a></ul>
						<ul class="menus mesresultats"><a href="#mes-resultats.php" class="" id="gmesresultats"><span class="ouvrir" id="mesresultats">MES RÉSULTATS</span></a>
						<li class="ssmenus ssmesresultats"><a href="mes-resultats-board.php" class="load lien_gmesresultats">Tableau de bord</a></li>
						<li class="ssmenus ssmesresultats"><a href="mes-resultats-ca.php" class="load">Chiffres d'affaires</a></li>
						<li class="ssmenus ssmesresultats"><a href="regles-de-calcul.php" class="load">Règles de calcul</a></li>
						</ul>
						<ul class="menus monvoyage"><a href="#mon-voyage.php" class="" id="gmonvoyage"><span class="ouvrir" id="monvoyage">MON VOYAGE</span></a>
						<li class="ssmenus ssmonvoyage"><a href="mon-voyage.php" class="load lien_gmonvoyage">Mon voyage</a></li>
						<li class="ssmenus ssmonvoyage"><a href="mes-preferences-voyage.php" class="load">Mes préferences voyages</a></li>
						</ul>
						<ul class="menus etmoi"><a href="et-moi.php" class="load"><span class="ouvrir" id="etmoi">AREP & MOI</span></a></ul>
						<li class="ssmenus ssetmoi vide"></li>
						<ul class="menus contact"><a href="contact.php" class="load"><span class="ouvrir" id="contact">CONTACT</span></a></ul>
						<li class="ssmenus sscontact vide"></li>
					<?php
					break;
			}
 		?>
			
		</div>




		<div id="close" class="open">
			<i class="fa fa-times"></i>
		</div>
</div>
<script src="https://code.highcharts.com/highcharts.js"></script>