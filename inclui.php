<?php
require_once 'inicia.php';

// Coleta informaçoes do Form_incluir.php
$titulo_livro = isset($_POST['titulo_livro']) ? $_POST['titulo_livro']: null;

$cod_isbn = isset($_POST['cod_isbn']) ? $_POST['cod_isbn'] :null;
$autor_livro = isset($_POST['autor_livro']) ? $_POST['autor_livro']: null;
$nome_editora = isset($_POST['nome_editora']) ? $_POST['nome_editora']: null;
$qtd_paginas = isset($_POST['qtd_paginas']) ? $_POST['qtd_paginas'] : null;

// VERIFICA SE O USUARIO PREENCHEU TODOS OS CAMPOS DO FORM
var_dump($titulo_livro,$cod_isbn,$autor_livro,$nome_editora,$qtd_paginas);
echo "<br>";


if (empty($titulo_livro) || empty($cod_isbn) || empty($autor_livro) || empty($nome_editora) || empty($qtd_paginas)){
	echo "É preciso preencher todos os campos do formulário de cadastro!";
	exit;
}

//  INSERI AS INFORMAÇOES NA TABELA LIBROS DO BD.
$PDO = conecta_bd();
$sql = "INSERT INTO livros(titulo_livro , autor_livro, cod_isbn, nome_editora, qtd_paginas) 
    VALUES(:titulo_livro,:autor_livro,:cod_isbn,:nome_editora,:qtd_paginas)";
 $stmt = $PDO->prepare($sql);
 $stmt->bindParam(':titulo_livro', $titulo_livro);
 $stmt->bindParam(':autor_livro', $autor_livro);
 $stmt->bindParam(':cod_isbn', $cod_isbn);
 $stmt->bindParam(':nome_editora', $nome_editora);
 $stmt->bindParam(':qtd_paginas', $qtd_paginas);
 
 if ($stmt->execute()){
 	header('Location: index00.php');
 }
 else {
 	echo "Ocorreu um erro na inclusão de registro";
 	print_r($stmt->errorInfo());
 }

?>
