<?php 

require_once '../vendor/autoload.php';

$nome = $_POST['search'];

$sql = " SELECT `user` FROM users WHERE user LIKE '$nome%' ORDER by user";

$conexao = App\Models\Conexao::getConn()->prepare($sql);
$conexao->execute();

if($conexao->rowCount() > 0){
	foreach($conexao->fetchAll(PDO::FETCH_ASSOC) as $userFinded){
		echo '<li class="list">'.$userFinded['user'].'</li>';
	}
}else{
	echo '<li class="list">Usuário não encontrado.</li>';
}


