<?php
include('CONEXAO.php');

echo("1dfs");


$username = $_POST['email'];
$password = $_POST['senha'];

echo("3");






$sql = "SELECT * FROM usuario WHERE email='$username' AND senha='$password'";
$result=$conn->query($sql);


echo($result->num_rows);

if($result->num_rows==1){

header("Location: ../html/teladeAcessoaCompra.html");
}else{

    die("erro");
}

$conn->close();

?>