<?php 

namespace App\Models;

class Post {

	public function create_post($i){

		$content = $i['Content'];
		$time = $i['Time'];
		$user = $i['User'];

		$sql = " INSERT INTO posts (`p-content`, `p-time`, `p-user`) VALUES ( ?, ?, ?) ";

		$createPost = Conexao::getConn()->prepare($sql);
		$createPost->bindValue(1, $content);
		$createPost->bindValue(2, $time);
		$createPost->bindValue(3, $user);

		if($createPost->execute()){
			return array('Status' => "sucess", 'Log' => array("Post publicado com sucesso"));
		}else{
			return array('Status' => 'failed', 'Error' => array('server-insert-erro' => $createPost->errorInfo()));
		}
	}

	public function read_posts($i){

		$user = $i;
		$sql = " SELECT `p-user` FROM posts WHERE `p-user`='$user' ";

		$getPosts = Conexao::getConn()->prepare($sql);
		$getPosts->execute();

		if($getPosts->rowCount() > 0){

			$sql = " SELECT * FROM posts WHERE `p-user`='$user' ";

			$getPosts = Conexao::getConn()->prepare($sql);
			$getPosts->execute();

			return array('Status' => "sucess", 'Data' => $getPosts->fetchAll(\PDO::FETCH_ASSOC));
		}else{
			return array('Status' => "failed", 'Error' => array('empty' => "Você não publicou nada ainda."));
		}
	}

	public function update_post(){	
	}

	public function delete_post($i){

		$postId = $i['postId'];
		$user = $i['user'];

		$sql = "SELECT `p-user`, `id` FROM posts WHERE `p-user`='$user' AND `id`='$postId' ";

		$verifyUser = Conexao::getConn()->prepare($sql);
		$verifyUser->execute();

		if($verifyUser->rowCount() > 0){
			$sql = " DELETE FROM `posts` WHERE `id`='$postId' AND `p-user`='$user' ";

			$deletePost = Conexao::getConn()->prepare($sql);

			if($deletePost->execute()){
				return array('Status' => "sucess", 'Data' => "Postagem deletada com sucesso");
			}
		}
	}

}