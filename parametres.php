<?php 
	function chargement_parametres() {
		$user="arep_CATB";
		$host="142.4.214.101";
		$password="arep-sa";
		$database="PARAMETRES_CHALLENGE";

		$bdd = mysqli_connect("$host", "$user", "$password", "$database") or die ("Connexion impossible au serveur");

		$sql = 'SELECT * FROM PARAMETRES WHERE NAME="reso"';

		$query = mysqli_query($bdd, $sql);
		$donnees = mysqli_fetch_array($query);

		$parametres = array(
			"DUREE_CHALLENGE" => $donnees["DUREE_CHALLENGE"],
			"DEBUT_CHALLENGE" => $donnees["DEBUT_CHALLENGE"],
			"REGLE_FIDELITE" => $donnees["REGLE_FIDELITE"],
			"REGLE_PROGRESSION" => $donnees["REGLE_PROGRESSION"]
		);

		return $parametres;
	}

?>