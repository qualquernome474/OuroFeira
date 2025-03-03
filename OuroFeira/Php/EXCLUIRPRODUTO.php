<?php

include('CONEXAO.php');
echo("11dfs");


$idproduto = $_POST['idproduto'];


echo("3");






$sql = "DELETE FROM produtos WHERE idproduto= '$idproduto'";
$result=$conn->query($sql);

$conn->close();

header("Location: ../html/AtualizarPDR.html");
?>