<?php

	$pdo = new PDO('mysql:host=localhost;dbname=testeMatheus','root','');
	$acao = "";
	
	if(@$_POST['acao'] != ""){
		$acao = $_POST['acao'];
	} elseif(@$_GET['acao'] != ""){
		$acao = $_GET['acao'];
	}
	
	@$produto = $_POST['Produto'];
	@$quantidade = $_POST['Quantidade'];
	$codigo = "";
	
	if(@$_POST['Codigo'] != ""){
		$codigo = $_POST['Codigo'];
	} elseif(@$_GET['Codigo'] != ""){
		$codigo = $_GET['Codigo'];
	}
	
	if($acao == 'INSERIR'){
		$sql = $pdo->prepare("INSERT INTO Produto VALUE (NULL, ?, ?)");
		$sql->execute(array($produto, $quantidade));
	}
	
	if($acao == "EDITAR"){
		
		$sql = $pdo->prepare("UPDATE Produto SET Produto = ?, Quantidade = ? WHERE codigo = ?");
		$sql->execute([
			$produto,
			$quantidade,
			$codigo
		]);
		
	}
	if($acao == "EXCLUIR"){
		$sql = $pdo->prepare("DELETE FROM Produto WHERE codigo = ?");
		$sql->execute([$codigo]);
	}
	
	if($acao == "CONSULTAR"){
		$acao = "EDITAR";
		$sql = $pdo->prepare("SELECT Produto, Quantidade FROM Produto WHERE codigo = ?");
		$sql->execute([$codigo]);
		$result = $sql->fetch();
		$produto = $result["Produto"];
		$quantidade = $result["Quantidade"];
		
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
				<div class="col-md-12">
					<?php if($acao != "" && $acao != "CONSULTAR"): ?>
						<div class="alert alert-success" role="alert">
							<?php if($acao == "INSERIR"): ?>
								Inserção realizada com sucesso!
							<?php elseif($acao == "EDITAR"): ?>
								Atualização realizada com sucesso!
							<?php elseif($acao == "EXCLUIR"): ?>
								Exclusão realizada com sucesso!
							<?php endif; ?>
						</div>
					<?php endif; ?>
					<?php
						if($acao == ""){
							$acao = "INSERIR";
						}
					?>
				</div>
				<div class="col-md-3">
					<div class="card">
						<div class="card-header">
							<h2>Cadastro de Produto</h2>
						</div>
						<form method="POST">
							<input type="hidden" name="acao" value="<?php echo $acao ?>">
							<input type="hidden" name="Codigo" value="<?php echo $codigo ?>">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<label for="Produto">Descrição</label>
										<input type="text" class="form-control" name="Produto" id="Produto" value="<?php echo $produto ?>">
									</div>
									<div class="col-md-12">
										<label for="Quantidade">Quantidade:</label>
										<input type="text" class="form-control" name="Quantidade" id="Quantidade" value="<?php echo $quantidade ?>">
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
								<th>Ação</th>
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
									<td>
										<a href="?acao=CONSULTAR&Codigo=<?php echo $value['codigo']?>">Editar</a>
										<a href="?acao=EXCLUIR&Codigo=<?php echo $value['codigo']?>">Excluir</a>
									</td>
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