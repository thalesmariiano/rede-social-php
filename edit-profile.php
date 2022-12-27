<?php 

require_once 'vendor/autoload.php';

session_start();

if(!isset($_SESSION['logado'])){
	header('Location:  index.php');
}

if(isset($_POST['btn-editar'])):

	$newName = $_POST['name'];
	$newUser = $_POST['user'];
	$newPhoto = $_FILES['upload'];
	$Id = $_SESSION['user_id'];

	$sql = " SELECT `user` FROM users WHERE user = '$newUser' ";
	$conexao = App\Models\Conexao::getConn()->prepare($sql);
	$conexao->execute();

	if($conexao->rowCount() > 0){
		$userExist = "Esse usuário já existe.";
	}else{

		$formatos = array("png", "jpg", "jpeg", "gif");
		$imageExtension = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);

		if(in_array($imageExtension, $formatos)){
			$pasta = "App/users_profiles/";
			$tmpName = $_FILES['upload']['tmp_name'];
			$newPhoto = uniqid().".$imageExtension";
			move_uploaded_file($tmpName, $pasta.$newPhoto);
			$_SESSION['user_profile'] = $newPhoto;
			$_SESSION['user_user'] = $newUser;
			$_SESSION['user_name'] = $newName;

			$sql = " UPDATE `users` SET `name`='$newName', `user`='$newUser', `profile_pic`='$newPhoto' WHERE id = '$Id' ";
			$conexao = App\Models\Conexao::getConn()->prepare($sql);
			$conexao->execute();
		}else{
			$imgError = "O formato ".'"'.$imageExtension.'"'."Não é permitido.";
		}
	}

endif;


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="arquivos/styles/styles.css">
	<link rel="stylesheet" href="arquivos/styles/edit-styles.css">
	<title>Cadastro</title>
</head>
<body>
	<header style="padding:5px">
		<button class="btnDefault" onClick="window.location.replace('home.php')">Voltar</button>
	</header>

	<div class="container">

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
			<div id="edit-container">
				<div id="profile-container">
					<div id="user-photo">
						<img id="photo" src="App/users_profiles/<?php echo $_SESSION['user_profile']; ?>">
						<label for="input-hidden" id="edit-img">
							Mudar foto
							<input id="input-hidden" style="display: none;" type="file" name="upload">
						</label>
						<?php if(!empty($imgError)){ echo "<p style='color:red;'>$imgError</p>";} ?>
					</div>
					<div class="input-container">
						<input type="text" name="name" value="<?php echo $_SESSION['user_name']; ?>">
					</div>
					<div class="input-container">
						<input type="text" name="user" value="<?php echo $_SESSION['user_user']; ?>">
					</div>
					<?php if(!empty($userExist)){ echo "<p style='color:red;'>$userExist</p>";} ?>
					<div title="Não é possivel editar ainda" class="input-container">
						<input type="email" name="" value="<?php echo $_SESSION['user_email']; ?>">
					</div>
					<div title="Não é possivel editar ainda" class="input-container">
						<input type="password" name="" value="<?php echo $_SESSION['user_password']; ?>">
					</div>
				</div>
				<button class="btnDefault" type="submit" name="btn-editar">Editar</button>
			</div>
		</form>
	</div>

	<script src="arquivos/scripts/edit-main.js"></script>
</body>
</html>