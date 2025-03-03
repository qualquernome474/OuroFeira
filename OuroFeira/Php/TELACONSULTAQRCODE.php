<?php
session_start();
include('CONEXAO.php');

$id = '';

if (isset($_GET['IDCompra'])) {
    $id = $_GET['IDCompra']; // Pega o ID passado como par�metro
} 



// Consulta SQL
$sql = "SELECT * FROM Registro_compras WHERE IDCompra='$id'";
$result = $conn->query($sql);

// Verificar se encontrou resultados
if ($result->num_rows > 0) {
    // Armazenar os resultados em um array para uso posterior
    $products = $result->fetch_all(MYSQLI_ASSOC);
} else {
    // Se n�o houver resultados
    $products = [];
}


foreach ($products as $product) {
$cpf=htmlspecialchars($product['cpf']);
}

$sql = "SELECT * FROM usuario WHERE cpf='$cpf'";
$result2 = $conn->query($sql);

// Verificar se encontrou resultados
if ($result->num_rows > 0) {
    // Armazenar os resultados em um array para uso posterior
    $products2 = $result2->fetch_all(MYSQLI_ASSOC);
} else {
    // Se n�o houver resultados
    $products2 = [];
}



$sql = "SELECT DISTINCT IDCompra, dataehora, statuscompra FROM Registro_compras WHERE IDCompra='$id'";
$result1 = $conn->query($sql);

if ($result1->num_rows > 0) {
    

    // Verifique se h� resultados
    if ($result1->num_rows > 0) {
        $products1 = $result1->fetch_all(MYSQLI_ASSOC);
    } else {
        $products1 = [];
    }
} else {
    // Caso o cpf n�o esteja associado a uma barraca
    $products1 = [];
    echo "<p>Nenhuma barraca encontrada para o CPF informado.</p>";
}




$total=0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Cadastrados</title>
    <link rel="stylesheet" href="../css/Style.css">
    <script src="../javascript/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>



    <script>
        
        function qrcode() {
        var id = <?php echo json_encode($id); ?>;
            const randomString = 'https://feiratec.dev.br/ourofeira/Php/TELACONSULTAQRCODE.php?IDCompra='+ id;
            new QRCode(document.getElementById("qrcode"), randomString);
        
        
        
        }    </script>
	
</head>
<body onload="qrcode()">
    <div class="barralogoResp">
        <div class="barralogo">
            <h1 style="color: #FD914D;">Ouro Feira</h1>
        </div>
        <div class="logocanto">
            <a href="../Php/MOSTRAHISTORICO.php">
                <img src="../Imagems/logo.png" alt="Logo Ouro Feira" height="125">
            </a>
        </div>
    </div>

   
    <div class="tabelafeirante">
    <table class="minha-tabela">
            <thead>
                <tr>
                   
	            <th scope="col">ID</th>
		    <th scope="col">Data e Hora do Pedido</th>
	            <th scope="col">Status do Pedido</th>
		   	
                    
                    
                </tr>
            </thead>
            <tbody>
                <?php
foreach ($products1 as $product1) {
    echo "<tr>";
    $IDCompra=$product1['IDCompra'];
    echo "<td>" . htmlspecialchars($product1['IDCompra']) . "</td>";
    echo "<td>" . htmlspecialchars($product1['dataehora']) . "</td>";
    echo "<td>" . htmlspecialchars($product1['statuscompra']) . "</td>";
   
    
   
    echo "</tr>";
}
?>
            </tbody>
        </table>
</div>












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
                // Verificar se h� produtos
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






    <div class="tabelafeirante">
    <table class="minha-tabela">
            <thead>
                <tr>
                   
	            <th scope="col">cpf</th>
		    <th scope="col">Nome</th>
	            <th scope="col">Email</th>
                <th scope="col">Telefone</th>
                <th scope="col">Endereco</th>
		   	
                    
                    
                </tr>
            </thead>
            <tbody>
                <?php
foreach ($products2 as $product2) {
    echo "<tr>";

    echo "<td>" . htmlspecialchars($product2['cpf']) . "</td>";
    echo "<td>" . htmlspecialchars($product2['nome']) . "</td>";
    echo "<td>" . htmlspecialchars($product2['email']) . "</td>";
    echo "<td>" . htmlspecialchars($product2['telefone']) . "</td>";
    echo "<td>" . htmlspecialchars($product2['endereco']) . "</td>";
   
    
   
    echo "</tr>";
}
?>
            </tbody>
        </table>
</div>





    <br><br><br><br><br>


<p>Quando seu pedido estiver pronto e o pagamento for realizado, apresente esse QRCode no guich� para retirar seus produtos</p>
<div id="qrcode" class="qrcode"></div>

</body>
</html>

<?php




// Fechar a conex�o
$conn->close();
?>
