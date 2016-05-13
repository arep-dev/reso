$(function(){
    // Déclaration variables
    windowHeight = $(window).height();
    windowWidth = $(window).width();
    hauteursans = ($(window).height() - 300);
	hauteurespace = (hauteursans - $("#menu2").height());
    hauteurmenu = (hauteurespace / 2);
    
    // Lancement des fonctions sur event.
    $('#zone_depliable').click(carteDepliable);
    $('#close').click(carteDepliable);
    $('.ouvrir').click(linkDepliable);
    $(".ssmenus a").click(chargerPage);
    $(".moncompte a").click(chargerPage);
    $(".etmoi a").click(chargerPage);
    $(".contact a").click(chargerPage);
    $(window).resize(resizeAll);
    $('#background').click(carteDepliable);
    $('.upload_box_button').click(uploadBox);
    
    
    //Lancement de la fonction AjaxRequest pour acces BDD pour TOUT les formulaires.
    
    $('.bloc_hobbies label').click(hobbies); // La fonction hobbies lance la fonction AjaxRequest
    
    // Lancement globale de AjaxRequest pour tout formulaires.
    $('input[type="submit"]').click(function(e){
        e.preventDefault();
        target = $(this).attr('form');
        ajaxRequest(target);
    });
    
    
    
    
    
    
    // Code JS.
    $('a.load').click(function(){
        $('.ssmenus a').css('font-weight', '300');
        $(this).css('font-weight','500');
        $('#carte_contenu').css('width', windowWidth - 40);
    });
    $("#menu2").css("margin-top", hauteurmenu);
    
    //Fermeture des light box.
    $('.close-box').click(function(){
        $('.upload_box').fadeOut();
    });
    

    
    
    // Fonctions
    
    // Fonction : deplier la carte.
    function carteDepliable(){
        
        var carteHeight = $('#carte').height();
        if(carteHeight <= 160){
            $('#carte').css('height', windowHeight - 40);
            $('#carte_contenu').css('height', windowHeight - 40);
            $('.open').fadeIn(500);
            $('#background').fadeIn(500);
        }else{
            $('.open').stop().fadeOut(500);
            $('#carte').css('height', '160px');
            $('#carte_contenu').css('height', '160px');
            $('#background').fadeOut(500);
            $('#carte_contenu').css('width', '254px');
            $('.ssmenus').slideUp();
            $('.menus').css('border-left','0px');
            $('.menus a').css('color','#000000');
            $('.ssmenus a').css('font-weight', '300');
        }
    }
    
    // Fonction : Déplier les liens.
    function linkDepliable(){
        
        id = $(this).attr('id');
        
        // On renitialise.
        $('.ssmenus').stop().slideUp();
        $('.menus').css('border-left','0px');
        $('.menus a').css('color','#000000');
        
        // On deplie les liens.
        $('.ss'+id).stop().slideDown();
        $('.'+id).css('border-left', '#239ed6 3px solid');
        $('.'+id+' a').css('color','#239ed6');
    }
    
    // Fonction : Charge la page dans le bloc #contenu, selon le lien cliqué.
    function chargerPage(event){
        
        event.preventDefault();
        link = $(this).attr('href');
        
    
        $('#loader').fadeIn(200);    
        
        
        setTimeout(function(){
            console.log('Page demandée : '+link);
            $.ajax({
                url: link,
                success: function(html){
                    console.log('Page chargée correctement par AJAX');
                    $('#loader').fadeOut(200);
                    $('#contenu').html(html);
                },
                
                error: function(a,b,c){
                    console.log(a+' '+b+' '+c);
                }
            });
        },2300);     
    }
    
    // Recharge la page actuelle apres certaines requette.
    function rechargerPage(link){
        
        $('.upload_box').fadeOut();
        $('#loader').fadeIn(200);    
        
        
        setTimeout(function(){
            console.log(link);
            $.ajax({
                url: link,
                success: function(html){

                    $('#loader').fadeOut(200);
                    $('#contenu').html(html);
                },
                
                error: function(a,b,c){
                    console.log(a+' '+b+' '+c);
                }
            });
        },2300);
    }
    
    // Fonction de Resize de la fenêtre entière.
    function resizeAll(){
        
        carteWidth= $('#carte_contenu').width();
        carteHeight= $('#carte').height();
        windowHeight = $(window).height();
        windowWidth = $(window).width();
        hauteursans = ($(window).height() - 300);
        hauteurespace = (hauteursans - $("#menu2").height());
        hauteurmenu = (hauteurespace / 2);
        
        if(carteWidth > 254){
            $('#carte_contenu').css('height', windowHeight - 40);
            $('#carte_contenu').css('width', windowWidth - 40);
            $('#carte').css('height', windowHeight - 40);
            $("#menu2").css("margin-top", hauteurmenu);
        }else if(carteHeight > 161){
            $('#carte').css('height', windowHeight - 40);
            $('#carte_contenu').css('height', windowHeight - 40);
            $("#menu2").css("margin-top", hauteurmenu);
        }
    }
    
    // Fonction de check des hobbies avant l'envoi vers la BDD.
    function hobbies(){
       
        verif = $(this).prev().attr('style');
        if(verif == 'display:none !important'){
            $(this).prev('i').attr('style','display:block !important');
        }else{
            $(this).prev('i').attr('style','display:none !important');
        }
        
        
        setTimeout(function(){
            ajaxRequest('form_hobbies');
        },1000);    
        
    
    }
    
    // Fonction globale AJAX d'accès à la BDD.
    function ajaxRequest(target){
        
        $.ajax({
            url: 'traitement.php',
            type: 'POST',
            data: $('#'+target).serialize(),
            dataType: 'json',
            
            error: function(){
                    console.log('Une erreur est survenue');
                },
                
            success: function(html){

                $('#message').html(html.msg);
                // Choix de la couleur de la DIV en fonction du message.
                if(parseInt(html.code) < 200){
                    $('#message').addClass('success');    
                }else if(parseInt(html.code) < 300 && parseInt(html.code) >= 200){
                    $('#message').addClass('error');
                }else if(parseInt(html.code) < 400 && parseInt(html.code) >= 300){
                    $('#message').addClass('warning');
                }
                
                //Affichage du message 
				$('#message').addClass('bounceInLeft animated');
                $('#message').show();
				
				$('body').append('<div id="notif"></div>');
				$('#notif').html('<audio controls="controls" autoplay="autoplay" style="display:none;"><source src="mp3/in.mp3" type="audio/mp3" /></audio>');
                
                
                // Fonction de rechargement des blocs flipped sur la page mon compte.
                rechargementMonCompte(html.code);
                
                // Utiliser la fonction rechargerPage() pour le reste.

            }
            
        });
        
    }
    
    // Ouverture des light box d'upload.
    function uploadBox(){
        id = $(this).attr('target');
        $('#'+id).fadeIn();
    }
    
    
    function rechargementMonCompte(code){
        
        if(target != 'form_hobbies' && target != 'form_pass' && parseInt(code) < 200 || parseInt(code) >= 300 ){}
    if(target == 'form_moncompte'){
        $('#moncompte-1').find('.card').removeClass('flipped');
        $('#moncompte-1 .data-contain').load('mon-compte.php #moncompte-1 .data-contain-load');
    }
    if(target == 'form_entreprise'){
        $('#moncompte-2').find('.card').removeClass('flipped');
        $('#moncompte-2 .data-contain').load('mon-compte.php #moncompte-2 .data-contain-load');
    }
    if(target == 'form_activite'){
        $('#moncompte-4').find('.card').removeClass('flipped');
        $('#moncompte-4 .data-contain').load('mon-compte.php #moncompte-4 .data-contain-load', function(){
            $.getScript('js/plug/highchart.js');                    
        });	
    }



    setTimeout(function(){
        if(target != 'form_hobbies' && parseInt(code) < 200 || parseInt(code) >= 300 ){}
        $('#message').addClass('bounceOutLeft animated');
        setTimeout(function(){
            $('#message').hide();
            $('#message').removeClass('bounceInLeft bounceOutLeft animated success warning error');
        },1000);
    },5000);
    
    }
    
      
});