<?php session_start(); ?>
<html>
<head>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/upload.css">
</head>
<body>
			
    <div id="image-preview-photo">
    
				<?php
				   $filename = 'img/profil/v_'.$_SESSION['PRO_NUM'].'.jpg';
			
					if(file_exists($filename)){
						echo '<div id="photo_carre" style="background:url(img/profil/v_'.$_SESSION['PRO_NUM'].'.jpg?'.time().') no-repeat center; background-size:cover;"></div>';
					}else{
						$filename = 'img/profil/v_'.$_SESSION['PRO_NUM'].'.png';
						if(file_exists($filename)){
							echo '<div id="photo_carre" style="background:url(img/profil/v_'.$_SESSION['PRO_NUM'].'.png?'.time().') no-repeat center; background-size:cover;"></div>';
						}else{
							$filename = 'img/photo.jpg';
							echo '<div id="photo_carre" style="background:url(img/photo.jpg) no-repeat center; background-size:cover;"></div>';
						}
					}
				?>
    </div>
<div id="msg-nodisplay" class="warning"><i class="fa fa-exclamation-triangle"></i> Votre photo ne doit pas dépasser 5 Mo</div>  
<form method="post" action="traitement.php" id="form-upload-photo" enctype="multipart/form-data">
    <input type="hidden" name="traitement" value="upload-photo">
	<div class="input-file-container">
    <input type="file" name="file" id="my-file" class="input-file" onchange="readURLPhoto(this);">
  <label for="my-file" class="input-file-trigger" tabindex="0">Choisir une photo...</label>
  </div>
  <div class="ligne">
    <input type="submit" name="send" value="Enregistrer">
	</div>
</form>
<form method="post" action="traitement.php">
    <input type="hidden" name="traitement" value="delete">
    <input type="hidden" name="target" value="photo">
    <div class="ligne">
	<input type="submit" name="send" value="Supprimer">
	</div>
</form>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
    function readURLPhoto(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#image-preview-photo #photo_carre').css('background', 'url(' + e.target.result + ') no-repeat center').css('background-size', 'cover').height(100)
        };
        reader.readAsDataURL(input.files[0]);
    }
    }
</script>
<?php 
    if(isset($_SESSION['check-upload']) && $_SESSION['check-upload'] == 'OK'){
?>
        <script>
            <?php if($_SESSION['code_upload'] < 200){ ?>
 
            $('#photo_carre').css('background','url(<?php echo $filename; echo '?'; echo time(); ?>) no-repeat center').css('background-size','cover'); 
			$('#photo_carre', parent.document).css('background','url(<?php echo $filename; echo '?'; echo time(); ?>) no-repeat center').css('background-size','cover'); 
			$('#moncompte-1', parent.document).find('.card').removeClass('flipped');
            
            <?php } ?>
			
        
			
                	$('#message', parent.document).css('display','block');
                    $('#message', parent.document).addClass('bounceInLeft animated');
            
            $('#message', parent.document).html('<?php echo $_SESSION['msg_upload']; ?>');
            if(<?php echo $_SESSION['code_upload']; ?> < 200){
                    $('#message', parent.document).addClass('success');    
                }else if(<?php echo $_SESSION['code_upload']; ?> < 300 && <?php echo $_SESSION['code_upload']; ?> >= 200){
                    $('#message', parent.document).addClass('error');
                }else if(<?php echo $_SESSION['code_upload']; ?> < 400 && <?php echo $_SESSION['code_upload']; ?> >= 300){
                    $('#message', parent.document).addClass('warning');
                }
					
					setTimeout(function(){
                    $('#message', parent.document).addClass('bounceOutLeft animated');
					setTimeout(function(){
                		$('#message', parent.document).hide();
						$('#message', parent.document).removeClass('bounceInLeft bounceOutLeft animated success warning error');
					},1000);
                },5000);
			
				
				
			// ajout de la classe JS à HTML
document.querySelector("html").classList.add('js');
 
// initialisation des variables
var fileInput  = document.querySelector( ".input-file" ),  
    button     = document.querySelector( ".input-file-trigger" ),
    the_return = document.querySelector(".file-return");
 
// action lorsque la "barre d'espace" ou "Entrée" est pressée
button.addEventListener( "keydown", function( event ) {
    if ( event.keyCode == 13 || event.keyCode == 32 ) {
        fileInput.focus();
    }
});
 
// action lorsque le label est cliqué
button.addEventListener( "click", function( event ) {
   fileInput.focus();
   return false;
});
 
// affiche un retour visuel dès que input:file change
fileInput.addEventListener( "change", function( event ) {  
    the_return.innerHTML = this.value;  
});
        </script>
<?php
        $_SESSION['check-upload'] = '';
        $_SESSION['code_upload'] = 0;
    }
?>
</body>    
</html>    