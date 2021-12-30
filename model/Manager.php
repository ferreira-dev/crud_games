<?php

class Manager extends Conexao
{

	public function login($email, $password)
	{
		session_start();

		if (!empty($email) && !empty($password)) {

			$pdo = parent::get_instance();
			$slt = "select * from user where email = :email and password = :password";
			$query =  $pdo->prepare($slt);
			$query->bindParam(':email', $email, PDO::PARAM_STR);
			$query->bindParam(':password', $password, PDO::PARAM_STR);
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (is_array($row)) {
				$_SESSION["id"]  =  $row['id'];
				$_SESSION["email"] = $row['email'];
				$_SESSION["name"] = $row['name'];
				header("Location: ../view/dashboard.php");
			} else {
				$msg = "usuário ou senha inválidos";
				header("Location: ../login.php?error = " . $msg);
				exit;
			}
		} else {
			$msg = "Preencha os campos";
			header("Location: ../login.php?error = " . $msg);
			exit;
		}
	}

	public function insertUser($table, $data)
	{
		/*
		$pdo  =  parent::get_instance();
		$fields  =  implode(", ", array_keys($data));
		$values  =  ":".implode(", :", array_keys($data));
		$sql  =  "INSERT INTO $table ($fields) VALUES ($values)";
		$statement  =  $pdo->prepare($sql);
		foreach($data as $key   => $value) {
			$statement->bindValue(":$key", $value, PDO::PARAM_STR);
		}
		$statement->execute();

		*/

		$pdo  =  parent::get_instance();
		$email  =  $_POST['email'];
		$slt = "select * from user where email = :email";
		$query =  $pdo->prepare($slt);
		$query->bindParam(':email', $email, PDO::PARAM_STR);
		$query->execute();
		$row = $query->fetch(PDO::FETCH_ASSOC);

		if ($query->rowCount() > 0) {
			$msg = "Ja existe.";
			header("Location: ../register.php?error = " . $msg);
			exit;
		} else {
			$name   =  $_POST['name'];
			$password     =  md5($_POST['password']);
			if (!empty($name) && !empty($email) && !empty($password)) {
				$sql = "insert into user (name,email,password) values(:name,:email,:password)";
				$query  =  $pdo->prepare($sql);
				$query->bindParam(':name', $name, PDO::PARAM_STR);
				$query->bindParam(':email', $email, PDO::PARAM_STR);
				$query->bindParam(':password', $password, PDO::PARAM_STR);
				$query->execute();
				$msg = "Conta criada com sucesso.";
				header('location: ../login.php?success = ' . $msg);
				exit;
			} else {
				$msg = "Preencha os campos";
				header("Location: ../register.php?error = " . $msg);
				exit;
			}
		}


		//
	}

	public function listClient($filtro  =  false)
	{
		$pdo  =  parent::get_instance();
		if (!empty($filtro)) {
			$sql  =  "SELECT * FROM user WHERE `nome`  =  '$filtro';";
		} else {
			$sql  =  "SELECT * FROM user";
		}
		$statement  =  $pdo->query($sql);
		$statement->execute();

		return $statement->fetchAll();
	}

	public function deleteClient($table, $id)
	{
		$pdo  =  parent::get_instance();
		$sql  =  "DELETE FROM $table WHERE id  =  :id";
		$statement  =  $pdo->prepare($sql);
		$statement->bindValue(":id", $id);
		$statement->execute();
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

	public function updateClient($table, $data, $id)
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
	}
}
