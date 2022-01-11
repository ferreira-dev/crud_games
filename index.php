<?php
session_start();

define('BASE_PATH', $_SERVER['DOCUMENT_ROOT']);

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
		<div class="container-fluid"> <a class="navbar-brand" href="index.php"><img src= "<?= BASE_PATH."/view/assets/imagens/icon-home.png"?>" height="30px" width="40px"></a> 
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
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
		<?php if (empty($dados)){ ?>
		<div class="row">
			<div class="col">
			<p class="lead text-muted" style="text-color: #FFFAFA">Ainda não há nenhum jogo cadastrado.</p>
			<a href="/view/page_insert.php" class="btn btn-primary my-2">Cadastrar</a>
			</div>
			<div class="col">
			<img src="/view/assets/imagens/img-game.svg" width="500px" heigth="600px">
			</div>

		</div>
		
		<?php } ?>
			<?php foreach ($dados as $game) : ?>
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

								<span hidden id="idGame" name="idGame"><?= $game['id'] ?></span>
								<span hidden id="idUsuario" name="idUsuario"><?= $id ?></span>

								<a onclick="edit('<?= $game['id']; ?>');" class="btn btn-primary mr-2" id="editar"><i class="fas fa-pen" aria-hidden="true"></i> Editar</a>

								
								<a onclick="del('<?= $game['id']; ?>','<?= $game['imagem'] ?>');" class="btn btn-primary" id='excluir'><i class="fa fa-trash" aria-hidden="true"></i> Excluir</a>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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

	function edit(id_game) {
		$(document).delegate("#editar", "click", function() {

					var idGame = id_game;
					var idUsuario = <?= $id ?>;
					
					console.log('idgame	', idGame);
					console.log('idusuario	', idUsuario);
				
					$.ajax({
						type: "POST",
						url: 'view/page_update.php',
						data: {
							id: idGame,
							id_usuario: idUsuario,
							
						},

						success: function(response) {
							$('#myModal').modal('show');
							console.log(response);
						}
					});

				


		});
	}
</script>
<footer>
	<p>Desenvolvido Por: Fabricio Ferreira</p>
</footer>

</html>