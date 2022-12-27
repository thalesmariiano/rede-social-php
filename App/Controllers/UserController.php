<?php 

namespace App\Controllers;

use App\Models\User;

class UserController {
	private $userInfo = array();

	public function getName($n){
		$this->userInfo['name'] = $n;
	}

	public function getUser($u){
		$this->userInfo['user'] = $u;
	}

	public function getEmail($e){
		$this->userInfo['email'] = $e;
	}

	public function getPass($p){
		$this->userInfo['password'] = $p;
	}

	public function login(){
		$user = new User();
		return $user->login($this->userInfo);
	}

	public function register(){
		$user = new User();
		return $user->create_account($this->userInfo);
	}

}