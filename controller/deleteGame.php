<?php  

include_once '../model/Manager.php';

$manager = new Manager();

var_dump($_POST);

$id = $_POST['id'];
$id_usuario = $_POST['id_usuario'];
$imagem = $_POST['imagem'];

if(isset($id) && isset($id_usuario)) {
	$manager->deleteGame("game", $id, $imagem, $id_usuario);
}

?>