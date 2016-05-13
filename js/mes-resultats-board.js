$(function(){
                    
        //plugin graphique en cercle
        
        $('.chart').easyPieChart({
            lineWidth: '15',
            lineCap: 'butt',
            barColor: '#0183BA',
            trackColor: 'rgba(0,0,0,0.2)',
            scaleColor: 'transparent',
			easing: 'easeOutBounce',
			onStep: function(from, to, percent) {
				$(this.el).find('.percent').text(Math.round(percent));
			}
		});
        
        $('.chart2').easyPieChart({
            lineWidth: '15',
            lineCap: 'butt',
            barColor: '#006691',
            trackColor: 'rgba(0,0,0,0.2)',
            scaleColor: 'transparent',
			easing: 'easeOutBounce',
			onStep: function(from, to, percent) {
				$(this.el).find('.percent').text(Math.round(percent));
			}
		});
        
        $('.chart3').easyPieChart({
            lineWidth: '15',
            lineCap: 'butt',
            barColor: '#019CDE',
            trackColor: 'rgba(0,0,0,0.2)',
            scaleColor: 'transparent',
			easing: 'easeOutBounce',
			onStep: function(from, to, percent) {
				$(this.el).find('.percent').text(Math.round(percent));
			}
		});
        
        
    });

