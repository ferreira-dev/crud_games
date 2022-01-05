<?php
session_start();
$id = $_SESSION["id"];

if (empty($id)) {
	header("Location: ../login.php");
	exit;
}
?>

<h2>restrito</h2>
<br><a href="../logout.php">Sair</a>