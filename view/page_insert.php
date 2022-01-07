<?php include_once 'dependencias.php'; ?>

<!-- 
	Título do jogo;
Ano de publicação;
Estilo do jogo;
Desenvolvedora/Distribuidora;
//
coluna no banco:
titulo / ano_pub / estilo / desenv_distrib / nota / id_usuario
 -->

<h2 class="text-center">
	Cadastro de Jogo <i class="fa fa-plus" aria-hidden="true"></i>
</h2>
<hr>

<form method="POST" action="../controller/insertGame.php" enctype="multipart/form-data">>

	<div class="container">
		<div class="form-row">

			<div class="col-md-10">
				Título do Jogo: <i class="fa fa-gamepad" aria-hidden="true"></i>
				<input class="form-control" type="text" name="titulo" required autofocus><br>
			</div>

			<div class="col-md-2">
				Ano de publicação: <i class="fa fa-calendar-o" aria-hidden="true"></i>
				<input class="form-control" type="number" name="ano_pub" required><br>
			</div>

			<div class="col-md-4">
				Estilo do Jogo: <i class="fa fa-lightbulb-o" aria-hidden="true"></i>
				<input class="form-control" type="text" name="estilo" required><br>
			</div>

			<div class="col-md-6">
				Desenvolvedora / Distribuidora: <i class="fa fa-industry" aria-hidden="true"></i>
				<input class="form-control" type="text" name="desenv_distrib" required><br>
			</div>

			<div class="col-md-2">
				Nota: <i class="fa fa-star-o" aria-hidden="true"></i>
				<input class="form-control" type="number" name="nota" required><br>
			</div>

			<div class="col-md-12">
				Imagem: <i class="fa fa-picture-o" aria-hidden="true"></i>
				<input type="file" class="form-control" type="text" name="address" required><br>
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