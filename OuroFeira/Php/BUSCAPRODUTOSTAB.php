<?php
session_start();
include('CONEXAO.php');
$cpf = $_SESSION["cpf"];



$pesquisa = $conn->real_escape_string($_POST['pesquisa'] ?? '');  // Captura a pesquisa de forma segura
$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT) ?? 1;
$qtd_result_pg = filter_input(INPUT_POST, 'qtd_result_pg', FILTER_SANITIZE_NUMBER_INT) ?? 10;

$offset = ($pagina - 1) * $qtd_result_pg;  // Definindo o offset para pagina��o

// Obter o idbarraca com base no cpf do respons�vel
$sql = "SELECT id FROM barracas WHERE responsavel='$cpf'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $idbarraca = $row['id'];

    // Consulta SQL para pegar os produtos da barraca com filtro de pesquisa
    // Use LIKE com o operador '%' para fazer correspond�ncia parcial no nome ou id
    $sql = "SELECT * FROM produtos WHERE idbarraca='$idbarraca' AND (idproduto LIKE '%$pesquisa%' OR nome LIKE '%$pesquisa%') LIMIT $offset, $qtd_result_pg";

    $result = $conn->query($sql);

    // Verifique se h� resultados
    if ($result->num_rows > 0) {
        $products = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $products = [];
    }
} else {
    // Caso o cpf n�o esteja associado a uma barraca
    $products = [];
    echo "<p>Nenhuma barraca encontrada para o CPF informado.</p>";
}
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
    
    
    <div class="tabelafeirante">
        <table class="minha-tabela">
            <thead>
                <tr>
                    <th scope="col">Imagem</th>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Descri��o</th>
                    <th scope="col">Validade</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Peso</th>
                    <th scope="col">A��es</th>
                    <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($products)) {
                    foreach ($products as $product) {
                        echo "<tr>";
                        echo "<td><img height='100' src='" . htmlspecialchars($product['imagem']) . "' alt='Imagem do produto'></td>";
                        echo "<td>" . htmlspecialchars($product['idproduto']) . "</td>";
                        echo "<td>" . htmlspecialchars($product['nome']) . "</td>";
                        echo "<td>" . htmlspecialchars($product['descricao']) . "</td>";
                        echo "<td>" . htmlspecialchars($product['validade']) . "</td>";
                        echo "<td>" . htmlspecialchars($product['valor']) . "</td>";
                        echo "<td>" . htmlspecialchars($product['quantidade']) . "</td>";
                        echo "<td>" . htmlspecialchars($product['categoria']) . "</td>";
                        echo "<td>" . htmlspecialchars($product['peso']) . "</td>";
                        echo "<td><button onclick='showUpdatePopup("
                            . htmlspecialchars($product['idproduto']) . ", \"" 
                            . htmlspecialchars($product['nome']) . "\", \"" 
                            . htmlspecialchars($product['descricao']) . "\", \"" 
                            . htmlspecialchars($product['validade']) . "\", \"" 
                            . htmlspecialchars($product['valor']) . "\", \"" 
                            . htmlspecialchars($product['quantidade']) . "\", \"" 
                            . htmlspecialchars($product['categoria']) . "\", \"" 
                            . htmlspecialchars($product['peso']) . "\")'>Atualizar</button></td>";
                        echo "<td>";
                        echo "<form action='../Php/EXCLUIRPRODUTO.php' method='POST' onsubmit='return confirm(\"Tem certeza que deseja excluir este produto?\")'>";
                        echo "<input type='hidden' id='idproduto' name='idproduto' value='" . htmlspecialchars($product['idproduto']) . "'>";
                        echo "<button type='submit'>Excluir</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>Nenhum produto encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Popup para Atualiza��o -->
    <div id="updatePopup" class="popup" style="display:none;">
        <div class="popup-content">
            <span class="popup-close" onclick="closePopup()">&times;</span>
            <center>
                <h3>Atualizar Produto</h3>
                <form action="../Php/ATUALIZARPRODUTO.php" enctype="multipart/form-data" method="POST">
                    <input type="hidden" id="productId" name="productId">
                    <input type="text" id="nome" name="nome" placeholder="Nome do produto">
                    <input type="text" id="descricao" name="descricao" placeholder="Descri��o">
                    <input type="date" id="validade" name="validade" placeholder="Validade">
                    <input type="text" id="valor" name="valor" placeholder="Valor">
                    <input type="text" id="quantidade" name="quantidade" placeholder="Quantidade">
                    <input type="text" id="categoria" name="categoria" placeholder="Categoria">
                    <input type="text" id="peso" name="peso" placeholder="Peso">
                    <input name="arquivos" type="file">
                    <button type="submit">Salvar altera��es</button>
                </form>
            </center>
        </div>
    </div>

    <script>
        function showUpdatePopup(productId, nome, descricao, validade, valor, quantidade, categoria, peso) {
            document.getElementById('productId').value = productId;
            document.querySelector('input[name="nome"]').value = nome;
            document.querySelector('input[name="descricao"]').value = descricao;
            document.querySelector('input[name="validade"]').value = validade;
            document.querySelector('input[name="valor"]').value = valor;
            document.querySelector('input[name="quantidade"]').value = quantidade;
            document.querySelector('input[name="categoria"]').value = categoria;
            document.querySelector('input[name="peso"]').value = peso;
            document.getElementById('updatePopup').style.display = 'block';
        }

        function closePopup() {
            document.getElementById('updatePopup').style.display = 'none';
        }
    </script>
</body>
</html>
