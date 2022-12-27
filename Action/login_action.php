<?php 

session_start();

require_once '../vendor/autoload.php';

if(empty($_POST['user']) or empty($_POST['password'])){
	echo json_encode(array("Status" => 'failed', "Error" => array("client-input-erro" => 'Preencha todos os campos.')), JSON_UNESCAPED_UNICODE);
}else{

	$userC = new App\Controllers\UserController();
	$userC->getUser($_POST['user']);
	$userC->getPass($_POST['password']);

	$response = $userC->login();

	if($response['Status'] == 'sucess'){
		$_SESSION['user_id']       = $response['Data']['id'];
		$_SESSION['user_user']     = $response['Data']['user'];
		$_SESSION['user_name']     = $response['Data']['name'];
		$_SESSION['user_profile']  = $response['Data']['profile_pic'];
		$_SESSION['user_email']    = $response['Data']['email'];
		$_SESSION['user_password'] = $response['Data']['password'];
		$_SESSION['logado'] = true;
		echo json_encode(array('Status' => "sucess", 'Page' => "home.php"));
	}else if($response['Status'] == 'failed'){
		echo json_encode($response);
	}

}



