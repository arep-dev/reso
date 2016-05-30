<?php 
    session_start();
    require 'fonction.php';
    // On récupère le nom du voyage, pour les URL dynamiques.
    $voyage = chargement_voyage($_SESSION['PRO_NUM']);
    $baseline = chargement_voyage2($_SESSION['PRO_NUM']);
?>

<link rel="stylesheet" href="css/mon-voyage.css">


<div class="backgroundvoyage">
	<div id="ei-slider" class="ei-slider">
		<ul class="ei-slider-large">
			<li>
			<img src="img/backgroundMEXIQUE.jpg">
			<div style="background: url(img/backgroundMEXIQUE.jpg) no-repeat center center fixed; background-size:cover; width:100%; height:100%; position:absolute; top:0;">
				<div class="titrevoyage">
				<a href="#"><?php echo ucfirst($voyage); ?></a>
				</div>
				<div class="sstitrevoyage">
				<a href="#"><?php echo ucfirst($baseline); ?></a>
				</div>
				<div class="bloc_zonesvoyages">
					<a href="#" target="_blank">
					<div class="zonesvoyage">
						<div class="lignevoyage">
							<i class="fa fa-file-image-o"></i>
						</div>
						<div class="lignevoyage">
							Télécharger la<br>plaquette
						</div>
					</div>
					</a>
					<a href="#" target="_blank">
					<div class="zonesvoyage">
						<div class="lignevoyage">
							<i class="fa fa-file-text-o"></i>
						</div>
						<div class="lignevoyage">
							Télécharger le<br>bulletin d'inscription
						</div>
					</div>
					</a>
					<a href="#">
					<div class="zonesvoyage">
						<div class="lignevoyage">
							<i class="fa fa-desktop"></i>
						</div>
						<div class="lignevoyage">
							Visiter le<br>site web
						</div>
					</div>
					</a>
				</div>
			</div>
			</li>
			<li>
			<img src="img/backgroundJAPON.jpg">
			<div style="background: url(img/backgroundJAPON.jpg) no-repeat center center fixed; background-size:cover; width:100%; height:100%; position:absolute; top:0;">
				<div class="titrevoyage">
				<a href="#">Tokyo</a>
				</div>
				<div class="sstitrevoyage">
				<a href="#">Le Japon moderne</a>
				</div>
				<div class="bloc_zonesvoyages">
					<a href="#" target="_blank">
					<div class="zonesvoyage">
						<div class="lignevoyage">
							<i class="fa fa-file-image-o"></i>
						</div>
						<div class="lignevoyage">
							Télécharger la<br>plaquette
						</div>
					</div>
					</a>
					<a href="#" target="_blank">
					<div class="zonesvoyage">
						<div class="lignevoyage">
							<i class="fa fa-file-text-o"></i>
						</div>
						<div class="lignevoyage">
							Télécharger le<br>bulletin d'inscription
						</div>
					</div>
					</a>
					<a href="#">
					<div class="zonesvoyage">
						<div class="lignevoyage">
							<i class="fa fa-desktop"></i>
						</div>
						<div class="lignevoyage">
							Visiter le<br>site web
						</div>
					</div>
					</a>
				</div>
			</div>
			</li>
		</ul><!-- ei-slider-large -->
		<ul class="ei-slider-thumbs">
			<li class="ei-slider-element">Current</li>
			<li><span class="nomdestination">MEXIQUE</span><a href="#"></a><img src="img/backgroundMEXIQUE.jpg" alt="MEXIQUE" /></li>
			<li><span class="nomdestination">TOKYO</span><a href="#"></a><img src="img/backgroundJAPON.jpg" alt="TOKYO" /></li>
		</ul><!-- ei-slider-thumbs -->
	</div><!-- ei-slider -->
</div>
        <script type="text/javascript" src="js/jquery.eislideshow.js"></script>
        <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
        <script type="text/javascript">
            $(function() {
                $('#ei-slider').eislideshow({
					animation			: 'center',
					autoplay			: true,
					slideshow_interval	: 5000,
					titlesFactor		: 0
                });
				var menudestinations = $('.ei-slider-thumbs li').length;
				if (menudestinations == 2) {
					$(".ei-slider-thumbs").css("opacity","0");
				}
            });
        </script>
