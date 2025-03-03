<?php

include('CONEXAO.php');
echo("11dfs");


$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];

echo("3");






$sql = "UPDATE usuario SET nome = '$nome',email = '$email', telefone = '$telefone', endereco = '$endereco' WHERE cpf = '$cpf'";
$result=$conn->query($sql);

header("Location: ../Php/TELAGERENCIAUSERS.php");

$conn->close();
?>