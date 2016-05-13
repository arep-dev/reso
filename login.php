<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Document sans titre</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<link href="css/animate.css" rel="stylesheet" type="text/css" />
<link href="css/login.css" rel="stylesheet" type="text/css" />
<script src="js/utils.js"></script>
<script src="js/flip-card.js"></script>
<script src="js/login.js"></script>
</head>

<body>
<section class="container bounceInUp animated">
    <div id="card">
      <figure class="front">
	  <div class="connexion">
			<div class="photo_connexion" style="background:url(img/photo.jpg) no-repeat center; background-size:cover;">
			</div>
			<div id="msg1"></div>
			<form method="post" onSubmit="return false;" action="" id="form1">
				<div class="input_connexion"><i class="fa fa-user"></i><input type="text" name="login" maxlength="30" placeholder="Identifiant"></div>
				<div class="input_connexion"><i class="fa fa-lock"></i><input type="password" name="pass" maxlength="30" placeholder="Mot de passe"></div>
				<input type="hidden" name="traitement" value="login">
				<input type="submit" name="log" value="Connexion" class="animate">
			</form>
			<a href="#" id="flip">Mot de passe oublié ?</a>
			<img src="img/logo-challenge.png" />
		</div>
	  </figure>
      <figure class="back">
	  <div class="connexion">
			<div class="photo_connexion" style="background:url(img/photo.jpg) no-repeat center; background-size:cover;">
			</div>
			<div id="msg2"></div>
			<form method="post" action="" id="form2" onSubmit="return false;">
				<div class="input_connexion"><i class="fa fa-user"></i><input type="text" name="identifiant" maxlength="30" placeholder="Identifiant"></div>
				<input type="submit" name="log" value="Récupérer mon mot de passe" class="animate">
			</form>
			<a href="#" id="flip2"><i class="fa fa-arrow-left"></i> Revenir à la page de connexion</a>
			<img src="img/logo-challenge.png" />
		</div>
		</figure>
    </div>
</section>
<div id="mobile_footer"></div>

</body>
</html>