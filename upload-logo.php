<?php session_start(); ?>
<html>
<head>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/upload.css">
</head>
<body>
    <div id="image-preview-logo">
    
				<?php
				   $filename = 'img/entreprise/v_'.$_SESSION['PRO_NUM'].'.jpg';
			
					if(file_exists($filename)){
						echo '<div id="logo_carre" style="background:url(img/entreprise/v_'.$_SESSION['PRO_NUM'].'.jpg?'.time().') no-repeat center; background-size:contain;"></div>';
					}else{
						$filename = 'img/entreprise/v_'.$_SESSION['PRO_NUM'].'.png';
						if(file_exists($filename)){
							echo '<div id="logo_carre" style="background:url(img/entreprise/v_'.$_SESSION['PRO_NUM'].'.png?'.time().') no-repeat center; background-size:contain;"></div>';
						}else{
							$filename = 'img/logo.jpg';
							echo '<div id="logo_carre" style="background:url(img/logo.jpg) no-repeat center; background-size:contain;"></div>';
						}
					}
				?>
				
    </div>
<div id="msg-nodisplay" class="warning"><i class="fa fa-exclamation-triangle"></i> Votre logo ne doit pas dépasser 5 Mo</div>  
<form method="post" action="traitement.php" id="form-upload-photo" enctype="multipart/form-data">
    <input type="hidden" name="traitement" value="upload-logo">
    <div class="input-file-container">
    <input type="file" name="file" id="my-file" class="input-file" onchange="readURLLogo(this);">
  <label for="my-file" class="input-file-trigger" tabindex="0">Choisir un logo...</label>
  </div>
  <div class="ligne">
    <input type="submit" name="send" value="Enregistrer">
	</div>
</form>
<form method="post" action="traitement.php">
    <input type="hidden" name="traitement" value="delete">
    <input type="hidden" name="target" value="logo">
    <div class="ligne">
	<input type="submit" name="send" value="Supprimer">
	</div>
</form>    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
    function readURLLogo(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#image-preview-logo #logo_carre').css('background', 'url(' + e.target.result + ') no-repeat center').css('background-size', 'contain').height(100)
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
 
            $('#logo_carre').css('background','url(<?php echo $filename; echo '?'; echo time(); ?>) no-repeat center').css('background-size','contain'); 
			$('#logo_carre', parent.document).css('background','url(<?php echo $filename; echo '?'; echo time(); ?>) no-repeat center').css('background-size','contain'); 
			$('#moncompte-2', parent.document).find('.card').removeClass('flipped');
            
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
				
        </script>
<?php
        $_SESSION['check-upload'] = '';
        $_SESSION['code_upload'] = 0;
    }
?>
</body>    
</html>    