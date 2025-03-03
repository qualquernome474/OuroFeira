<?php
session_start();
include('CONEXAO.php');
$cpf = $_SESSION["cpf"];



// Obter o idbarraca com base no cpf do respons�vel
$products = [];
$searchTerm = '';

// Processar pesquisa
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pesquisa'])) {
    $searchTerm = $conn->real_escape_string($_POST['pesquisa']);
    $sql = "SELECT DISTINCT IDCompra, dataehora, statuscompraadm 
            FROM Registro_compras 
            WHERE IDCompra LIKE '%$searchTerm%' 
               OR dataehora LIKE '%$searchTerm%' 
               OR statuscompraadm LIKE '%$searchTerm%'";
} else {
    $sql = "SELECT DISTINCT IDCompra, cpf, dataehora, statuscompraadm, descricao FROM Registro_compras";
}

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $products = $result->fetch_all(MYSQLI_ASSOC);
} elseif (!$result) {
    echo "<p>Erro ao executar a consulta: " . $conn->error . "</p>";
}

$id = '';
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
    <center><h1 style="color: #FD914D;">Ouro Feira</h1></center>
    <div class="logocanto">
        <a href="../html/telaADMIN.html">
            <img src="../Imagems/logo.png" alt="Logo Ouro Feira" height="125">
        </a>
    </div>

    <form id="form-pesquisa" action="" method="post">
        <div class="centarlizaPesqiusa">
            <div class="search-container">
                <input 
                    style="background-color:#494949; color:#FD914D;" 
                    type="text" 
                    size="50" 
                    name="pesquisa" 
                    id="pesquisa" 
                    placeholder="Digite sua pesquisa..." 
                    value="<?= htmlspecialchars($searchTerm) ?>"
                >
                <button type="submit" name="btnEnviar" id="btnEnviar" value="Pesquisar" class="card-button">Pesquisar</button>
            </div>
        </div>
    </form>

    <div class="tabelafeirante">
        <table class="minha-tabela">
            <thead>
                <tr>
                    <th scope="col">ID</th>
		    <th scope="col">CPF</th>
		    <th scope="col">Descricao</th>	
                    <th scope="col">Data e Hora do Pedido</th>
                    <th scope="col">Status do Pedido</th>
                    <th scope="col">A��es</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($products as $product) {
                    echo "<tr>";
                    $id = htmlspecialchars($product['IDCompra']);
                    echo "<td>" . htmlspecialchars($product['IDCompra']) . "</td>";
		    echo "<td>" . htmlspecialchars($product['cpf']) . "</td>";
	            echo "<td>" . htmlspecialchars($product['descricao']) . "</td>";
                    echo "<td>" . htmlspecialchars($product['dataehora']) . "</td>";
                    echo "<td>" . htmlspecialchars($product['statuscompraadm']) . "</td>";
                    echo '
                    <form action="SALVASTATUSADMIN.php" method="POST">
                        <td>
                            <select name="opcao" id="opcao" onchange="this.form.submit()">
                                <option value="Aguardando pagamento">Aguardando pagamento</option>
                                <option value="Dispon�vel para retirada">Dispon�vel para retirada</option>
                                <option value="Compra cancelada">Compra cancelada</option>
                                <option value="Compra Paga">Compra Paga</option>
                                <option value="Entregue">Entregue</option>
                            </select>
                            <input type="hidden" id="IDCompra" name="IDCompra" value="' . $id . '">
                        </td>
                    </form>';
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
