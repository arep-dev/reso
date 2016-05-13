<link rel="stylesheet" href="css/mes-resultats.css">
<div id="container-2"></div>
<div id="container-1">
    <div id="column-contain">
        <div class="titre1" id="titre1">Date</div>
        <div class="titre2" id="titre2">Progression</div>
        <div class="titre1" id="date1"></div>
        <div class="titre2" id="val0"></div>
        <div class="titre1" id="date2"></div>
        <div class="titre2" id="val1"></div>
        <div class="titre1" id="date3"></div>
        <div class="titre2" id="val2"></div>
        <div class="titre1" id="date4"></div>
        <div class="titre2" id="val3"></div>
        <div class="titre1" id="date5"></div>
        <div class="titre2" id="val4"></div>
        <div class="titre1" id="date6"></div>
        <div class="titre2" id="val5"></div>
        <div class="titre1" id="date7"></div>
        <div class="titre2" id="val6"></div>
        <div class="titre1" id="date8"></div>
        <div class="titre2" id="val7"></div>
        <div class="titre1" id="date9"></div>
        <div class="titre2" id="val8"></div>
        <div class="titre1" id="date10"></div>
        <div class="titre2" id="val9"></div>
        <div class="titre1" id="date11"></div>
        <div class="titre2" id="val10"></div>
        <div class="titre1" id="date12"></div>
        <div class="titre2" id="val11"></div>
    </div>
</div>    
<script src="js/plug/highchart-ca.js"></script>
<script>
    $(function(){
        var compteur = 1;
        var annee = 16;
        while(compteur <= 12){
            if(compteur < 10){
                $('#date'+compteur+'').html('0'+compteur+'/'+annee+'');
            }else{
                $('#date'+compteur+'').html(''+compteur+'/'+annee+'');
            }
            
            compteur++;
        }
    });
</script>