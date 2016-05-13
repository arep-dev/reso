$(function(){ 
    $('.upload-button').click(function(){
        console.log('test');
        id = $(this).attr('target');
        $('#'+id).fadeIn();
    });
    
    $('#close-upload-photo').click(function(){
        $('#upload-photo').fadeOut();
    });
    
    $('#close-upload-logo').click(function(){
        $('#upload-logo').fadeOut();
    });
    
});