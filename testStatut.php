<?php 
	ini_set('display_errors','on');
	error_reporting(E_ALL);

	class Bdd {

		public static $bdd;

		public function __construct() {}

	}

	class Profil extends Bdd {

		private $pro_num;
		private $last_pro_num;
		private $dependance;
		private $pro_statut;
		private $arrayInf;
		private $arrayAtc;
		private $arrayAgence;
		private $arraySecteur;
		private $arrayClient;

		public function __construct($pro_num) {

			$this->pro_num = $pro_num;
			$this->last_pro_num = $pro_num;
			self::setSup();
		}

		public function getSup() {
			return $this->sup;				
		}

		public function getProNum() {
			return $this->pro_num;
		}

		private function getLastProNum() {
			return $this->last_pro_num;
		}

		public function getDependance() {
			return $this->dependance;
		}

		private function setLastProNum($last_pro_num) {
			$this->last_pro_num = $last_pro_num;
		}

		private function setDependance($dependance) {
			$this->dependance = $dependance;
		}

		public function getDependance2() {
			return $this->dependance2;
		}

		private function setDependance2($dependance2) {
			$this->dependance2 = $dependance2;
		}

		private function getArrayInf() {
			return $this->arrayInf;
		}

		private function setArrayInf($arrayInf) {
			$this->arrayInf = $arrayInf;
		}

		private function setProStatut($pro_statut) {
			$this->pro_statut = $pro_statut;
		}

		public function getProStatut() {
			return $this->pro_statut;	
		}

		private function setArrayAtc($arrayAtc) {
			$this->arrayAtc = $arrayAtc;
		}

		private function setArrayAgence($arrayAgence) {
			$this->arrayAgence = $arrayAgence;
		}

		private function setArraySecteur($arraySecteur) {
			$this->arraySecteur = $arraySecteur;
		}

		private function setArrayClient($arrayClient) {
			$this->arrayClient = $arrayClient;
		}

		public function getArrayAtc() {
			return $this->arrayAtc;
		}

		public function getArrayAgence() {
			return $this->arrayAgence;
		}

		public function getArraySecteur() {
			return $this->arraySecteur;
		}

		public function getArrayClient() {
			return $this->arrayClient;
		}

		public function setInf() {
			$i = 0;
			$j = 0;
			while($i == 0) {	
				self::setLastProNum($this->pro_num);

				if($j == 0) {
						
					$sql = " SELECT PRO_NUM, PRO_STATUT FROM PROFIL WHERE PRO_NSUP = ? ";
					$req = Bdd::$bdd->prepare($sql);
					
					$req->execute(array(
						self::getLastProNum()
					));
				}else{
					$arrayInf = $this->getArrayInf();	
					$arrayInf = implode(',', array_map('add_quotes', $arrayInf));
					$sql = " SELECT PRO_NUM, PRO_STATUT FROM PROFIL WHERE PRO_NSUP IN (".$arrayInf.") ";
 					$req = Bdd::$bdd->prepare($sql);
					$req->execute(array());
				}

				$row = $req->fetchAll(PDO::FETCH_ASSOC);


				switch ($row[0]['PRO_STATUT']) {
					case 0:
						//echo 'charge client';
						foreach($row as $donnee) {
							$arrayClient[] = $donnee['PRO_NUM'];
						}
						break;
					case 1:
						//echo 'charge atc';
						foreach($row as $donnee) {
							$arrayAtc[] = $donnee['PRO_NUM'];
						}
						break;
					
					case 2:
						//echo 'charge agence';
						foreach($row as $donnee) {
							$arrayAgence[] = $donnee['PRO_NUM']; 
						}
						break;

					case 3: 
						//echo 'charge secteur';
						foreach($row as $donnee) {
							$arraySecteur[] = $donnee['PRO_NUM'];
						}
						break;
				}

				

				if($row[0]['PRO_STATUT'] == 0) {
					$i = 1; // Sortie de boucle
					if(isset($arrayClient)) {
						self::setArrayClient($arrayClient);	
					}
					if(isset($arrayAtc)) {
						self::setArrayAtc($arrayAtc);
					}
					if(isset($arrayAgence)) {
						self::setArrayAgence($arrayAgence);
					}	
					if(isset($arraySecteur)) {
						self::setArraySecteur($arraySecteur);
					}	
				}else{
					$arrayInf = array();
					foreach($row as $donnee) {	
						$arrayInf[] = $donnee['PRO_NUM'];
					}
					$j = 1;
					self::setArrayInf($arrayInf);		
				}
			}	
		}

		public function setSup() {
			$i = 0;	
			$j = 0;
			while($i == 0){	

				$sql = " SELECT PRO_NSUP, PRO_STATUT FROM PROFIL WHERE PRO_NUM =  ? ";
				$req = Bdd::$bdd->prepare($sql);
				
				$req->execute(array(
					self::getLastProNum()
				));

				$row = $req->fetch(PDO::FETCH_ASSOC);

				if($j == 0) {
					self::setProStatut($row['PRO_STATUT']);
					$j = 1 ;
				}

				if($row['PRO_NSUP'] == '0' || !isset($row['PRO_NSUP'])) {
					$i = 1;
					if(isset($dependance)) {
						self::setDependance($dependance);
					}	
				}else{
					self::setLastProNum($row['PRO_NSUP']);
					$dependance[] = $row['PRO_NSUP'];
				}

			}


			if(self::getProStatut() <> 0) {
				self::setInf();
			}

		}
	}

	function add_quotes($str) {
    	return sprintf("'%s'", $str);
	}
	

	define('USER', 'arep_CATB');
	define('HOST', '142.4.214.101');
	define('PASSWORD', 'arep-sa');
	define('DATABASE', 'RESO');

	Bdd::$bdd = new PDO('mysql:host='.HOST.';dbname='.DATABASE.'', USER, PASSWORD);

	if($_SERVER['REQUEST_METHOD'] == 'POST') {

		$profil = new Profil($_POST['profil']);
		$self = $profil->getProNum();
		$dependances = $profil->getDependance();
		$pro_statut = $profil->getProStatut();

		if($pro_statut <> 0) {
			$arrayClient = $profil->getArrayClient();
			
			$arrayAtc = $profil->getArrayAtc();
		
			$arrayAgence = $profil->getArrayAgence();
		
			$arraySecteur = $profil->getArraySecteur();

			switch ($pro_statut) {
				case 1:
					$clientLength = count($arrayClient);
					$i=1;
					echo '(';
					foreach($arrayClient as $client){
						echo '<strong>'.$client.'</strong>';
						if($i < $clientLength) {
							echo ', ';
							$i++;
						}
					}
					echo ')';
					echo ' ----> ';
					break;

				case 2:
					$clientLength = count($arrayClient);
					$i=1;
					echo '(';
					foreach($arrayClient as $client){
						echo '<strong>'.$client.'</strong>';
						if($i < $clientLength) {
							echo ', ';
							$i++;
						}
					}
					echo ')';
					echo ' ----> ';
					echo '(';
					$atcLength = count($arrayAtc);
					$i=1;	
					foreach($arrayAtc as $atc){
						echo '<strong>'.$atc.'</strong>';
						if($i < $atcLength) {
							echo ', ';
							$i++;
						}
					}
					echo ')';
					echo ' ----> ';
					break;

				case 3:
					$clientLength = count($arrayClient);
					$i=1;
					echo '(';
					foreach($arrayClient as $client){
						echo '<strong>'.$client.'</strong>';
						if($i < $clientLength) {
							echo ', ';
							$i++;
						}
					}
					echo ')';
					echo ' ----> ';
					echo '(';
					$atcLength = count($arrayAtc);
					$i=1;
					foreach($arrayAtc as $atc){
						echo '<strong>'.$atc.'</strong>';
						if($i < $atcLength) {
							echo ', ';
							$i++;
						}
					}
					echo ')';
					echo ' ----> ';
					echo '(';
					$agenceLength = count($arrayAgence);
					$i=1;
					foreach($arrayAgence as $agence){
						echo '<strong>'.$agence.'</strong>';
						if($i < $agenceLength) {
							echo ', ';
							$i++;
						}
					}
					echo ')';
					echo ' ----> ';
					break;

				case 4:	
					$clientLength = count($arrayClient);
					$i=1;
					echo '(';
					foreach($arrayClient as $client){
						echo '<strong>'.$client.'</strong>';
						if($i < $clientLength) {
							echo ', ';
							$i++;
						}
					}
					echo ')';
					echo ' ----> ';
					echo '(';
					$atcLength = count($arrayAtc);
					$i=1;
					foreach($arrayAtc as $atc){
						echo '<strong>'.$atc.'</strong>';
						if($i < $atcLength) {
							echo ', ';
							$i++;
						}
					}
					echo ')';
					echo ' ----> ';
					echo '(';
					$agenceLength = count($arrayAgence);
					$i=1;
					foreach($arrayAgence as $agence){
						echo '<strong>'.$agence.'</strong>';
						if($i < $agenceLength) {
							echo ', ';
							$i++;
						}
					}
					echo ')';
					echo ' ----> ';
					echo '(';
					$secteurLength = count($arraySecteur);
					$i=1;
					foreach($arraySecteur as $secteur){
						echo '<strong>'.$secteur.'</strong>';
						if($i < $secteurLength) {
							echo ', ';
							$i++;
						}
					}
					echo ')';
					echo ' ----> ';
					break;
			}
		}

		echo ' <strong style="color:red;">'.$self.'</strong> ';

		if(isset($dependances)) {
			echo ' ----> ';
			$i = 0;
			$lengthArray = count($dependances); 
			foreach ($dependances as $dependance) {
				$i++;
				echo '<strong>'.$dependance.'</strong>';
				if($i < $lengthArray) {
					echo ' ----> ';
				}
			}
		}


	}

?>

<form action="testStatut.php" method="post">
	<input type="text" name="profil" placeholder="Profil ..."><br>
	<input type="submit" name="send" value="chercher">
</form>	


<?php
	echo 'PRO NUM : '.$profil->getProNum().'<br>';
	echo	'PRO STATUT : '.$profil->getProStatut().'<br>';
	
?>