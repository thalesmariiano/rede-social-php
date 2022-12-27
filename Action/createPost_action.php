<?php 

session_start();

require_once '../vendor/autoload.php';

date_default_timezone_set('America/Sao_Paulo');
$date_local = date('d/m/Y - H:i', time());

$post = array("Content" => $_POST['content'],
			  "User"    => $_SESSION['user_user'],
			  "Time"    => $date_local);

if(!empty($_POST['content'])):
	$create = new App\Controllers\PostController();
	echo json_encode($create->createPost($post), JSON_UNESCAPED_UNICODE);
else:
	echo json_encode(array('Status' => "failed", 'Error' => array('content-empty' => "Nada enviado no content.")), JSON_UNESCAPED_UNICODE);
endif;



