<?php  

include_once '../model/Conexao.php';
include_once '../model/Manager.php';

$manager = new Manager();

$update_client = $_POST;
$id = $_POST['id'];

if(isset($id) && !empty($id)) {
	$manager->updateClient("registros", $update_client, $id);

	header("Location: ../index.php?client_update");
}

?>