<?php
session_start();
include_once 'con_upload.php';

$SendCadImg = filter_input(INPUT_POST, 'SendCadImg', FILTER_SANITIZE_STRING);

if (!$SendCadImg) {
    $_SESSION['msg'] = "<p style='color:red;'>Erro ao salvar os dados, tente novamente. </p>";
    header("Location: upload.php");
}

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$nome_imagem = $_FILES['imagem']['name'];
// var_dump($_FILES['imagem']); 

$result_img = "INSERT INTO imagens (nome, imagem) VALUES (:nome, :imagem)";
$insert_msg = $conn->prepare($result_img);
$insert_msg->bindParam(':name', $nome);
$insert_msg->bindParam(':imagem', $nome_imagem);

$insert_msg->execute();







// parei no 16min video do celke
