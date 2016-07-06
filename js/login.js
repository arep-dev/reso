$(function(){
    
    //Gestion de l'effet flip pour la perte de mot de passe.
    $('#flip').click(function(){
        $('.back').css('display','block');
        setTimeout(function(){
            $('.front').css('display','none');
        },1000);
    });
    
    $('#flip2').click(function(){
        $('.front').css('display','block');
        setTimeout(function(){
            $('.back').css('display','none');
        },1000);
    });
    
    
    //Script login
    $('#form1').submit(function(){

        $.ajax({
            url: 'traitement.php',
            type: 'POST',
            data: $('#form1').serialize(),
            dataType: 'json',
            
            error: function(a,b,c){
 
            },
            
            success: function(html){
                if(html.msg != undefined){
                    $('#msg1').html(html.msg);
                    $('#msg1').addClass('error');
                    $('#msg1').fadeIn();
                }
                if(html.redirect == 'ok'){
                    window.location.href="index.php";
                }
            }
        });
    });
    
    
    // Modification de la photo.
    
    //Dans le cas où l'on rentre son nom d'utilisateur.
    $('input[name="login"]').focusout(chargement_photo);
    
    //Dans le cas où celui ci est dans le cache du navigateur.
    setTimeout(function(){
        valLogin = $('input[name="login"]').val();
        if(valLogin != ''){
            chargement_photo();    
        }
    },200);
    
    // Fonction Ajax de modification de la photo.
    function chargement_photo(){
        $.ajax({
            url: 'script-login.php',
            type: 'POST',
            data: $('#form1').serialize(),
            dataType: 'json',
            
            error: function(){
            
            },
            
            success: function(html){
                $('.photo_connexion').css('background','url(' +html.img+ ') no-repeat center').css('background-size','cover');                
            }
        });    
    }
    
    
    $('#form2').submit(recup_mdp);
    
    //Récupération de mot de passe
    function recup_mdp(){
        $.ajax({
            url: 'recup-mdp.php',
            type: 'POST',
            data: $('#form2').serialize(),
            dataType: 'json',
            
            error: function(a,b,c){
                console.log('error');
                console.log(a);
                console.log(b);
                console.log(c);
            },
            
            success: function(html){
             
                if(html.msg != undefined){
                    $('#msg2').html(html.msg);
                    // Choix de la couleur de la div message.
                    if(html.code < 200){
                        $('#msg2').removeClass('error');
                        $('#msg2').addClass('success');
                    }else{
                        $('#msg2').removeClass('success');
                        $('#msg2').addClass('error');
                    }
                    $('#form2 input[type="text"]').val('');
                    $('#msg2').fadeIn();
                }    
            }
        });
    }
});