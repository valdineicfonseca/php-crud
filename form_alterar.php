	<?php
	require 'inicia.php';
	/** ARMAZENA O CODIGO DO LIVRO A SER ALTERADO **/
	$cod_livro = isset($_GET['cod_livro']) ? (int) $_GET['cod_livro'] : null;
	
	if(empty($cod_livro)){
		echo "O código do livro para alteração não foi definido.";
		exit;
	}

	/** BUSCA NA TABELA OS DADOS DO LIVRO QUE DEVERÁ SER ALTERADO **/
	$PDO = conecta_bd();
	$stmt = $PDO->prepare("SELECT * FROM livros WHERE cod_livro = :cod_livro");
	$stmt->bindParam(':cod_livro', $cod_livro, PDO::PARAM_INT);
	$stmt->execute();
	$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

	//** SE FETCH ACIMA NÃO RETORNAR UM ARRAY PREENCHIDO, O CÓDIGO DO LIVRO NÃO EXISTE NA TABELA **//

	if (!is_array($resultado)){
		echo "Nenhum livro encontrado com o código informado";
		exit;
	}

	?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Alteração de cadastros</title>
</head>
<body>
	<h2>Cadastro de Livros</h2>
	<form action="altera.php" method="post">
		
		<label for="titulo_livro">Título:</label>
			<input type="text" name="titulo_livro" id="titulo_livro" 
			value="<?=$resultado['titulo_livro'] ?>">

		<label for="autor_livro">Autor:</label>
			<input type="text" name="autor_livro" id="autor_livro" 
			value="<?=$resultado['autor_livro'] ?>">

		<label for="cod_isbn">ISBN:</label>
			<input type="text" name="cod_isbn" id="cod_isbn" 
			value="<?=$resultado['cod_isbn'] ?>">

		<label for="nome_editora">Editora:</label>
			<input type="text" name="nome_editora" id="nome_editora" 
			value="<?=$resultado['nome_editora'] ?>">

		<label for="qtd_paginas">Qtd. Páginas:</label>
			<input type="text" name="qtd_paginas" id="qtd_paginas" 
			value="<?=$resultado['qtd_paginas'] ?>">

			<input type="hidden" name="cod_livro" 
				value="<?=$cod_livro ?>">
			<input type="submit" value="Alterar">
			
			<button>
				<a href="index00.php" style="text-decoration:none"> Cancelar </a>
			</button>

	</form>


</body>
</html>
