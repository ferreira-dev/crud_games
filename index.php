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
		<div class="container-fluid"> <a class="navbar-brand" href="index.php"><img src="/view/assets/imagens/icon-home.png" height="30px" width="40px"></a>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto mb-2 mb-lg-0">
					<li class="nav-item"> <a class="nav-link active" aria-current="page" href="/view/page_insert.php">Cadastrar</a> </li>
					<li class="nav-item"> <a class="nav-link" href="controller/logout.php">Sair</a> </li>
				</ul>
				<form method="GET" action="index.php" class="d-flex">
					<input class="form-control mr-2" type="search" aria-label="busca" name="busca">
					<button class="btn btn-outline-success" type="submit">Pesquisar</button>
				</form>
			</div>
		</div>
	</nav>

	<!-- fim navbar -->


	<div class="container mx-auto mt-4">
		<div class="row">
			<?php if (empty($dados)) {
				if (!empty($busca)) { ?>
					<div class="row">
						<div class="col">
							<p class="lead text-muted" style="text-color: #FFFAFA">Nenhum Resultado Encontrado, tente com outras palavras.</p>
							<a href="/view/page_insert.php" class="btn btn-primary my-2">Cadastrar</a>
						</div>
						<div class="col">
							<img src="/view/assets/imagens/img-game.svg" width="500px" heigth="600px">
						</div>

					</div>
				<?php } else { ?>

					<div class="row">
						<div class="col">
							<p class="lead text-muted" style="text-color: #FFFAFA">Ainda não há nenhum jogo cadastrado.</p>
							<a href="/view/page_insert.php" class="btn btn-primary my-2">Cadastrar</a>
						</div>
						<div class="col">
							<img src="/view/assets/imagens/img-game.svg" width="500px" heigth="600px">
						</div>

					</div>

			<?php }
			} ?>


			<?php foreach ($dados as $game) : ?>

				<form action="/view/page_update.php" method="post">
					<div class="col">

						<div class="col-md-4">
							<div class="card" style="width: 18rem;">
								<img src="view/assets/imagens/<?= $game['imagem'] ?>" class="fix-img">
								<div class="card-body">

									<h5 class="card-title"><?= $game['titulo'] ?></h5>
									<h6 class="card-subtitle mb-2 text-muted">Nota: <?= $game['nota'] ?></h6>
									<p class="card-text">

										<small>Estilo: <?= $game['estilo'] ?><br>
											Desenv. /Distribuidora: <?= $game['desenv_distrib'] ?><br>
											Ano: <?= $game['ano_pub'] ?><br>
										</small>
									</p>

									<input type="hidden" id="idGame" name="idGame" value="<?= $game['id'] ?>">
									<input type="hidden" id="idUsuario" name="idUsuario" value="<?= $id ?>">
									<button type="submit" class="btn btn-primary mr-2" id="editar"><i class="fas fa-pen" aria-hidden="true"></i> Editar</button>

									<a onclick="del('<?= $game['id']; ?>','<?= $game['imagem'] ?>');" class="btn btn-primary" id='excluir'><i class="fa fa-trash" aria-hidden="true"></i> Excluir</a>
								</div>
							</div>
						</div>
					</div>
				</form>
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
							// console.log('sucesso!', response);

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