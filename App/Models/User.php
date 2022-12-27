<?php

namespace App\Models;

class User {

	public function login($i){

		$user = $i['user'];
		$pass = md5($i['password']);

		$sql = " SELECT `user` FROM users WHERE `user`='$user' ";

		$login = Conexao::getConn()->prepare($sql);
		$login->execute();

		if($login->fetch(\PDO::FETCH_ASSOC) > 0){

			$sql = " SELECT user, password FROM users WHERE `user`='$user' AND `password`='$pass' ";

			$login = Conexao::getConn()->prepare($sql);
			$login->execute();

			if(!$login->fetchAll(\PDO::FETCH_ASSOC) == null){
				
				$sql = " SELECT * FROM users WHERE `user`='$user' AND `password`='$pass' ";

				$login = Conexao::getConn()->prepare($sql);
				$login->execute();

				foreach($login->fetchAll(\PDO::FETCH_ASSOC) as $uI) {
					return array("Status" => 'sucess', "Data" => $uI);
				}

			}else{
				return array("Status" => 'failed', "Error" => array("client-input-erro" => 'Senha incorreta.'));
			}
		}else{
			return array("Status" => "failed", 'Error' => array('client-input-erro' => 'Esse usuário não existe.'));
		}
	}
	
	public function create_account($i){

		$name        = $i['name'];
		$user        = $i['user'];
		$profile_pic = "blank_profile.png";
		$email       = $i['email'];
		$pass        = $i['password'];

		$sql = " SELECT `user` FROM users WHERE `user`='$user' ";

		$register = Conexao::getConn()->prepare($sql);
		$register->execute();

		if(!$register->fetch(\PDO::FETCH_ASSOC) > 0){

			$sql = " SELECT `email` FROM users WHERE `email`='$email' ";

			$register = Conexao::getConn()->prepare($sql);
			$register->execute();

			if(!$register->fetch(\PDO::FETCH_ASSOC) > 0){

				$sql = " INSERT INTO users (name, user, profile_pic, email, password) VALUES (?,?,?,?,?) ";

				$registrar = Conexao::getConn()->prepare($sql);
				$registrar->bindValue(1, $name);
				$registrar->bindValue(2, $user);
				$registrar->bindValue(3, $profile_pic);
				$registrar->bindValue(4, $email);
				$registrar->bindValue(5, md5($pass));

				if($registrar->execute()){
					return array("Status" => 'sucess', "Data" => 'Deu bomkjkj');
				}else{
					return array("Status" => 'failed', "Error" => array("server-insert-error" => $registrar->errorInfo()));
				}
			}else{
				return array("Status" => 'failed', "Error" => array("client-email-erro" => 'Esse email já existe!'));
			}

		}else{
			return array("Status" => 'failed', "Error" => array("client-user-erro" => 'Esse usuário já existe!'));
		}
	}

	public function read_account(){
	}

	public function update_account($i){
	}

	public function delete_account($i){
	}
	
}