<?php  

include_once '../model/Conexao.php';
include_once '../model/Manager.php';

$manager = new Manager();

$email = $_POST['email'];
$password = md5($_POST['password']);

if(isset($email) && !empty($password)) {
    
	$manager->login($email, $password);
}

?>