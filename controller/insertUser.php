<?php  

include_once '../model/Conexao.php';
include_once '../model/Manager.php';

$manager = new Manager();

$data = $_POST;

if(isset($data) && !empty($data)) {
	$manager->insertUser("user", $data);
	
	header("Location: ../login.php?client_add_success");
}

?>