$(function () {
    /* Récupération des variables dans la base de données */
    quote = [];
    activite = [];
	
	// Make monochrome colors and set them as default for all pies
    Highcharts.getOptions().plotOptions.pie.colors = (function () {
        var colors = [],
            base = Highcharts.getOptions().colors[0],
            i;

        for (i = 0; i < 10; i += 1) {
            // Start out with a darkened base color (negative brighten), and end
            // up with a much brighter color
            colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
        }
        return colors;
    }());
    
    $.ajax({
        url: 'traitement.php',
        type: 'POST',
        data: {traitement : 'getActivite'},
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
            console.log(html);
            quote = [html.quote1, html.quote2, html.quote3, html.quote4, html.quote5];
            activite = [html.activite1, html.activite2, html.activite3, html.activite4, html.activite5];
        }
    });
    
    
            
    gQuote = [parseInt(quote[0]), parseInt(quote[1]), parseInt(quote[2]), parseInt(quote[3]), parseInt(quote[4])];    
    gActivite = [activite[0],activite[1],activite[2],activite[3],activite[4]];    
    /* ----------------------------- */
    
    
    setTimeout(function(){
        
        
	   
	  $('#container').highcharts({
       	chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false,
            backgroundColor: "transparent"
        },
        title: {
            text: ''
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
        },
        series: [{
            type: 'pie',
            name: 'Activité',
            data: [
                [gActivite[0], gQuote[0]],
                [gActivite[1], gQuote[1]],
                [gActivite[2], gQuote[2]],
                [gActivite[3], gQuote[3]],
                [gActivite[4], gQuote[4]]
               ]
        }]
    });
            
            
    },1000);            
            
});