<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo Upload de imagem</title>
</head>

<body>
    <h2>Cadastrar Imagem</h2>
    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION);
    }

    ?>

    <form action="proc_cad_img.php" method="POST" enctype="multipart/form-data">
        <label>Nome:</label>
        <input type="text" name="nome" placeholder="Digitar o nome"><br><br>

        <label>Imagem</label>
        <input type="file" name="imagem">
        <br><br>
        <input name="SendCadImg" type="submit" value="Cadastrar">
    </form>
</body>

</html>