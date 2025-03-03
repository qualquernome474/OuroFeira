


<?php


echo("11dfs");
include('CONEXAO.php');


$codigo = $_POST['codigo'];

echo("3");






$sql = "SELECT * FROM usuario WHERE codigo='$codigo'";
$result=$conn->query($sql);
echo("4");

echo($result->num_rows);

if($result->num_rows==1){

header("Location: ../html/trocaAsenha.html?codigo=".$codigo);
}else{

    die("erro");
}

$conn->close();
?>