$(function(){
    $('#btn2').click(function(){
            $('#moncompte-1').css('z-index','9999999999');
            $('#moncompte-1').find('.card').removeClass('flipped');
            setTimeout(function(){
            $('#moncompte-1').css('z-index','1');
            },2000);
            return false;
        });
    $('#btn4').click(function(){
            $('#moncompte-1').css('z-index','9999999999');
            $('#moncompte-1').find('.card').removeClass('flipped');
            setTimeout(function(){
            $('#moncompte-1').css('z-index','1');
            },2000);
            return false;
        });
		
		




        setTimeout(function(){
        var hauteur1 = $("#data-bloc-1").innerHeight() + 40;
        $("#moncompte-1").css("height",hauteur1);
        var hauteurbloc1 = $("#data-bloc-1").innerHeight();
        $("#data-bloc-2").css("height",hauteurbloc1);
        $("#data-bloc-3").css("height",hauteurbloc1);     
        },1000);
        $(window).resize(function(){
        var hauteur1 = $("#data-bloc-1").innerHeight() + 40;
        $("#moncompte-1").css("height",hauteur1);
        var hauteurbloc1 = $("#data-bloc-1").innerHeight();
        $("#data-bloc-2").css("height",hauteurbloc1);
        $("#data-bloc-3").css("height",hauteurbloc1);
        },1000);    
});
