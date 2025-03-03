<?php
session_start();
include('CONEXAO.php');

// Deslogar e destruir a sess�o
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../index.html");
    exit();
}

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = []; // Initialize the cart as an empty array
}

// L�gica para remo��o de um item do carrinho
if (isset($_GET['acao']) && $_GET['acao'] == 'del') {
    $id = intval($_GET['id']);
    foreach ($_SESSION['carrinho'] as $key => $item) {
        if ($item['id'] == $id) {
            unset($_SESSION['carrinho'][$key]);
            break;
        }
    }
}

// Verifica se o formul�rio foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['idproduto'];
    $quantidade = $_POST['quantescolhida'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $valor = $_POST['valor'];
    $peso = $_POST['peso'];
    $idbarraca = $_POST['idbarraca'];
    $validade = $_POST['validade'];

    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = array();
    }

    $produto_existente = false;
    foreach ($_SESSION['carrinho'] as $key => $item) {
        if ($item['id'] == $id) {
            $_SESSION['carrinho'][$key]['quantidade'] += $quantidade;
            $produto_existente = true;
            break;
        }
    }

    if (!$produto_existente) {
        $_SESSION['carrinho'][] = array(
            'id' => $id,
            'idbarraca' => $idbarraca,
            'quantidade' => $quantidade,
            'nome' => $nome,
            'validade' => $validade,
            'descricao' => $descricao,
            'categoria' => $categoria,
            'valor' => $valor,
            'peso' => $peso
        );
    }
}

$total = 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Style.css">
    <script src="../javascript/script.js"></script>
</head>
<body>
    <div class="barralogo"> 
        <div class="nomeOUROFEIRA">
            <h1 style="color: #FD914D;">Ouro feira</h1>
        </div>
        <div class="logocanto">
            <a href="../Php/TELAACESSOCOMPRAS.php">
                <img src="../Imagems/logo.png" alt="" height="125">
            </a>
        </div>
        <div class="btnCanto">
            <button onclick="window.location.href='../Php/PERFIL.php';">Perfil</button>
            <form action="../Php/CARRINHO.php" method="POST">
                <button type="submit" name="logout">Sair</button>
            </form>
        </div>
    </div>
	
	<center><h1>Itens no Carrinho:</h1></center>

    <div class="container">
        <?php
       
        
        echo '<table border="1" cellpadding="8">';
        echo '<tr>
                <th>ID</th>
                <th>ID da Barraca</th>
                <th>Produto</th>
                <th>Validade</th>
                <th>Descri��o</th>
                <th>Categoria</th>
                <th>Quantidade</th>
                <th>Valor Unit�rio</th>
                <th>Peso</th>
                <th>Subtotal</th>
                <th>A��o</th>
            </tr>';
        foreach ($_SESSION['carrinho'] as $item) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($item['id']) . '</td>';
            echo '<td>' . htmlspecialchars($item['idbarraca']) . '</td>';
            echo '<td>' . htmlspecialchars($item['nome']) . '</td>';
            echo '<td>' . htmlspecialchars($item['validade']) . '</td>';
            echo '<td>' . htmlspecialchars($item['descricao']) . '</td>';
            echo '<td>' . htmlspecialchars($item['categoria']) . '</td>';
            echo '<td>' . $item['quantidade'] . '</td>';
            echo '<td>' . number_format($item['valor'], 2, '.', ',') . ' R$</td>';
            echo '<td>' . number_format($item['peso'], 2, '.', ',') . ' kg</td>';
            echo '<td>R$' . number_format($item['valor'] * $item['quantidade'], 2, '.', ',') . '</td>';
            echo '<td><a class="btn btn-danger" href="?acao=del&id=' . $item['id'] . '" title="Remover item">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                          <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                      </svg>
                  </a></td>';
            echo '</tr>';
            $total += $item['valor'] * $item['quantidade'];
        }
	echo '<td colspan="11"></td>';
        echo '<tr>';
        echo '<td colspan="9"></td>';
        echo '<th>Valor Total</th>';
        echo '<td>R$' . number_format($total, 2, ',', '.') . '</td>';
        echo '</tr>';
        echo '</table>';
        ?>
    </div>
    <form action="../Php/SALVACOMPRA.php" method="POST">    
	<center>
	<h1 style="color: white;">Descri��o:</h1>
        <textarea id="descricao" name="descricao" rows="4" cols="50"></textarea>
	</center>
	<center><p>Atualmente estamos apenas aceitando pix como forma de pagamento, ao finalizar a compra, pague usando a chave "gabrielexxe0@gmail.com", caso pague usando o nome de outra pessoa, por favor adicione seu cpf na descri��o do pix para facilitar a valida��o do seu pagamento</p></center>  

	</br>

    <div class="centralizantndaBarracaJose">

        <button type="submit">Finalizar Compra</button><br>
    
    </div>
    </form>
</body>
</html>



