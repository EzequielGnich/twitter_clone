<?php

    session_start();

    if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	} else {
        require_once('db.class.php');

        $id_usuario = $_SESSION['id'];
        $id_tweet   = $_POST['id_tweet'];

        $objDb = new db();
        $link = $objDb->conecta_mysql();

        $sql = "DELETE FROM tweet WHERE id_tweet = $id_tweet AND id_usuario = $id_usuario limit 1";

        mysqli_query($link, $sql);
    }
?>