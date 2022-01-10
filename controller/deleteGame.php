<?php

include_once '../model/Manager.php';

$manager = new Manager();

$id = $_POST['id'];
$id_usuario = $_POST['id_usuario'];
$imagem = $_POST['imagem'];

if (isset($id) && isset($id_usuario) && isset($imagem)) {
	$manager->deleteGame("game", $id, $imagem, $id_usuario);
}
