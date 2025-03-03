<?php

include('CONEXAO.php');
echo("11dfs");


$cpf = $_POST['cpf'];
$opcao = $_POST['opcao'];

echo("3");






$sql = "UPDATE usuario SET atividade = '$opcao' WHERE cpf = '$cpf'";
$result=$conn->query($sql);

header("Location: ../Php/TELAGERENCIAUSERS.php");

$conn->close();
?>