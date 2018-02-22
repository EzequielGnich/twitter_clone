<?php

    session_start();

    if(!$_SESSION['usuario']){
		header('Location: index.php?erro=1');
	}

    require_once('db.class.php');

    $id_usuario = $_SESSION['id'];

    $objDb = new db();
    $link = $objDb->conecta_mysql();
    
    $sql = " SELECT DATE_FORMAT(t.data_inclusao, '%d %b %Y %T') AS data_inclusao_formatada, t.tweet, t.id_tweet, u.usuario FROM tweet AS t JOIN usuarios AS u ON (t.id_usuario = u.id) WHERE id_usuario = $id_usuario OR id_usuario IN (SELECT seguindo_id_usuario FROM usuarios_seguidores WHERE id_usuario = $id_usuario) ORDER BY data_inclusao DESC ";

    $resultado_id = mysqli_query($link, $sql);

    if($resultado_id){

        while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){

            echo '<a href="#" class="list-group-item">';
                echo '<h4 class="list-group-item-heading">'.$registro['usuario'].' <small>'.$registro['data_inclusao_formatada'].'</small></h4>';
                echo '<p class="list-group-item-text">'.$registro['tweet'].'</p>';
                echo '<button class="btn btn-warning excluir-tweet" id="'.$registro['id_tweet'].'">Excluir Tweet</button>';
            echo '</a>';
            echo '<div class="clearfix"></div>';
        }

    }else{
    
        echo 'Erro na consulta de tweets no banco de dados!';

    }

?>