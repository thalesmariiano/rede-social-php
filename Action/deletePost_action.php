<?php 

session_start();

require_once '../vendor/autoload.php';

$postC = new App\Controllers\PostController();

echo json_encode($postC->deletePost(array('user' => $_SESSION['user_user'], 'postId' => $_POST['id'])));