<?php
    session_start();
    if(!isset($_SESSION['log']) && $_SESSION['log'] != 1){
        header('Location: login.php');
    }
?>
<!DOCTYPE html> 
<html>
<head>
    <title>Challenge AREP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<link href="css/animate.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>

<body class="bgindex">
<div id="background"></div>
<div id="header">
	<div id="logo">
		<a href="index.php">
			<img src="img/logo.png" />
		</a>
	</div>
    
    <?php
        require('carte.php');
    ?>
    
	<div id="carte_contenu">
        <div id="loader">
                <i class="fa fa-spinner fa-pulse"></i>
		</div>
		<div id="contenu">     
        </div>
	</div>
</div>  
<div id="message"></div>  
<script src="js/script.js"></script>
</body>
</html>