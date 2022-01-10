<?php
session_start();
$id = $_SESSION["id"];

include_once 'dependencias.php'; ?>

<h2 class="text-center">
	Cadastro de Jogo <i class="fa fa-plus" aria-hidden="true"></i>
</h2>
<hr>

<form method="POST" action="../controller/insertGame.php" enctype="multipart/form-data">>

	<div class="container">
		<div class="form-row">

			<div class="col-md-10">
			<i class="fa fa-gamepad" aria-hidden="true"></i> Título do Jogo:
				<input class="form-control" type="text" name="titulo" required autofocus><br>
			</div>

			<div class="col-md-2">
			<i class="far fa-calendar" aria-hidden="true"></i> Ano de publicação:
				<input class="form-control" type="number" name="ano_pub" required><br>
			</div>

			<div class="col-md-4">
			<i class="fas fa-dice" aria-hidden="true"></i> Estilo do Jogo:
				<input class="form-control" type="text" name="estilo" required><br>
			</div>

			<div class="col-md-6">
			<i class="fa fa-industry" aria-hidden="true"></i> Desenvolvedora / Distribuidora: 
				<input class="form-control" type="text" name="desenv_distrib" required><br>
			</div>

			<div class="col-md-2">
			<i class="fas fa-star" aria-hidden="true"></i> Nota:
				<input class="form-control" type="number" name="nota" required><br>
			</div>

			<div class="col-md-12">
			<i class="fas fa-images"></i> Imagem:
				<input type="file" class="form-control" name="imagem" required><br>
				<input type="hidden" class="form-control" name="id_usuario" value="<?= $id ?>"><br>
			</div>

			<div class="col-md-4">

				<button class="btn btn-primary btn-lg">

					Cadastrar

				</button>
				<a class="btn btn-warning btn-lg" href="../index.php">
					Voltar
				</a><br><br>


			</div>

		</div>
	</div>

</form>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$("#cpf").mask("000.000.000-00");
		$("#phone").mask("(00) 00000-0000");
	});
</script>