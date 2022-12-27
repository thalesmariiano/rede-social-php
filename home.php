<?php 

session_start();

if(!$_SESSION['logado'] == true){
	session_unset();
	session_destroy();
	header('Location: ./');
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="arquivos/styles/styles.css">
	<link rel="stylesheet" href="arquivos/styles/home_styles.css">

	<title>Home</title>
</head>
<body>
	<header>
		<div id="search-container">
			<div id="search-input-container">
				<input id="search-input" type="text" name="search" placeholder="Pesquisar usuário" autocomplete="off">
				<span style="cursor:default;" class="material-icons">search</span>
			</div>
			<div id="user-list">
				<ul id="list-ul"></ul>
			</div>
		</div>
		<button class="btnDefault" onclick="window.location.replace('Action/logout_action.php')">Sair</button>
	</header>


	<div id="home-container">
		<div id="main">

			<div id="u-post-container">
				<div id="u-icon-container">
					<img id="u-icon" title="<?php echo $_SESSION['user_name'] ?>" src="users_profiles/<?php echo $_SESSION['user_profile']; ?>">
				</div>
				<form id="post-form" method="POST">
					<div id="textarea-container">
						<textarea id="textArea" name="content" placeholder="Escreva algo..."></textarea>
					</div>
					<div id="u-post-items">
						<div id="u-post-interact">
							<span class="material-icons">emoji_emotions</span>
							<span class="material-icons">image</span>
						</div>
						<div id="sendPost-btn-container">
							<button id="sendPost-btn" class="blockBtn" type="submit">Postar</button>
						</div>
					</div>
				</form>
			</div>

			<div id="post-container">
				<div class="spinner-container">
					<div class="spinner"></div>
				</div>
				
			</div>

		</div>
	</div>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="arquivos/js/Ajax/search-user_ajax.js"></script>
	<script src="arquivos/js/Ajax/posts_ajax.js"></script>
</body>
</html>