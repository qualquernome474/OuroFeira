<?php
session_start();
include('CONEXAO.php');
$id = '';
$cpf = '';  // Definindo a vari�vel $cpf

// Verificar se o CPF est� vindo da sess�o ou de outro lugar
if (isset($_SESSION['cpf'])) {
    $cpf = $_SESSION['cpf'];  // Exemplo, caso o CPF venha da sess�o
}

// Se o IDCompra for passado via GET, pega o valor
if (isset($_GET['IDCompra'])) {
    $id = $_GET['IDCompra']; // Pega o ID passado como par�metro
} 



// Consulta SQL para barracas
$sql = "SELECT * FROM barracas WHERE responsavel='$cpf'";
$result = $conn->query($sql);

// Verificar se encontrou algum resultado
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $idB = $row['id'];
} else {
    // Caso n�o haja resultado, exibe uma mensagem ou redireciona
    echo "Nenhuma barraca encontrada para o respons�vel com CPF: $cpf";
    exit;  // Saia do script ou forne�a outra l�gica de erro
}

// Consulta SQL para Registro_compras
$sql = "SELECT * FROM Registro_compras WHERE IDCompra='$id' AND origem='$idB'";
$result = $conn->query($sql);

// Verificar se encontrou resultados
if ($result->num_rows > 0) {
    // Armazenar os resultados em um array para uso posterior
    $products = $result->fetch_all(MYSQLI_ASSOC);
} else {
    // Se n�o houver resultados
    $products = [];
}

$total = 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Cadastrados</title>
    <link rel="stylesheet" href="../css/Style.css">
    <script src="../javascript/script.js"></script>
</head>
<body>
    <div class="barralogoResp">
        <div class="barralogo">
            <h1 style="color: #FD914D;">Ouro Feira</h1>
        </div>
        <div class="logocanto">
            <a href="../Php/VENDAS.php">
                <img src="../Imagems/logo.png" alt="Logo Ouro Feira" height="125">
            </a>
        </div>
    </div>

    <form id="form-pesquisa" action="" method="post">
        <div class="centarlizaPesqiusa">
            <div class="search-container">
                <input style="background-color:#494949; color:#FD914D;" type="text" size="50" name="pesquisa" id="pesquisa" placeholder="Digite sua pesquisa...">
                <button type="submit" name="btnEnviar" id="btnEnviar" value="Pesquisar" class="card-button">Pesquisar</button>
            </div>
        </div>
    </form>

    <div class="tabelafeirante">
        <table class="minha-tabela">
            <thead>
                <tr>
                    <th scope="col">ID do Produto</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Valor do Produto</th>
                    <th scope="col">Data e Hora</th> 
                    <th scope="col">Barraca</th> 
                    <th scope="col">Nome do Produto</th>  
                    <th scope="col">Subtotal</th>  
                </tr>
            </thead>
            <tbody>
                <?php
                // Verificar se há produtos
                if (count($products) > 0) {
                    // Exibir os dados na tabela
                    foreach ($products as $product) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($product['idproduto']) . "</td>";
                        echo "<td>" . htmlspecialchars($product['quant']) . "</td>";  // Ajuste para o campo correto do banco
                        echo "<td>" . htmlspecialchars($product['valorproduto']) . "</td>"; // Ajuste para o campo correto do banco
                        echo "<td>" . htmlspecialchars($product['dataehora']) . "</td>";
                        echo "<td>" . htmlspecialchars($product['origem']) . "</td>";
                        echo "<td>" . htmlspecialchars($product['nome']) . "</td>";
                        
                        echo '<td>R$' . number_format($product['quant']*$product['valorproduto'], 2, '.', ',') . '</td>';
                        echo "</tr>";

                        $total=$total+($product['quant']*$product['valorproduto']);


                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum produto encontrado</td></tr>";
                }
                ?>
<?php
            
            echo '<tr>';
	
    echo '<td colspan="7"></td>';
    echo '<th>Valor Total</th>';
    echo '<td>R$' . number_format($total, 2, ',', '.') . '</td>';
echo '</tr>';
            
            
            ?>
                
            </tbody>

            
        </table>
    </div>

</body>
</html>

<?php
// Fechar a conexão
$conn->close();
?>
