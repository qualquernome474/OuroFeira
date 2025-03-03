<?php

include('CONEXAO.php');
echo("11dfs");


$senha = $_POST['senha'];
$codigo = $_POST['codigo'];

echo("3");








$sql = "UPDATE usuario SET senha = '$senha' WHERE codigo = '$codigo'";
$result=$conn->query($sql);

header("Location: ../html/login.html");

$conn->close();
?>