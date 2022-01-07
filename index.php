<?php

include_once 'model/Conexao.php';
include_once 'model/Manager.php';

$manager = new Manager();

$busca = (isset($_GET['busca'])) ? $_GET['busca'] : '';
if (empty($busca)) {
	$dados = $manager->listClient();
} else {
	$dados = $manager->listClient($busca);
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
		<div class="container-fluid"> <a class="navbar-brand" href="#">BBBootstrap</a> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto mb-2 mb-lg-0">
					<li class="nav-item"> <a class="nav-link active" aria-current="page" href="/view/page_insert.php">Cadastrar</a> </li>
					<li class="nav-item"> <a class="nav-link" href="#">Sair</a> </li>
					<!-- <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false"> Shop </a> -->
						<!-- <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item" href="#"></a></li>
							<li><a class="dropdown-item" href="#"></a></li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li><a class="dropdown-item" href="#"></a></li>
						</ul> -->
					</li>
				</ul>
				<form class="d-flex"> <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search"> <button class="btn btn-outline-success" type="submit">Search</button> </form>
			</div>
		</div>
	</nav>

	<!-- fim navbar -->


	<div class="container mx-auto mt-4">
		<div class="row">
			<div class="col-md-4">
				<div class="card" style="width: 18rem;">
					<img src="https://i.imgur.com/ZTkt4I5.jpg" class="card-img-top" alt="...">
					<div class="card-body">
						<h5 class="card-title">Card title</h5>
						<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
						<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
						<a href="#" class="btn btn-primary mr-2"><i class="fas fa-link"></i> Visit Site</a>
						<a href="#" class="btn btn-primary"><i class="fab fa-github"></i> Github</a>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="card" style="width: 18rem;">
					<img src="https://i.imgur.com/ZTkt4I5.jpg" class="card-img-top" alt="...">
					<div class="card-body">
						<h5 class="card-title">Card title</h5>
						<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
						<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
						<a href="#" class="btn mr-2"><i class="fas fa-link"></i> Visit Site</a>
						<a href="#" class="btn"><i class="fab fa-github"></i> Github</a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card" style="width: 18rem;">
					<img src="https://i.imgur.com/ZTkt4I5.jpg" class="card-img-top" alt="...">
					<div class="card-body">
						<h5 class="card-title">Card title</h5>
						<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
						<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
						<a href="#" class="btn mr-2"><i class="fas fa-link"></i> Visit Site</a>
						<a href="#" class="btn"><i class="fab fa-github"></i> Github</a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card" style="width: 18rem;">
					<img src="https://i.imgur.com/ZTkt4I5.jpg" class="card-img-top" alt="...">
					<div class="card-body">
						<h5 class="card-title">Card title</h5>
						<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
						<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
						<a href="#" class="btn mr-2"><i class="fas fa-link"></i> Visit Site</a>
						<a href="#" class="btn"><i class="fab fa-github"></i> Github</a>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
<footer>
	<p>Desenvolvido Por: Fabricio Ferreira</p>
</footer>

</html>