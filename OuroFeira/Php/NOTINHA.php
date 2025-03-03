<?php
session_start();
include('CONEXAO.php');
$id = '';

if (isset($_GET['IDCompra'])) {
    $id = $_GET['IDCompra']; // Pega o ID passado como parâmetro
} 



// Consulta SQL
$sql = "SELECT * FROM Registro_compras WHERE IDCompra='$id'";
$result = $conn->query($sql);

// Verificar se encontrou resultados
if ($result->num_rows > 0) {
    // Armazenar os resultados em um array para uso posterior
    $products = $result->fetch_all(MYSQLI_ASSOC);
} else {
    // Se não houver resultados
    $products = [];
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
               <center> <h1 style="color: #FD914D;">Ouro Feira</h1></center>
        
        <div class="logocanto">
            <a href="../Php/MOSTRAHISTORICO.php">
                <img src="../Imagems/logo.png" alt="Logo Ouro Feira" height="125">
            </a>
        </div>
    
	</br></br>
  <center><p>Atualmente estamos apenas aceitando pix como forma de pagamento, pague usando a chave "gabrielexxe0@gmail.com", caso pague usando o nome de outra pessoa, por favor adicione seu cpf na descri��o do pix para facilitar a valida��o do seu pagamento</p></center>  
    	</br>

<center> <h1>Notinha:</h1></center>

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


<center><p>Quando seu pedido estiver pronto e o pagamento for realizado, apresente esse QRCode no guich� para retirar seus produtos</p></center>
<div id="qrcode" class="qrcode"></div>





</body>
</html>

<?php




// Fechar a conexão
$conn->close();
?>
