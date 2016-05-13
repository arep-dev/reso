<?php 
    session_start();
    require 'fonction.php';
    // On récupère le nom du voyage, pour les URL dynamiques.
    $voyage = chargement_voyage($_SESSION['PRO_NUM']);
    $baseline = chargement_voyage2($_SESSION['PRO_NUM']);
?>

<style>
    .backgroundvoyage{
        /* On utilise la variable $voyage pour charger le background en fonction du bon voyage */
        background: url(img/background<?php echo $voyage; ?>.jpg) no-repeat center center fixed!important; 
        background-size: cover !important;
    }
</style>

<link rel="stylesheet" href="css/mon-voyage.css">


<div class="backgroundvoyage">
    <div class="titrevoyage">
    <!-- Idem ici, on affiche le nom du voyage --> 
    <?php echo ucfirst($voyage); ?>
    </div>
    <div class="sstitrevoyage">
    <?php echo ucfirst($baseline); ?>
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
