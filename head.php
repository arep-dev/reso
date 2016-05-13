<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Challenge AREP</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/animate.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="css/jquery.mmenu.all.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
<script src="js/bjqs-1.3.min.js"></script>
<script src="js/jquery.mmenu.min.all.js"></script>
<script class="secret-source">
	jQuery(document).ready(function($) {
		$('#banner-fade').bjqs({
			responsive: true,
			animspeed: 8000,
			showmarkers: false,
			nexttext: '<div class="fleches"><i class="fa fa-angle-right"></i></div>',
			prevtext: '<div class="fleches"><i class="fa fa-angle-left"></i></div>'
		});
	});
</script>
<script>
	$(document).ready(function() {
		var _hauteurzone = ($(window).height() - 40);
		$(".backgroundvoyage").css("height", _hauteurzone);
		$("#banner-fade").css("height", _hauteurzone);
		$(".bjqs").css("height", _hauteurzone);
		$(".bjqs-slide").css("height", _hauteurzone);;
		$("#container").css("height", _hauteurzone - 20);
		$(".container2").css("height", _hauteurzone - 220);
		$("#container-noscroll").css("height", _hauteurzone);
		var is_opera = navigator.userAgent.toLowerCase().indexOf("op") > -1;
		if (is_opera == true) {
			$("#container-noscroll").css("height", "auto");
			var _largeuropera = ($("#contenu").width() - 275);
			var _largeuraccompagnantopera = ($("#contenu").width() - 315);
			var _largeuraccompagnantinfosopera = ($("#contenu").width() - 515);
			$("#container").css("width", _largeuropera);
			$(".accompagnant").css("width", _largeuraccompagnantopera);
			$(".accompagnant_details").css("width", _largeuraccompagnantinfosopera);
			$(".bjqs-prev .fleches").css("left", "20px");
			$(".bjqs-prev .fleches").css("position", "fixed");
		}
		$(window).resize(function() {
			var _hauteurzone = ($(window).height() - 40);
			$(".backgroundvoyage").css("height", _hauteurzone);
			$("#banner-fade").css("height", _hauteurzone);
			$(".bjqs").css("height", _hauteurzone);
			$(".bjqs-slide").css("height", _hauteurzone);
			$("#container").css("height", _hauteurzone - 20);
			$(".container2").css("height", _hauteurzone - 220);
			$("#container-noscroll").css("height", _hauteurzone);
			var is_opera = navigator.userAgent.toLowerCase().indexOf("op") > -1;
			if (is_opera == true) {
				$("#container-noscroll").css("height", "auto");
				var _largeuropera = ($("#contenu").width() - 275);
				var _largeuraccompagnantopera = ($("#contenu").width() - 315);
				var _largeuraccompagnantinfosopera = ($("#contenu").width() - 515);
				$("#container").css("width", _largeuropera);
				$(".accompagnant").css("width", _largeuraccompagnantopera);
				$(".accompagnant_details").css("width", _largeuraccompagnantinfosopera);
				$(".bjqs-prev .fleches").css("left", "20px");
				$(".bjqs-prev .fleches").css("position", "fixed");
			}
		});
		var width = $(window).width();
		if (width < 960) {
			$('input[name=input_device]').attr('value', 'mobile');
		}
		if (width > 959) {
			$('input[name=input_device]').attr('value', 'desktop');
		}
		$(window).resize(function() {
			var width = $(window).width();
			if ((width > 959) && ($('input[name=input_device]').val() == 'mobile')) {
				document.location.href = "index.php";
				$("#close").fadeOut();
			}
		});
		$(window).resize(function() {
			var width = $(window).width();
			if (width < 960) {
				$('input[name=input_device]').attr('value', 'mobile');
			}
			if (width > 959) {
				$('input[name=input_device]').attr('value', 'desktop')
			}
		});
        
		$("textarea").focusout(function() {
			$("#msg_valid").fadeIn(function() {
				setTimeout(function() {
					$("#msg_valid").fadeOut();
				}, 3000);
			});
		});
	});
</script>
