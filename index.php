<?php 

session_start();

// Se usuário já estiver logado, redirecionar para a home
if(isset($_SESSION['logado'])){
	header('Location:  home.php');
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="arquivos/styles/styles.css">

	<title>Login</title>
</head>
<body>

	<div class="container">

		<form id="login-form" action="" method="POST">
			<div id="login-container">
				<h2 class="form-title">Login</h2>
					<div id="login-error-container"></div>
				<div class="input-container">
					<input type="text" name="user" placeholder="Usuário" autocomplete="off">
				</div>
				<div class="input-container">
					<input id="pass" type="password" name="password" placeholder="Senha">
					<div id="seePass"><span class="material-icons">visibility_off</span></div>
				</div>
				<button id="loginBtn" class="btnDefault" type="submit" name="btn-enter">Entrar</button>
			</div>
		</form>
		<p id="createContaLink">Não tem uma conta? <a href="cadastro.php">Crie uma agora!</a></p>
		
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="arquivos/js/Ajax/login_ajax.js"></script>
	<script src="arquivos/js/main.js"></script>
</body>
</html>