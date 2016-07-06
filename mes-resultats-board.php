<?php 
	ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();
    include('fonction.php');
    date_default_timezone_set('Europe/Paris');
    $mois_en_cours = date('n');
    $fidelite = chargement_fidelite($_SESSION['PRO_NUM']);
?>
<link rel="stylesheet" href="css/mes-resultats.css">
<div id="container" style="float:left; width:calc(100% - 264px); margin:10px;" class="fadeIn animated">
	<input type="text" id="input_device" name="input_device" />
	<div id="titre_page"><i class="fa fa-arrow-circle-right"></i> Mes résultats</div>
	
	<div id="mes_resultats_container">
	
	
		<div class="mes_resultats" id="mesresultats_mois">
			<div class="mes_resultats_header" id="soustractionmesresultats" style="">
				<div class="mes_resultats_ligne mes_resultats_titre">CA mois par mois</div>
			</div>
			<div class="mes_resultats_informations mesresultatshauteur1">
				<table width="100%" border="0" cellspacing="0">
				<?php

					$parametres = $fidelite["PARAMETRES"];
					foreach ($fidelite["RESULTATS"] as $key => $value) {
						$resultats[] = $value;
					}

					$moyenne = 0;
					$count = 0;
					foreach ($resultats as $key => $value) {
						$moyenne += $value; 
						$count++;
					}

					$caProject = $moyenne / $count;

					$count = 0;
					$stop = 0;
					$count2 = 0;
					$limite = ($parametres["DEBUT_CHALLENGE"] + $parametres['DUREE_CHALLENGE']) ;
					for($i = $parametres["DEBUT_CHALLENGE"]; $i < $limite; $i++) {
						
						if($i == 13) { 
							$i = 1;
						}
						if($stop == 0) {
							echo '<tr>';
							echo '<td class="paddingmois">'.$i.'</td>';

							echo '<td class="paddingmois">'.$resultats[$count].'</td>';
							echo '</tr>';
						}else{
							echo '<tr>';
							echo '<td class="paddingmois">'.$i.'</td>';
	
							echo '<td class="paddingmois" style="font-weight:bolder;">'.$caProject.'**</td>';
							echo '</tr>';

							$count2++;
						}
						if($count == ($parametres['DUREE_CHALLENGE'] - 1)) {
							break;
						}

						if($i == $mois_en_cours) {
							$stop = 1;
						}

						$count++;
					}

					$caProject2 = ($caProject * $count2) + $fidelite["RES_CA_TOTAL"];
            
				?>
				</table>
			</div>
		</div>

		<div id="globalmesresultats">
		
			<div class="mes_resultats mesresultats1">
				<div class="mes_resultats_header" style="">
					<div class="mes_resultats_ligne mes_resultats_titre">CA de référence</div>
				</div>
				<div class="mes_resultats_informations mesresultatshauteur2">
					<?php echo french_number($fidelite['RES_CA_REFERENCE']); ?> €
				</div>
			</div>
			
			<div class="mes_resultats mesresultats1">
				<div class="mes_resultats_header" style="">
					<div class="mes_resultats_ligne mes_resultats_titre">CA à ce jour</div>
				</div>
				<div class="mes_resultats_informations mesresultatshauteur2">
					<?php echo french_number($fidelite['RES_CA_TOTAL']); ?> €
				</div>
			</div>
			
			<div class="mes_resultats mesresultats2">
				<div class="mes_resultats_header" style="">
					<div class="mes_resultats_ligne mes_resultats_titre">CA de projection</div>
				</div>
				<div class="mes_resultats_informations mesresultatshauteur2" style="font-style:italic;">
					
                    <?php
                    	echo french_number($caProject2).' €**';
                    ?>
                    
				</div>
			</div>
			
			<div class="mes_resultats mesresultats3">
				<div class="mes_resultats_header" style="">
					<div class="mes_resultats_ligne mes_resultats_titre">A ce jour, vos €V vous permettent de financer 34 % de votre séminaire.</div>
				</div>
				<div class="mes_resultats_informations mesresultatshauteur3">
					<div id="mesresultatspourcentzero">0 %</div><div id="mesresultatspourcentcent">100 %</div>
					<div id="mesresultatsbarreglobal">
						<div id="mesresultatsbarre_fidelite" style="width:0%"></div><div id="mesresultatsbarre_progression" style="width:0%"></div>
					</div>
					<div id="pourcent" style="margin-left:0%;">
						0 %
					</div>
				</div>
			</div>
			
			<div class="mes_resultats mesresultats1">
				<div class="mes_resultats_header" style="">
					<div class="mes_resultats_ligne mes_resultats_titre">€V Fidélité</div>
				</div>
				<div class="mes_resultats_informations mesresultatshauteur4">
					<div style="float:left; width:100%; height:100px;" class="chart-container">
                        <span class="chart" data-percent="<?php echo floor($fidelite['EURO_FIDELITE_PERCENT2']); ?>">  
		          <span class="percent plugin first"></span>
	               </span>
                    </div>
					<?php echo french_number($fidelite['EURO_FIDELITE']); ?> €V*
				</div>
			</div>
			
			<div class="mes_resultats mesresultats1">
				<div class="mes_resultats_header" style="">
					<div class="mes_resultats_ligne mes_resultats_titre">€V Progression</div>
				</div>
				<div class="mes_resultats_informations mesresultatshauteur4">
					<div style="float:left; width:100%; height:100px;" class="chart-container">
                    <span class="chart2" data-percent="<?php echo floor($fidelite['EURO_PROGRESSION_PERCENT2']); ?>">  
		          <span class="percent plugin first"></span>
	               </span>    
                    </div>
					<?php echo french_number($fidelite['EURO_PROGRESSION']); ?> €V
				</div>
			</div>
			
			<div class="mes_resultats mesresultats2">
				<div class="mes_resultats_header" style="">
					<div class="mes_resultats_ligne mes_resultats_titre">€V Total</div>
				</div>
				<div class="mes_resultats_informations mesresultatshauteur4">
					<div style="float:left; width:100%; height:100px;" class="chart-container">
                    <span class="chart3" data-percent="<?php echo floor($fidelite['MARQUEUR']); ?>">  
		          <span class="percent plugin first"></span>
	               </span>
                    </div>
					<?php echo french_number($fidelite['EURO_FIDELITE'] + $fidelite['EURO_PROGRESSION']); ?> €V
				</div>
			</div>
			
			<div class="mes_resultats mesresultats4">
				<div class="mes_resultats_header" style="">
					<div class="mes_resultats_ligne mes_resultats_titre">Coût du voyage</div>
				</div>
				<div class="mes_resultats_informations mesresultatshauteur2">
					<?php echo french_number($fidelite['COUT_VOYAGE']); ?> €
				</div>
			</div>
			
			<div class="mes_resultats mesresultats5">
				<div class="mes_resultats_header" style="">
					<div class="mes_resultats_ligne mes_resultats_titre">Coût réel du voyage</div>
				</div>
				<div class="mes_resultats_informations mesresultatshauteur2">
					<?php echo french_number($fidelite['COUT_VOYAGE'] - ($fidelite['EURO_FIDELITE'] + $fidelite['EURO_PROGRESSION'])); ?> €
				</div>
			</div>
			
		</div>
		
		<div id="mes_resultats_conditions">
			<div class="mes_resultats_header" style="">
				<div class="mes_resultats_ligne mes_resultats_titre">Informations</div>
			</div>
			<div class="mes_resultats_informations">
				* €V Fidélité : dès que votre chiffre d'affaires cumulé en cours atteint votre chiffre d'affaire de référence<br><br>
               ** Projection : ces chiffres sont fictifs. Ils représentent une projection par rapport à vos précédents résultats. 
			</div>
		</div>
        
	</div>
	
