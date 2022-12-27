<?php

require_once 'vendor/autoload.php';

session_start();

$viewName = "cadastro-1";

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="arquivos/styles/styles.css">
	<link rel="stylesheet" href="arquivos/styles/cadastro-styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
	<title>Cadastro</title>
</head>
<body>

	<div class="container">
		<?php 

			include_once 'App/Views/includes/'.$viewName.'.php';
			
		?>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="arquivos/js/Ajax/cadastro_ajax.js"></script>
</body>
</html>