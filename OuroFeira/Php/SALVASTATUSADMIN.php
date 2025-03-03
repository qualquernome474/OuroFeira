<?php
include('CONEXAO.php');

echo("11dfs");


$IDCompra = $_POST['IDCompra'];
$opcao = $_POST['opcao'];

echo("3");



echo "<script>
    alert('IDCompra: " . htmlspecialchars($IDCompra) . "');
    alert('Op��o: " . htmlspecialchars($opcao) . "');
</script>";




$sql = "UPDATE Registro_compras SET statuscompraadm = '$opcao' WHERE IDCompra = '$IDCompra'";
$result=$conn->query($sql);

header("Location: ../Php/TELAGERENCIACOMPRAS.php");

$conn->close();
?>