<?php 

namespace App\Controllers;
use App\Models\Post;

class PostController {

	public function createPost($p){
		$post = new Post();
		return $post->create_post($p);
	}

	public function readPosts($p){
		$post = new Post();
		return $post->read_posts($p);
	}

	public function deletePost($p){
		$post = new Post();
		return $post->delete_post($p);
	}
}