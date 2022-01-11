<?php

include_once '../model/Manager.php';

$manager = new Manager();

$data = $_POST;
$data['imagem'] = $_FILES['imagem']['name'];
$id = $_POST['id'];


if (isset($id) && !empty($id)) {
	$manager->updateGame("game", $data, $id);
}
