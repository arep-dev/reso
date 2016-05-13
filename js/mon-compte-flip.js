$(function(){
    $('#btn1').click(function(){
            $('#back2').css('display','none');
            $('#moncompte-1').css('z-index','9999999999');
            $('#moncompte-1').find('.card').addClass('flipped');
            setTimeout(function(){
            $('#moncompte-1').css('z-index','1');
            },2000);
            return false;
        });
    $('#btn2').click(function(){
            $('#moncompte-1').css('z-index','9999999999');
            $('#moncompte-1').find('.card').removeClass('flipped');
            setTimeout(function(){
            $('#moncompte-1').css('z-index','1');
            },2000);
            return false;
        });
    $('#btn3').click(function(){
            $('#back2').css('display','block');
            $('#moncompte-1').css('z-index','9999999999');
            $('#moncompte-1').find('.card').addClass('flipped');
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
    $('#btn5').click(function(){
            $('#back4').css('display','none');
            $('#moncompte-2').css('z-index','9999999999');
            $('#moncompte-2').find('.card').addClass('flipped');
            setTimeout(function(){
            $('#moncompte-2').css('z-index','1');
            },2000);
            return false;
        });
    $('#btn6').click(function(){
            $('#moncompte-2').css('z-index','9999999999');
            $('#moncompte-2').find('.card').removeClass('flipped');
            setTimeout(function(){
            $('#moncompte-2').css('z-index','1');
            },2000);
            return false;
        });
    $('#btn7').click(function(){
            $('#back4').css('display','block');
            $('#moncompte-2').css('z-index','9999999999');
            $('#moncompte-2').find('.card').addClass('flipped');
            setTimeout(function(){
            $('#moncompte-2').css('z-index','1');
            },2000);
            return false;
        });
    $('#btn8').click(function(){
            $('#moncompte-2').css('z-index','9999999999');
            $('#moncompte-2').find('.card').removeClass('flipped');
            setTimeout(function(){
            $('#moncompte-2').css('z-index','1');
            },2000);
            return false;
        });
    $('#btn9').click(function(){
            $('#moncompte-4').css('z-index','9999999999');
            $('#moncompte-4').find('.card').addClass('flipped');
            setTimeout(function(){
            $('#moncompte-4').css('z-index','1');
            },2000);
            return false;
        });
    $('#btn10').click(function(){
            $('#moncompte-4').css('z-index','9999999999');
            $('#moncompte-4').find('.card').removeClass('flipped');
            setTimeout(function(){
            $('#moncompte-4').css('z-index','1');
            },2000);
            return false;
        });



        setTimeout(function(){
        var hauteur1 = $("#data-bloc-1").innerHeight() + 40;
        $("#moncompte-1").css("height",hauteur1);
        var hauteurbloc1 = $("#data-bloc-1").innerHeight();
        $("#data-bloc-2").css("height",hauteurbloc1);
        $("#data-bloc-3").css("height",hauteurbloc1);
        var hauteur2 = $("#data-bloc-4").innerHeight() + 40;
        $("#moncompte-2").css("height",hauteur2);
        var hauteurbloc2 = $("#data-bloc-4").innerHeight();
        $("#data-bloc-5").css("height",hauteurbloc2);
        $("#data-bloc-6").css("height",hauteurbloc2);
        setTimeout(function(){
        var hauteur3 = $("#data-bloc-7").innerHeight() + 40;
        $("#moncompte-4").css("height",hauteur3);
        var hauteurbloc3 = $("#data-bloc-7").innerHeight();
        $("#data-bloc-8").css("height",hauteurbloc3);
        var hauteurbloc1 = $("#data-bloc-1").innerHeight();
        $("#data-bloc-2").css("height",hauteurbloc1);
        $("#data-bloc-3").css("height",hauteurbloc1);        
        },1000);      
        },1000);
        $(window).resize(function(){
        var hauteur1 = $("#data-bloc-1").innerHeight() + 40;
        $("#moncompte-1").css("height",hauteur1);
        var hauteurbloc1 = $("#data-bloc-1").innerHeight();
        $("#data-bloc-2").css("height",hauteurbloc1);
        $("#data-bloc-3").css("height",hauteurbloc1);
        var hauteur2 = $("#data-bloc-4").innerHeight() + 40;
        $("#moncompte-2").css("height",hauteur2);
        var hauteurbloc2 = $("#data-bloc-4").innerHeight();
        $("#data-bloc-5").css("height",hauteurbloc2);
        $("#data-bloc-6").css("height",hauteurbloc2);
        setTimeout(function(){
        var hauteur3 = $("#data-bloc-7").innerHeight() + 40;
        $("#moncompte-4").css("height",hauteur3);
        var hauteurbloc3 = $("#data-bloc-7").innerHeight();
        $("#data-bloc-8").css("height",hauteurbloc3);
        },1000);    
        });
});
