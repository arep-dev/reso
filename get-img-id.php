<?php

	$id = $_GET['id'];
	$acc = $_GET['acc'];

	$file = 'img/img_id/v_'.$id.'_'.$acc.'.jpg';
	$file2 = 'img/img_id/v_'.$id.'_'.$acc.'.png';
	$file3 = 'img/img_id/v_'.$id.'_'.$acc.'.jpeg';

	if(file_exists($file)){
		echo $file;
	}else if(file_exists($file2)){
		echo $file2;
	}else if(file_exists($file3)){
		echo $file3;
	}else{
		echo 'img_id/inconnu.jpg';
	}

?>
