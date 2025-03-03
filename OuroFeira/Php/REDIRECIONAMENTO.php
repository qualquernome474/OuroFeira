<?php
include('CONEXAO.php');
echo("11dfs");
session_start();



$codigo = $_POST['codigo'];
$email=$_SESSION["email"];
echo("3");






$sql = "SELECT * FROM usuario WHERE email='$email'";
$result=$conn->query($sql);
echo("4");

echo($result->num_rows);

if($resultado['cargo']=="admin"){

header("Location: ../html/telaADMIN.html");
}else{

    die("erro");
}

$conn->close();
?>