</div>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="js/plug/easy-pie-chart-master/dist/jquery.easypiechart.min.js"></script>
<script src="js/mes-resultats-board.js"></script>
<script>
    $(function(){
        // Animation barre de progression.
        
        $('#mesresultatsbarre_fidelite').animate({
            width: "<?php echo floor($fidelite['EURO_FIDELITE_PERCENT'])."%" ;?>"
        },1000,function(){
            $('#mesresultatsbarre_progression').animate({
                width: "<?php echo floor($fidelite['EURO_PROGRESSION_PERCENT'])."%";?>"
            }, 1000);
        });
        
        verif = <?php echo $fidelite['EURO_PROGRESSION_PERCENT']; ?>;
        $('#pourcent').animate({
            marginLeft: "<?php echo ($fidelite['EURO_FIDELITE_PERCENT'])."%" ; ?>"
        },1000, function(){
            if(verif > 0){
            $('#pourcent').animate({
            marginLeft: "<?php if($fidelite['EURO_PROGRESSION_PERCENT'] + $fidelite['EURO_FIDELITE_PERCENT'] > 96){echo 96; echo '%';}else{echo $fidelite['EURO_PROGRESSION_PERCENT'] + $fidelite['EURO_FIDELITE_PERCENT']."%"; } ?>"   
        },1000);
            }
        });
        
 
        compteur = 0;
        var interval = setInterval(function(){
            limite = <?php echo floor($fidelite['MARQUEUR']); ?>;
            if(limite > 100){limite = 100;}
            if(compteur <= limite){
                        $('#pourcent').html(compteur+' %');
                        compteur++;
                  }else{
                      clearInterval(interval);
                  }
        }, 35);
    });
</script>