<?php

	$pdo = new PDO('mysql:host=localhost;dbname=testeMatheus','root','');
	//$pdo -> setAttribute(PDO:: ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	//Insert.
	//if(isset($_GET['delete'])){
		//$id = (int)$_GET['delete'];
		//$pdo->exec("DELETE FROM Produto WHERE id=$id");
		//echo 'Produto deletado: '.$id;
	
	
	if(isset($_POST['Produto'])){
		 $sql = $pdo->prepare("INSERT INTO Produto VALUE (NULL,?,?)");
		 $sql->execute(array($_POST['Produto'],$_POST['Quantidade']));
		 echo "Enviado";
	}
?>

<form method= "post">
 
	 <div class= "card-header"> Produto:</div>
	 <input type= "text" name = "Produto">
	 <br>
	 <div class= "card-header"> Quantidade:</div>
	 <input type= "text" name= "Quantidade">
	 <br>
	 <input type="submit" value="Enviar">
	
</form>

<?php

	$sql = $pdo->prepare("SELECT * FROM Produto");
	$sql->execute();

	$fetchProduto = $sql->fetchAll();
	
	foreach ($fetchProduto as $key => $value) {
		
		echo $value['Produto'].' | '.$value['Quantidade'];
		echo '<hr>';
		
	}
	
?>