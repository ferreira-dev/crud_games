<?php  

include_once '../model/Manager.php';

$manager = new Manager();
$data = $_POST;

if(isset($data) && !empty($data)) {
	$manager->insertGame();
}

?>