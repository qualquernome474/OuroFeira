<?php
include('CONEXAO.php');
session_start();
$cpf=$_SESSION["cpf"];
$descricao = $_POST['descricao'];


$statuscompra="pendente";
$statuscompraadm="Aguardando pagamento";

$idcompra = rand(1000000000, 9999999999);
date_default_timezone_set('America/Sao_Paulo');
$data_hora_atual = date("Y-m-d H:i:s");




$estoque_suficiente = true; // Variável para rastrear se o estoque é suficiente para todos os itens

foreach ($_SESSION['carrinho'] as $item) {
    $idproduto = htmlspecialchars($item['id']);
    $nome = htmlspecialchars($item['nome']);
    $idbarraca = htmlspecialchars($item['idbarraca']);
    $quantidade = $item['quantidade'];

    // Verificar quantidade no estoque
    $sql_check_estoque = "SELECT quantidade FROM produtos WHERE idproduto = '$idproduto'";
    $result_check = $conn->query($sql_check_estoque);

    if ($result_check && $result_check->num_rows > 0) {
        $row = $result_check->fetch_assoc();
        $estoque_atual = $row['quantidade'];

        if ($quantidade > $estoque_atual) {
            $estoque_suficiente = false;
            echo "<script>alert('Estoque insuficiente para o produto: $nome');</script>";
            break;
        }
    } else {

	echo "<script>alert('Erro ao verificar o estoque para o produto: $nome');</script>";

        $estoque_suficiente = false;
        break;
    }
}




if ($estoque_suficiente) {
    foreach ($_SESSION['carrinho'] as $item) {
        $idproduto = htmlspecialchars($item['id']);
        $quantidade = intval($item['quantidade']); // Certifique-se de que � um n�mero inteiro

        // Query SQL para atualizar o estoque
        $sql = "UPDATE produtos SET quantidade = quantidade - $quantidade WHERE idproduto = '$idproduto'";
        
        // Executar a query
        $result = $conn->query($sql);

        if ($result) {
            if ($conn->affected_rows > 0) {
                echo "Estoque atualizado para o produto ID $idproduto.<br>";
            } else {
                echo "Nenhuma linha foi atualizada para o produto ID $idproduto. Verifique se o produto existe.<br>";
            }
        } else {
            echo "Erro ao atualizar o estoque para o produto ID $idproduto: " . $conn->error . "<br>";
        }
    }
}



if ($estoque_suficiente) {

foreach ($_SESSION['carrinho'] as $item) {
    
    $idproduto=htmlspecialchars($item['id']);
    $nome=htmlspecialchars($item['nome']);
    $idbarraca=htmlspecialchars($item['idbarraca']);
    $quantidade=$item['quantidade'];
    $valor=$item['valor'];

$sql = "INSERT INTO Registro_compras (IDCompra, idproduto, quant, valorproduto, cpf, dataehora, origem, nome, statuscompra, statuscompraadm, descricao) VALUES ('$idcompra', '$idproduto', '$quantidade', '$valor', '$cpf', '$data_hora_atual', '$idbarraca', '$nome', '$statuscompra', '$statuscompraadm', '$descricao')";
$result=$conn->query($sql);

}
unset($_SESSION['carrinho']);
}

$conn->close();


header("Location: ../Php/TELAACESSOCOMPRAS.php");

?>
