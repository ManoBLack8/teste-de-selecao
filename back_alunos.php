<?php 
// CONECTANDO AO BANCO DE DADOS
require_once("conexao.php");

//PEGANDO DADOS DO FORMULÁRIO
$nome_alunos = $_POST['nome-alunos'];
$nasimento = $_POST['nascimento'];
$genero = $_POST['genero'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$escola = $_POST['escolas'];
//CONTROLE DE CAMPOS
if($nome_alunos == ""){
	echo 'Preencha o Campo Nome!';
	exit();
}
if($email == ""){
	echo 'Preencha o Campo Email!';
	exit();
}

$id_alunos = $_POST['id-alunos'];
//SUBINDO E EDITANDO DADOS DO BANCO DE DADOS
if($id_alunos == ""){
	$res = $pdo->prepare("INSERT INTO alunos (id, nome, telefone, email, nascimento, genero, escola) VALUES (:id, :nome, :telefone, :email, :nascimento, :genero, :escola)");
	$res->bindValue(":id", $id_alunos);
}else{
	$res = $pdo->prepare("UPDATE alunos SET nome = :nome, telefone = :telefone, email = :email, nascimento = :nascimento, genero = :genero, escola = :escola WHERE id = :id");
	$res->bindValue(":id", $id_alunos);
}
	$res->bindValue(":nome", $nome_alunos);
	$res->bindValue(":telefone", $telefone);
	$res->bindValue(":email", $email);
	$res->bindValue(":nascimento", $nasimento);
	$res->bindValue(":genero", $genero);
	$res->bindValue(":escola", $escola);
	$res->execute();


echo 'Enviado com Sucesso!';

?>
