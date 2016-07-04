<?php 
	ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();
    include('fonction.php');
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

					/*foreach ($fidelite["RESULTATS"] as $mois => $ca) {
						switch ($mois) {
							case 1:
								$mois = 'Janvier';
								break;
							case 2:
								$mois = 'Février';
								break;
							case 3:
								$mois = 'Mars';
								break;
							case 4:
								$mois = 'Avril';
								break;
							case 5:
								$mois = 'Mai';
								break;
							case 6:
								$mois = 'Juin';
								break;
							case 7:
								$mois = 'Juillet';
							case 8:
								$mois = 'Aout';
							case 9:
								$mois = 'Septembre';
								break;
							case 10:
								$mois = 'Octobre';
								break;
							case 11:
								$mois = 'Novembre';
								break;
							case 12:
								$mois = 'Décembre';
								break;	
						}

						echo '<tr>';
						echo '<td class="paddingmois">'.$mois.'</td>';
						echo '<td class="paddingmois">'.french_number($ca).'</td>';
						echo '</tr>';
					}*/

					$parametres = $fidelite["PARAMETRES"];


					$count = 0;
					$stop = 0;
					$limite = ($parametres["DEBUT_CHALLENGE"] + $parametres['DUREE_CHALLENGE']) ;
					for($i = $parametres["DEBUT_CHALLENGE"]; $i < $limite; $i++) {
						
						if($i == 13) { 
							$i = 1;
						}
						if($stop == 0) {
							echo '<tr>';
							echo '<td class="paddingmois">'.$i.'</td>';
							//echo '<td class="paddingmois">'.french_number($fidelite["RESULTATS"][$i]).'</td>';
							echo '<td class="paddingmois">test</td>';
							echo '</tr>';
						}else{
							echo '<tr>';
							echo '<td class="paddingmois">'.$i.'</td>';
							//echo '<td class="paddingmois">'.french_number($fidelite["RESULTATS"][$i]).'</td>';
							echo '<td class="paddingmois">Projection</td>';
							echo '</tr>';
						}
						if($count == 11) {
							break;
						}

						if($i == $mois_en_cours) {
							$stop = 1;
						}

						$count++;
					}

                   /* $moyenne[] = 0;

                    for($i = 1; $i <= 12; $i++)
                    {
                        echo '<tr';
                        if($i == $mois_en_cours - 1)
                        {
                            echo ' style="color:#019cde;"';
                            
                        }else if($i > $mois_en_cours - 1)
                        {
                            echo ' style="font-style:italic;"';
                        }
                        
                        echo '><td class="paddingmois">';
                        
                        $number_month = $mois_en_cours - 1;
            
                        $moyenne[$i] = ($fidelite['RES_CA_TOTAL'] + $moyenne[$i-1])  / $number_month;    

                        if($i < 10)
                        {
                            echo '0';
                            echo $i.'/'.$annee.'</td><td class="paddingmois">';
                            if($i > $mois_en_cours - 1){
                                echo french_number($moyenne[$i]).' €';
                            }else{
                                echo french_number($fidelite['RES_CA_0'.$i.'_'.$annee.'']).' €';
                            }
                            if($i > $mois_en_cours - 1){echo '**';}
                            echo '</td></tr>';
                            
                        }else{
                            
                            echo $i.'/'.$annee.'</td><td class="paddingmois">';
                            if($i > $mois_en_cours - 1){
                                echo french_number($moyenne[$i]).' €';
                            }else{
                                echo french_number($fidelite['RES_CA_'.$i.'_'.$annee.'']).' €';
                            }
                            if($i > $mois_en_cours - 1){echo '**';}
                            echo '</td></tr>';   
                        }
                        
                        
                    }*/
            
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
                    $caProject = $fidelite["RES_CA_TOTAL"];
                    
                    for($s = 0 ; $s <= 12 ; $s++){
                        $caProject += $moyenne[$s];
                    } 

                    echo french_number($caProject).' €**';
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