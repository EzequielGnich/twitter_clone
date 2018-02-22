<?php
	session_start();
	if(!$_SESSION['usuario']){
		header('Location: index.php?erro=1');
	}
?>
<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Twitter clone</title>
		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script type="text/javascript">
			$(document).ready(function(){
				//associa evento de click ao btn_tweet
				$('#btn_tweet').click(function(){
					if($('#texto_tweet').val().length > 0){
						$.ajax({
							url: 'inclui_tweet.php',
							method: 'POST',
							data: $('#form_tweet').serialize(),
							success: function(data){
								$('#texto_tweet').val('');
								qtde_seguidores();
								qtde_tweets();
								atualizaTweet();
							}
						});
					}
				});
				$('.excluir-tweet').click(function(e) {
				  e.preventDefault();
				  /* sempre que alguém clicar num elemento com a classe excluir-tweet, essa função vai acontecer */
				  $.ajax({
				    url: 'exclui_tweet.php',
				    method: 'POST',
				    data: { id_tweet : this.id_tweet },
				    success: function(data){
				      qtde_tweets();
				      atualizaTweet();
				    }
				  });

				});
				function atualizaTweet(){
					//carregar os tweets
					$.ajax({
						url: 'get_tweet.php',
						success: function(data){
							$('#tweets').html(data);
						}
					});
				}
				function qtde_tweets(){
					$.ajax({
						url: 'contagem_qtde_tweets.php',
						success: function(data){
							$('#qtde_tweet_usuario').html(data);
						}
					});
				}
				function qtde_seguidores(){
					$.ajax({
						url: 'contagem_qtde_seguidores.php',
						success: function(data){
							$('#qtde_seguidores_usuario').html(data);
						}
					});
				}
				qtde_seguidores();
				qtde_tweets();
				atualizaTweet();
			});
		</script>
	</head>
	<body>
		<!-- Static navbar -->
		<nav class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<img src="imagens/icone_twitter.png" />
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="sair.php">Sair</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</nav>
		<div class="container">
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<h4><?= $_SESSION['usuario'] ?></h4>
						<hr />
						<div class="col-md-6">
							TWEETS <br /> <p id="qtde_tweet_usuario"></p>
						</div>
						<div class="col-md-6">
							SEGUIDORES <br /><p id="qtde_seguidores_usuario"></p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-body">
						<form id="form_tweet" class="input-group">
							<input type="text" id="texto_tweet" name="texto_tweet" class="form-control" placeholder="O que está acontecendo agora?" maxlength="140" />
							<span class="input-group-btn">
								<button class="btn btn-default" id="btn_tweet" type="button">Tweet</button>
							</span>
						</form>
					</div>
				</div>
				<div id="tweets" class="list-group"></div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<h4><a href="procurar_pessoas.php">Procurar por pessoas</a></h4>
					</div>
				</div>
			</div>
		</div>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</body>
</html>