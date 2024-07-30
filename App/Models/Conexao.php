<?php 

namespace App\Models;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

class Conexao {
	private static $conn;

	public static function getConn(){
		
		if(!isset(self::$conn)):
			self::$conn = new \PDO(
				$_ENV['DB_DRIVER'].':host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'].';charset=utf8',
				$_ENV['DB_USER'],
				$_ENV['DB_PASS']);
		endif;

		return self::$conn;
	}
}