<?php

    session_start();

    if(!$_SESSION['usuario']){
		header('Location: index.php?erro=1');
	}

    require_once('db.class.php');

    $id_usuario = $_SESSION['id'];

    if($id_usuario == ''){
        die();
    }

    $objDb = new db();
    $link = $objDb->conecta_mysql();
    
    $sql = "DELETE FROM tweet WHERE id_usuario = $id_usuario limit 1";

    $r = mysqli_query($link, $sql); 

?>