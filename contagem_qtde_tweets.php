<?php
	
	// Inicia a sessão
	session_start();
	// Verifica se a sessão foi inicializada com um usuário valido - senão ela redireciona para a home com um erro = ?=erro1
	if(!$_SESSION['usuario']){
		header('Location: index.php?erro=1');
	}

	require_once('db.class.php');

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$id_usuario = $_SESSION['id'];

	// Quantidade de tweets
	// Query de consulta no banco de dados para capturar quantidade de tweets de um usuário
	$sql = " SELECT COUNT(*) AS qtde_tweets FROM tweet WHERE id_usuario = $id_usuario";
	// Execução da query
	$resultado_id = mysqli_query($link, $sql);

	// Variável para receber a quantidade de tweets que um usuário possui
	$qtde_tweets = 0;

	// Teste de validação se a execução da query foi true(se ela retornou algum resultado)
	if($resultado_id) {
		$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);

		// Variável $qtde_tweets recebendo o resultado da execução da query capturando o indice 'qtde_tweets'
		$qtde_tweets = $registro['qtde_tweets'];

		// echo para inserir um h5 na tag <p></p> com a quantidade de tweets do usuário
		echo '<h5 class="list-group-item">'.$qtde_tweets.'</h5>';

	} else {
		alert('Erro na query de contagem de tweets');
	}

?>