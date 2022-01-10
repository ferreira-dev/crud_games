<?php
session_start();

if (isset($_SESSION['id'])) {
	$id = $_SESSION["id"];
}

if (empty($id)) {
	header("Location: view/login.php");
	exit;
}

include_once 'model/Conexao.php';
include_once 'model/Manager.php';

$manager = new Manager();

$busca = (isset($_GET['busca'])) ? $_GET['busca'] : '';

if (empty($busca)) {
	$dados = $manager->listGame($id);
} else {
	$dados = $manager->listGame($id, $busca);
}

?>
<!DOCTYPE html>
<html>

<head>
	<?php include_once 'view/dependencias.php'; ?>
	<link rel="stylesheet" href="/view/assets/css/index.css">
</head>

<body>


	<!-- navbar -->

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid"> <a class="navbar-brand" href="#">LOGOTIPO</a> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto mb-2 mb-lg-0">
					<li class="nav-item"> <a class="nav-link active" aria-current="page" href="/view/page_insert.php">Cadastrar</a> </li>
					<li class="nav-item"> <a class="nav-link" href="controller/logout.php">Sair</a> </li>
					</li>
				</ul>
				<form method="GET" action="index.php" class="d-flex">
					<input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search" name="busca">
					<button class="btn btn-outline-success" type="submit">Buscar</button>
				</form>
			</div>
		</div>
	</nav>

	<!-- fim navbar -->

	<div class="container mx-auto mt-4">
		<div class="row">
			<?php foreach ($dados as $game) : ?>
				<div class="col">

					<div class="col-md-4">
						<div class="card" style="width: 18rem;">
							<img src="view/assets/imagens/<?= $game['imagem'] ?>" class="fix-img" width="">
							<div class="card-body">

								<h5 class="card-title"><?= $game['titulo'] ?></h5>
								<h6 class="card-subtitle mb-2 text-muted">Nota: <?= $game['nota'] ?></h6>
								<p class="card-text">

									<small>Estilo: <?= $game['estilo'] ?><br>
										Desenv. /Distribuidora: <?= $game['desenv_distrib'] ?><br>
										Ano: <?= $game['ano_pub'] ?><br>
									</small>
								</p>
								<span hidden id="idGame"><?= $game['id'] ?></span>

								<a href="#" class="btn btn-primary mr-2"><i class="fas fa-pen" aria-hidden="true"></i> Editar</a>

								<a onclick="del('<?= $game['id']; ?>','<?= $game['imagem'] ?>');" class="btn btn-primary" id='excluir'><i class="fa fa-trash" aria-hidden="true"></i> Excluir</a>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

</body>
<script>
	function del(id_game, imagem) {
		$(document).delegate("#excluir", "click", function() {

			Swal.fire({
				icon: 'warning',
				title: 'Deseja excluir esse jogo?',
				showDenyButton: false,
				showCancelButton: true,
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Sim',
				cancelButtonText: "Cancelar"
			}).then((result) => {
				if (result.isConfirmed) {

					var idGame = id_game;
					var idUsuario = <?= $id ?>;
					var nomeImagem = imagem;
					console.log('idgame	', idGame);
					console.log('idusuario	', idUsuario);
					console.log('nomeimagem	', imagem);

					$.ajax({
						type: "POST",
						url: 'controller/deleteGame.php',
						data: {
							id: idGame,
							id_usuario: idUsuario,
							imagem: nomeImagem
						},

						success: function(response) {

							// Swal.fire('Successo.', response, 'success')
							location.reload();
						}
					});

				}
			});


		});
	}
</script>
<footer>
	<p>Desenvolvido Por: Fabricio Ferreira</p>
</footer>

</html>