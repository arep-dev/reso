$(function(){
    

    
        /* Récupération des variables dans la base de données */
        ca = [];
        caCumul = [];
        $.ajax({
            url: 'traitement.php',
            type: 'POST',
            data: {traitement : 'getCa'},
            dataType: 'json',
            async: false,

            error: function(a,b,c){
                console.log('Erreur highcharts.js')
                console.log(a);
                console.log(b);
                console.log(c);
            },

            success: function(html){
                console.log('ok');
                //Récupération des CA sous forme de STRING /!\
                ca = [html.ca1, html.ca2, html.ca3, html.ca4, html.ca5, html.ca6, html.ca7, html.ca8, html.ca9, html.ca10, html.ca11, html.ca12];
                caRef = parseInt(html.caRef);
                //Calcul du cumul des CA
                compteur = 0;
                while(compteur <= 12){
                    compteur2 = 0;
                    while(compteur2 <= compteur){
                        if(compteur2 == 0){
                            caCumul[compteur] = parseInt(ca[compteur2]);
                        }else{
                            caCumul[compteur] += parseInt(ca[compteur2]);    
                        }
                        compteur2++;
                    }
                    compteur++;
                }
                
                // On parseInt les valeur des CA dans le tableau ca.
            
                $.each(ca, function(index,value){
                    var valueInt = parseInt(value);
                    ca[index] = valueInt;
                });
                
                
            }
    
            });
    
    
    
            //Application de la pastille quand CAcumul > CA REF.
            blocker = 0;
            function calculCA(x){
                ca = caCumul[x];
                if(caCumul[x] >= caRef && blocker == 0){
                    ca = {y: caCumul[x], marker: {symbol: 'url(img/p0.png)'}};
                    blocker = 1;
                }
                return ca;
            }
        
    
            // Calcul la progression par rapport au CA de référence.
            function progression(){
                compteur = 0;
                blocker = 0;
                while(compteur <= 11){
                    calcul = caRef - caCumul[compteur];
                    if(calcul <= 0 && blocker == 0){
                        $('#val'+compteur+'').html('Vous avez atteint votre CA de référence');
                        blocker = 1;
                    }else if(blocker == 1){
                        calcul = calcul * (-1);
                        $('#val'+compteur+'').html('+ '+calcul+' €');    
                    }else{
                        $('#val'+compteur+'').html('- '+calcul+' €');
                    }
                    
                    compteur++;
                }        
            }
    
            // On execute la fonction progression
            progression();        
    
    
        Highcharts.setOptions({
        colors: ['#019cde', '#000000', '#ca1414','#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5',  '#6AF9C4']
    });
	 $('#container-2').highcharts({
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Votre CA SIPLAST'
            },
            subtitle: {
                text: 'Source SIPLAST 2016'
            },
            xAxis: {
                categories: ['Jan. 2016', 'Fév. 2016', 'Mars. 2016', 'Avr. 2016', 'Mai. 2016', 'Juin. 2016', 'Juil 2016',
                    'Août 2016', 'Sept. 2016', 'Oct. 2016', 'Nov. 2016', 'Dec. 2016']
            },
            yAxis: {
                title: {
                    text: 'Chiffre d\'affaire'
                },
                labels: {
                    formatter: function() {
                        return this.value +' €'
                    }
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#ffffff',
                        lineWidth: 1
                    }
                }
            },
            series: [
			{
                name: 'CA de réf.',
                marker: {
                symbol: 'circle'
                },
                data: [ caRef, caRef, caRef, caRef, caRef, caRef, caRef, caRef, caRef, caRef, caRef, caRef]
    
            },
			{
                name: 'CA',
                marker: {
                symbol: 'circle'
                },
                data: [ca[0], ca[1], ca[2], ca[3], ca[4], ca[5], ca[6], ca[7], ca[8], ca[9], ca[10], ca[11]]
    
            }, {
                name: 'CA Cumulé',
                marker: {
                symbol: 'circle'
                },
	
			   data: [calculCA(0), calculCA(1), calculCA(2), calculCA(3), calculCA(4), calculCA(5), calculCA(6), calculCA(7), calculCA(8), calculCA(9), calculCA(10), calculCA(11)]
    	  	   //  data: [gCaCumul[0],gCaCumul[1],gCaCumul[2], gCaCumul[3], gCaCumul[4], gCaCumul[5], gCaCumul[6], gCaCumul[7], gCaCumul[8], gCaCumul[9], gCaCumul[10], gCaCumul[11]]
            }]
        });
    });