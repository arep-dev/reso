<?php 

	function chargement_parametres() {
		$sql = 'SELECT * FROM PARAMETRES';

		$query = mysqli_query(myownlink(), $sql);
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