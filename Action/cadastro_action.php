<?php 

require_once '../vendor/autoload.php';
session_start();

if(empty($_POST['name']) or empty($_POST['user']) or empty($_POST['email']) or empty($_POST['password'])){
	echo json_encode(array("Status" => 'failed', "Error" => array("client-input-erro" => "Preencha todos os campos.")), JSON_UNESCAPED_UNICODE);
}else{

	$userC = new App\Controllers\UserController();
	$userC->getName($_POST['name']);
	$userC->getUser($_POST['user']);
	$userC->getEmail($_POST['email']);
	$userC->getPass($_POST['password']);

	$response = $userC->register();

	if($response['Status'] == 'sucess'){
		$login = new App\Controllers\UserController();
		$login->getUser($_POST['user']);
		$login->getPass($_POST['password']);
		
		$loginResponse = $login->login();

		$_SESSION['user_id']       = $loginResponse['Data']['id'];
		$_SESSION['user_user']     = $loginResponse['Data']['user'];
		$_SESSION['user_name']     = $loginResponse['Data']['name'];
		$_SESSION['user_profile']  = $loginResponse['Data']['profile_pic'];
		$_SESSION['user_email']    = $loginResponse['Data']['email'];
		$_SESSION['user_password'] = $loginResponse['Data']['password'];
		$_SESSION['logado'] = true;

		echo json_encode(array('Status' => "sucess", 'Page' => "home.php"));

	}else{
		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}

}



