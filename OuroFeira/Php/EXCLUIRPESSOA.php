


<?php

include('CONEXAO.php');

$sql = "DELETE FROM barracas WHERE responsavel= " . $_GET["cpf"];
$result=$conn->query($sql);

$sql = "DELETE FROM usuario WHERE cpf= " . $_GET["cpf"];
$result=$conn->query($sql);


if($result === TRUE){

header("Location: ../html/verfeirantes.html");
}else{

    die("erro");
}

$conn->close();
?>