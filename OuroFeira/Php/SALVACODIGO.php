<?php
include('CONEXAO.php');

echo("11dfs");


$email = $_POST['email'];
$codigo = $_POST['codigo'];

echo("3");






$sql = "UPDATE usuario SET codigo = '$codigo' WHERE email = '$email'";
$result=$conn->query($sql);

$conn->close();
?>