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

	// Quantidade de seguidores
	// Query de consulta no banco de dados para capturar a quantidade de seguidores de um usuário
	$sql = " SELECT COUNT(*) AS qtde_seguidores FROM usuarios_seguidores WHERE seguindo_id_usuario = $id_usuario ";

	// Execução da query
	$resultado_id = mysqli_query($link, $sql);

	// Variável para receber a quantidade de seguidores que um usuário possui
	$qtde_seguidores = 0;

	// Teste de validação se a execução da query foi true(se ela retornou algum resultado)
	if($resultado_id) {
		$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);

		// Variável $qtde_seguidores recebendo o resultado da execução da query capturando o indice 'qtde_seguidores'
		$qtde_seguidores = $registro['qtde_seguidores'];

		// echo para inserir um h5 na tag <p></p> com a quantidade de tweets do usuário
		echo '<h5 class="list-group-item">'.$qtde_seguidores.'</h5>';


	} else {
		alert('Erro ao executar a query');
	}


	?>