<?php

session_start();
include_once 'con_upload.php';
$SendCadImg = filter_input(INPUT_POST, 'SendCadImg', FILTER_SANITIZE_STRING);

if ($SendCadImg) {

    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $nome_imagem = $_FILES['imagem']['name'];

    $result_img = "INSERT INTO imagens (nome, imagem) VALUES (:nome, :imagem)";
    $insert_msg = $conn->prepare($result_img);
    $insert_msg->bindParam(':nome', $nome);
    $insert_msg->bindParam(':imagem', $nome_imagem);

    if ($insert_msg->execute()) {
        $ultimo_id = $conn->lastInsertId();

        // $diretorio = 'imagens/' . $ultimo_id.'/';
        $diretorio = 'imagens/';

        if (!file_exists($diretorio)) {
            mkdir($diretorio, 0755);
        }

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio . $nome_imagem)) {
            $_SESSION['msg'] = "<p style='color:green;'>Dados salvo com sucesso e upload da imagem realizado com sucesso</p>";
            header("Location: upload.php");
        } else {
            $_SESSION['msg'] = "<p><span style='color:green;'>Dados salvo com sucesso. </span><span style='color:red;'>Erro ao realizar o upload da imagem</span></p>";
            header("Location: upload.php");
        }
    } else {
        $_SESSION['msg'] = "<p style='color:red;'>Erro ao salvar os dados</p>";
        header("Location: upload.php");
    }
} else {
    $_SESSION['msg'] = "<p style='color:red;'>Erro ao salvar os dados</p>";
    header("Location: upload.php");
}
