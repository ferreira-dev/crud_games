<?php  

include_once 'model/Conexao.php';
include_once 'model/Manager.php';

$manager = new Manager();

$busca = (isset($_GET['busca'])) ? $_GET['busca'] : '';
if (empty($busca)){
	$dados = $manager->listClient(); 
}else{
	$dados = $manager->listClient($busca); 
}


?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once 'view/dependencias.php'; ?>
</head>
<body>

<div class="container">
	
	<h2 class="text-center">
		List of Clients <i class="fa fa-list"></i>
	</h2>

	<h5 class="text-right">
		<a href="view/page_register.php" class="btn btn-primary btn-xs">
			<i class="fa fa-user-plus"></i>
		</a>
	</h5>

	<div class="table-responsive">


	<div class="nav-wrapper">
        <form method="GET" action="index.php">
            <div class="active-pink-4 mb-4">
                <input class="form-control" type="text" id="busca" name="busca" placeholder="Search" aria-label="Search">
            </div>
        </form>
    </div>



		<table class="table table-hover">
			<thead class="thead">
				<tr>
					<th>ID</th>
					<th>NOME</th>
					<th>LOGIN</th>
					<th colspan="3">AÇÕES</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($dados as $client): ?>
				<tr>
					<td><?php echo $client['id'] ?></td>
					<td><?php echo $client['nome']; ?></td>
					<td><?php echo $client['login']; ?></td>
					<td>
						<form method="POST" action="view/page_update.php">
							
							<input type="hidden" name="id" value="<?=$client['id']?>">

							<button class="btn btn-warning btn-sm">
								<i class="fa fa-user-edit"></i>
							</button>

						</form>
					</td>
					<td>
						<form method="POST" action="controller/delete_client.php" onclick="return confirm('Você tem certeza que deseja excluir ?');">
							
							<input type="hidden" name="id" value="<?=$client['id']?>">

							<button class="btn btn-danger btn-sm">
								<i class="fa fa-trash"></i>
							</button>

						</form>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

</div>

</body>
</html>