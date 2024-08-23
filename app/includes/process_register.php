<?php

include 'connect.php';

$data = [
	'nome_completo' => $_POST["nome_completo"],
	'email' => $_POST["email"],
	'senha' => $_POST["senha"],
];

$stmt = $connect->prepare('INSERT INTO tb_user (nome_completo, email, senha) values (:nome_completo, :email, :senha)');

try{
	$connect->beginTransaction();
	$stmt->execute($data);
	$connect->commit();
	echo 'Registro salvo com sucesso';
}catch (Exception $e) {
	$connect->rollback();
	throw $e;
}
