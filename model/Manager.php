<?php

include_once 'Conexao.php';
class Manager extends Conexao
{

	public function login($email, $password)
	{
		session_start();

		if (!empty($email) && !empty($password)) {

			$pdo = parent::get_instance();
			$slt = "SELECT * FROM user WHERE email = :email AND password = :password";
			$query =  $pdo->prepare($slt);
			$query->bindParam(':email', $email, PDO::PARAM_STR);
			$query->bindParam(':password', $password, PDO::PARAM_STR);
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (is_array($row)) {
				$_SESSION["id"]  =  $row['id'];
				$_SESSION["email"] = $row['email'];
				$_SESSION["name"] = $row['name'];
				header("Location: ../index.php");
			} else {
				$_SESSION['error'] = "usuário ou senha inválidos";
				header("Location: ../view/login.php");
				exit;
			}
		} else {
			$_SESSION['error'] = "Preencha os campos";
			header("Location: ../view/login.php");
			exit;
		}
	}

	public function insertUser()
	{

		$pdo  =  parent::get_instance();
		$email  =  $_POST['email'];
		$slt = "select * from user where email = :email";
		$query =  $pdo->prepare($slt);
		$query->bindParam(':email', $email, PDO::PARAM_STR);
		$query->execute();
		$query->fetch(PDO::FETCH_ASSOC);

		if ($query->rowCount() > 0) {
			$_SESSION['error'] = "Ja existe um usuário com esse email cadastrado.";
			header("Location: ../view/register.php");
			exit;
		} else {
			$name   =  $_POST['name'];
			$password     =  md5($_POST['password']);
			if (!empty($name) && !empty($email) && !empty($password)) {
				$sql = "INSERT INTO user (name,email,password) values(:name,:email,:password)";
				$query  =  $pdo->prepare($sql);
				$query->bindParam(':name', $name, PDO::PARAM_STR);
				$query->bindParam(':email', $email, PDO::PARAM_STR);
				$query->bindParam(':password', $password, PDO::PARAM_STR);
				$query->execute();
				$_SESSION['success'] = "Conta criada com sucesso.";
				header('location: ../view/login.php');
				exit;
			} else {
				$_SESSION['error'] = "Preencha os campos";
				header("Location: ../view/register.php");
				exit;
			}
		}


		//
	}

	public function insertGame()
	{
		$pdo  =  parent::get_instance();
		$titulo   =  $_POST['titulo'];
		$ano_pub   =  $_POST['ano_pub'];
		$imagem = $_FILES['imagem']['name'];
		$estilo   =  $_POST['estilo'];
		$desenv_distrib   =  $_POST['desenv_distrib'];
		$nota   =  $_POST['nota'];
		$id_usuario   =  $_POST['id_usuario'];

		if (!empty($_POST) && !empty($_FILES)) {

			$sql = "INSERT INTO game (titulo,ano_pub,imagem,estilo,desenv_distrib,nota,id_usuario) values(:titulo,:ano_pub,:imagem,:estilo,:desenv_distrib,:nota,:id_usuario)";
			$query  =  $pdo->prepare($sql);
			$query->bindParam(':titulo', $titulo, PDO::PARAM_STR);
			$query->bindParam(':ano_pub', $ano_pub, PDO::PARAM_STR);
			$query->bindParam(':imagem', $imagem);
			$query->bindParam(':estilo', $estilo, PDO::PARAM_STR);
			$query->bindParam(':desenv_distrib', $desenv_distrib, PDO::PARAM_STR);
			$query->bindParam(':nota', $nota, PDO::PARAM_STR);
			$query->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
			$query->execute();

			$diretorio = '../view/assets/imagens/';

			if (!file_exists($diretorio)) {
				mkdir($diretorio, 0755);
			}

			if (move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio . $imagem)) {
				header('location: ../index.php');
				exit;
			}
		}

		exit;
	}

	public function listGame($id, $filtro = false)
	{
		$pdo  =  parent::get_instance();
		if (!empty($filtro)) {
			$sql  =  "SELECT * FROM game WHERE titulo LIKE '%{$filtro}%' AND id_usuario = {$id}; ";
		} else {
			$sql  =  "SELECT * FROM game WHERE id_usuario = {$id}; ";
		}
		$statement  =  $pdo->query($sql);
		$statement->execute();
		// criaaar msg de erro ->nao encontrado

		return $statement->fetchAll();
	}

	public function deleteGame($table, $id, $imagem, $id_usuario)
	{
		$pdo  =  parent::get_instance();
		$sql  =  "DELETE FROM $table WHERE id  =  :id AND id_usuario = :id_usuario";
		$statement  =  $pdo->prepare($sql);
		$statement->bindParam(":id", $id);
		$statement->bindParam(":id_usuario", $id_usuario);
		$statement->execute();

		$caminho = $_SERVER['DOCUMENT_ROOT'];
		unlink("{$caminho}/view/assets/imagens/{$imagem}");
		header('location: ../index.php');
	}

	public function buscaUsuario($busca)
	{
		$pdo  =  parent::get_instance();
		$sql  =  "SELECT * FROM user WHERE `nome`  =  '$busca';";
		$statement  =  $pdo->prepare($sql);
		//$statement->bindValue(":nome", $busca);
		$statement->execute();
		return $statement->fetchAll();
	}

	public function getInfo($table, $id)
	{
		$pdo  =  parent::get_instance();
		$sql  =  "SELECT * FROM $table WHERE id  =  :id";
		$statement  =  $pdo->prepare($sql);
		$statement->bindValue(":id", $id);
		$statement->execute();

		return $statement->fetchAll();
	}

	public function updateGame($table, $data, $id)
	{
		$pdo  =  parent::get_instance();
		$new_values  =  "";
		foreach ($data as $key   => $value) {
			$new_values .=  "$key =:$key, ";
		}
		$new_values  =  substr($new_values, 0, -2);
		$sql  =  "UPDATE $table SET $new_values WHERE id  =  :id";
		$statement  =  $pdo->prepare($sql);
		foreach ($data as $key   => $value) {
			$statement->bindValue(":$key", $value, PDO::PARAM_STR);
		}
		$statement->execute();

		$diretorio = '../view/assets/imagens/';
		$imagem = $data['imagem'];

		if (move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio . $imagem)) {
			$_SESSION['msg'] = "<p style='color:green;'>Dados salvo com sucesso e upload da imagem realizado com sucesso</p>";
			header('location: ../index.php');
			exit;
		}
	}
}
