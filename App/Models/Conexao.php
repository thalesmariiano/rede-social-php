<?php 

namespace App\Models;

class Conexao {
	private static $conn;

	public static function getConn(){
		
		if(!isset(self::$conn)):
			self::$conn = new \PDO('mysql:host=localhost;dbname=rede_social_foda;charset=utf8', 'root', '');
		endif;

		return self::$conn;
	}
}