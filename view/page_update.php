<?php


include_once '../model/Manager.php';
include_once 'dependencias.php';

$manager = new Manager();

$idUsuario = $_POST['idUsuario'];
$idGame = $_POST['idGame'];
var_dump($_POST);

?>

<h2 class="text-center">
	Editar Registro <i class="fa fa-user-edit"></i>
</h2>
<hr>

<form method="POST" action="../controller/updateGame.php" enctype="multipart/form-data">

	<div class="container">
		<div class="form-row">

			<?php foreach ($manager->getInfo("game", $idUsuario, $idGame) as $game_info) : ?>

				<div class="col-md-6">
					Título:
					<input class="form-control" type="text" name="titulo" required autofocus value="<?= $game_info['titulo'] ?>"><br>
				</div>

				<div class="col-md-6">
					Ano de Publicação:
					<input class="form-control" type="number" name="ano_pub" required value="<?= $game_info['ano_pub'] ?>"><br>
				</div>

				<div class="col-md-4">
					Estilo:
					<input class="form-control" type="text" name="estilo" required value="<?= $game_info['estilo'] ?>"><br>
				</div>

				<div class="col-md-4">
					Desenv. / Distrib.:
					<input class="form-control" type="text" name="desenv_distrib" required value="<?= $game_info['desenv_distrib'] ?>"><br>
				</div>

				<div class="col-md-4">
					Nota:
					<input class="form-control" type="number" name="nota" required value="<?= $game_info['nota'] ?>"><br>
				</div>

				<div class="col-md-12">
					Imagem: <i class="fa fa-map"></i>
					<input type="file" class="form-control" name="imagem" required><br>
				</div>

				<div class="col-md-4">
					<input type="hidden" name="id" value="<?= $game_info['id'] ?>">

				<?php endforeach; ?>

				<button class="btn btn-warning btn-lg">

					Atualizar <i class="fa fa-user-edit"></i>

				</button>
				<a class="btn btn-success btn-lg" href="../index.php">
					Voltar
				</a><br><br>



				</div>

		</div>
	</div>

</form>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>