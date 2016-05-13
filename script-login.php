<?php
    $login = $_POST['login'];
    $file = 'img/profil/v_'.$login.'.jpg';
    $file2 = 'img/profil/v_'.$login.'.png';
    $file3 = 'img/profil/v_'.$login.'.gif';
    if(file_exists($file)){
        echo '{"img": "'.$file.'"}';        
    }else if(file_exists($file2)){
        echo '{"img": "'.$file2.'"}';
    }else if(file_exists($file3)){
        echo '{"img": "'.$file3.'"}';
    }else{
        echo '{"img": "img/photo.jpg"}';
    }
?>