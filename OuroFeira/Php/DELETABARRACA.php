<?php


session_start();
include('CONEXAO.php');
$cpf = '';

if (isset($_GET['cpf'])) {
    $cpf = $_GET['cpf']; // Pega o ID passado como parâmetro
} 






$sql = "SELECT id FROM barracas WHERE responsavel='$cpf'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $idbarraca = $row['id'];

    // Executar a consulta para pegar os produtos da barraca
    $sql = "DELETE FROM produtos WHERE idbarraca= '$idbarraca'";
    $result=$conn->query($sql);


    $sql = "DELETE FROM barracas WHERE responsavel= '$cpf'";
    $result=$conn->query($sql);
    
} else {
    // Caso o cpf não esteja associado a uma barraca
    $products = [];
    echo "<p>Nenhuma barraca encontrada para o CPF informado.</p>";
}



$sql = "UPDATE usuario SET cargo = 'comum' WHERE cpf = '$cpf'";
$result=$conn->query($sql);


$conn->close();

header("Location: ../html/verfeirantes.html");




?>