<?php

	$pdo = new PDO('mysql:host=localhost;dbname=testeMatheus','root','');
	
	
	if(isset($_POST['Produto'])){
		$sql = $pdo->prepare("INSERT INTO Produto VALUE (NULL,?,?)");
		$sql->execute(array($_POST['Produto'],$_POST['Quantidade']));
	}
	
?>

<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<title>Teste CRUD</title>
	</head>
	<body>

		<div class="container-fluid">
			<div class="row">

				<div class="col-md-3">
					<div class="card">
						<div class="card-header">
							<h2>Cadastro de Produto</h2>
						</div>
						<form method="POST">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<label for="Produto">Descrição</label>
										<input type="text" class="form-control" name="Produto" id="Produto">
									</div>
									<div class="col-md-12">
										<label for="Quantidade">Quantidade:</label>
										<input type="text" class="form-control" name="Quantidade" id="Quantidade">
									</div>
									
									<div class="col-md-12 mt-2">
										<button type="submit" class="btn btn-primary">
											Enviar
										</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>

			</div>

			<div class="row">
				<div class="col-md-6">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Produto</th>
								<th scope="col">Quantidade</th>
							</tr>
						</thead>
						<tbody>
							<?php

								$sql = $pdo->prepare("SELECT * FROM Produto");
								$sql->execute();

								$fetchProduto = $sql->fetchAll();

								foreach ($fetchProduto as $key => $value):
							
							?>
								<tr>
									<td><?php echo $value['Produto'] ?></td>
									<td><?php echo $value['Quantidade'] ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
		<script src="js/bootstrap.bundle.min.js"></script>
	</body>
</html>