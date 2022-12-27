<?php 

session_start();

require_once '../vendor/autoload.php';

$getPost = new App\Controllers\PostController();
echo json_encode($getPost->readPosts($_SESSION['user_user']), JSON_UNESCAPED_UNICODE);




